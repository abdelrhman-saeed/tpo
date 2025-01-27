<?php

declare(strict_types=1);

namespace AbdelrhmanSaeed\Tpo\Controllers;

use AbdelrhmanSaeed\Tpo\Services\Singleton;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\{Request, Response};
use AbdelrhmanSaeed\Tpo\DTO\UserDTO;
use AbdelrhmanSaeed\Tpo\Database\Entities\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController
{
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
            $request    = Request::createFromGlobals();
            $em         = Singleton::getInstance(EntityManager::class);

            $user       = $em->getRepository(User::class)
                ->findOneBy(['email' => $request->get('email')]);

            if (! $user || ! password_verify($request->get('password'), $user->getPassword())) {
                (new JsonResponse(['message' => 'Invalid email or password!'], 401))
                    ->send();

                return;
            }

            // Convert the object to array and remove the password
            $userData = $user->toArray();

            (new JsonResponse([
                'message'   => 'Logged in successfully!',
                'data'      => $userData
            ], 200))->send();
        } catch (\Exception $e) {
            (new JsonResponse(['message' => 'An error occurred during login.', 'error' => $e->getMessage()], 500))->send();
        }
    }
}
