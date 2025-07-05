<?php

declare(strict_types=1);

namespace DLUnire\Controllers\Install;

use DLCore\Core\BaseController;

/**
 * Copyright (c) 2025 David E Luna M
 * Licensed under the Comercial. See LICENSE file for details.
 *
 * Controlador responsable de gestionar el formulario y la creación del usuario
 * administrador del sistema durante el proceso de instalación inicial.
 *
 * @package DLUnire\Controllers\Install
 * @author David E Luna M <dlunire@protonmail.com>
 * @copyright 2025 David E Luna M
 * @license Comercial
 * @version v0.0.1
 */
final class UserController extends BaseController {

    /**
     * Muestra el formulario de creación de usuario administrador.
     *
     * @return string HTML renderizado del formulario.
     */
    public function user_form(): string {
        return view('install.install', [
            "token" => $this->get_random_token(),
            "title" => "Creación de usuario del sistema"
        ]);
    }

    /**
     * Procesa y almacena los datos del usuario administrador.
     *
     * @return array{
     *     status: bool,
     *     message: string
     * }
     */
    public function store(): array {
        return [
            "status" => true,
            "message" => "Usuario creado correctamente"
        ];
    }
}