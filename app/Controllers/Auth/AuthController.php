<?php

declare(strict_types=1);

namespace DLUnire\Controllers\Auth;

use DLCore\Core\BaseController;
use DLUnire\Auth\Auth;
use DLUnire\Models\DTO\Frontend;
use DLUnire\Models\Users;
use DLUnire\Models\Views\UserEntity;
use DLUnire\Services\Traits\FrontendTrait;
use Error;

final class AuthController extends BaseController {

    use FrontendTrait;

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
     * Cierra la sesión del usuario liberarando los datos de la sesión
     *
     * @return array
     */
    public function logout(): array {
        $auth = Auth::get_instance();
        $auth->clear_auth();
        return [
            "status" => true,
            "success" => "Se ha cerrado la sesión del usuario"
        ];
    }

    /**
     * Muestra el formulario de inicio de sesión
     *
     * @return string
     */
    public function index(): string {
        /** @var Frontend $frontend */
        $frontend = new Frontend();

        $frontend->set_title('Inicio de sesión');
        $frontend->set_description('Formulario de inicio de sesión');
        $frontend->set_csrf($this->get_csrf());
        $frontend->set_token($this->get_random_token());

        return $this->get_frontend($frontend);
    }
}