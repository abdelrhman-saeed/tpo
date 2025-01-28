<?php

declare(strict_types=1);

namespace AbdelrhmanSaeed\Tpo\Controllers;

use Doctrine\ORM\EntityManager;
use AbdelrhmanSaeed\Tpo\DTO\UserDTO;
use AbdelrhmanSaeed\Tpo\Services\Singleton;
use Symfony\Component\HttpClient\HttpClient;
use AbdelrhmanSaeed\Tpo\Database\Entities\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\{Request, Response};

class AuthController
{
    private HttpClientInterface $client;

    public function __construct()
    {
        $this->client = HttpClient::createForBaseUri('https://echoes-travel-default-rtdb.firebaseio.com/login.json');
    }
    public function registerView()
    {
        require __DIR__ . '/../Views/Auth/register.php';
    }

    public function register()
    {
        try {
            $request = Request::createFromGlobals();

            if (! UserDTO::validate($request->request->all())) {
                session_start();
                $_SESSION['registeration_errors'] = UserDTO::getErrors();

                (new RedirectResponse('/register'))->send();
                return;
            }

            $em = Singleton::getInstance(EntityManager::class);

            // Check if the email already exists
            $existingUser = $em->getRepository(User::class)
                ->findOneBy(['email' => $request->get('email')]);

            if ($existingUser) {
                (new JsonResponse(['message' => 'Email already exists!'], 409))->send();
                return;
            }

            $user = User::create(UserDTO::getValidated());

            $user->setPassword(
                password_hash(
                    $user->getPassword(),
                    PASSWORD_BCRYPT
                )
            );

            $em->persist($user);
            $em->flush();

            (new JsonResponse(['message' => 'Registration successful!'], 201))->send();
        } catch (\Exception $e) {
            (new JsonResponse(['message' => 'An error occurred during registration.', 'error' => $e->getMessage()], 500))->send();
        }
    }

    public function loginView()
    {
        require __DIR__ . '/../Views/Auth/login.php';
    }

    public function login()
    {
        try {
            $request = Request::createFromGlobals();
            $data = json_decode($request->getContent(), true);

            if (!isset($data['email'], $data['password'])) {
                (new JsonResponse(['message' => 'Invalid request data!'], 400))->send();
                return;
            }

            $em = Singleton::getInstance(EntityManager::class);

            $user = $em->getRepository(User::class)->findOneBy(['email' => $data['email']]);

            if (!$user || !password_verify($data['password'], $user->getPassword())) {
                $response = $this->client->request('POST', '', [
                    'json' => [
                        'message' => 'Invalid email or password!',
                    ],
                ]);

                (new JsonResponse(['message' => 'Invalid email or password!'], 401))->send();
                return;
            }

            // Convert the object to array and remove the password
            $userData = $user->toArray();

            $response = $this->client->request('POST', '', [
                'json' => [
                    'email' => $user->getEmail(),
                    'name' => $user->getName(),
                    'phone' => $user->getPhone(),
                    'creditLimit' => $user->getCreditLimit(),
                ],
            ]);

            (new JsonResponse([
                'message' => 'Logged in successfully!',
                'data' => $userData,
            ], 200))->send();


            if ($response->getStatusCode() !== 200) {
                (new JsonResponse(['message' => 'Failed to notify external service.'], 500))->send();
                return;
            }
        } catch (\Exception $e) {
            (new JsonResponse(['message' => 'An error occurred during login.', 'error' => $e->getMessage()], 500))->send();
        }
    }
}
