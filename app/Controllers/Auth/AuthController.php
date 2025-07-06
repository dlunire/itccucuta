<?php

declare(strict_types=1);

namespace DLUnire\Controllers\Auth;

use DLCore\Core\BaseController;
use DLUnire\Models\Users;
use DLUnire\Models\Views\UserEntity;
use Error;

final class AuthController extends BaseController {

    /**
     * Inicia la sesión de usuario
     *
     * @return array
     */
    public function login(): array {

        /** @var string $username */
        $username = $this->get_required('username');
        UserEntity::validate_user($username);

        /** @var Users $users */
        $users = new Users();

        $logged = $users->capture_credentials();

        if (!$logged) {
            throw new Error("La combinación de usuario y contraseña es incorrecta", 403);
        }

        http_response_code(201);
        return [
            "status" => true,
            "message" => "Autenticado correctamente"
        ];
    }

    /**
     * Muestra el formulario de inicio de sesión
     *
     * @return string
     */
    public function index(): string {
        return view('home', [
            "token" => $this->get_random_token(),
            "title" => "Programa de instalación"
        ]);
    }
}