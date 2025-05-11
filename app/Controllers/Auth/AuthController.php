<?php

declare(strict_types=1);

namespace DLUnire\Controllers\Auth;

use DLCore\Core\BaseController;

final class AuthController extends BaseController {

    /**
     * Inicia la sesión de usuario
     *
     * @return array
     */
    public function login(): array {

        /** @var string $username */
        $username = $this->get_required('username');

        /** @var string $password */
        $password = $this->get_password('password');

        http_response_code(201);
        return [
            "status" => true,
            "message" => "Autenticado correctamente"
        ];
    }
}
