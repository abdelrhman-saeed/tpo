<?php

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
        $request = Request::createFromGlobals();

        if (! UserDTO::validate($request->request->all()))
        {
            session_start();
            $_SESSION['registeration_errors'] = UserDTO::getErrors();

            (new RedirectResponse('/register'))->send();
            return;
        }

        $user = User::create(UserDTO::getValidated());

        $user->setPassword(
            password_hash($user->getPassword(),
            PASSWORD_BCRYPT)
        );

        $em = Singleton::getInstance(EntityManager::class);
        $em->persist($user);
        $em->flush();
    }

    public function loginView()
    {
        require __DIR__ . '/../Views/Auth/login.php';
    }

    public function login()
    {
        $request    = Request::createFromGlobals();
        $em         = Singleton::getInstance(EntityManager::class);

        $user       = $em->getRepository(User::class)
                        ->findOneBy(['email' => $request->get('email')]);

        if (! $user || ! password_verify($request->get('password'), $user->getPassword()))
        {
            (new JsonResponse(['message' => 'Invalid email or password!'], 401))
                ->send();

            return;
        }

        (new JsonResponse([
            'message'   => 'Logged in successfully!',
            'data'      => (array) $user ], 200))->send();
    }

}