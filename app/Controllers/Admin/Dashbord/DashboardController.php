<?php

declare(strict_types=1);

namespace DLUnire\Controllers\Admin\Dashbord;

use DLCore\Core\BaseController;

/**
 * Copyright (c) 2025 David E Luna M
 */

/**
 * Clase controladora responsable de gestionar la carga de la página principal del usuario autenticado.
 *
 * Esta clase extiende de `BaseController` y está diseñada para ser utilizada en entornos protegidos
 * mediante Middleware, lo cual garantiza que solo usuarios autenticados puedan acceder a sus métodos.
 * Se encarga principalmente de procesar la solicitud al panel de control (dashboard) y devolver la vista
 * correspondiente.
 *
 * @package DLUnire\Controllers\Admin\Dashbord
 * @version v0.0.1
 * @license Comercial
 * @author David E Luna M
 * @copyright 2025 David E Luna M
 *
 * @method string index() Retorna el contenido del panel de control del usuario autenticado.
 */
final class DashboardController extends BaseController {

    /**
     * Carga la página principal del usuario autenticado.
     *
     * Este método debe estar protegido por Middleware que asegure la autenticación del usuario.
     * Retorna la vista correspondiente al panel de control, o una cadena vacía si aún no ha sido implementado.
     *
     * @return string Contenido renderizado del panel de control.
     */
    public function index(): string {
        return "";
    }
}
