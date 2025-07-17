<?php

declare(strict_types=1);

namespace DLUnire\Controllers\Admin\Dashbord;

use DLUnire\Services\Traits\FrontendTrait;
use Framework\Abstracts\BaseController;

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
    use FrontendTrait;

    /**
     * Carga la página principal del usuario autenticado.
     *
     * Este método está protegido por Middleware que garantiza la autenticación del usuario.
     * Construye una instancia de Frontend con los metadatos necesarios (título, descripción, tokens),
     * y retorna la vista correspondiente al panel de control.
     *
     * @return string Contenido renderizado del panel de control.
     */
    public function index(): string {
        return $this->get_frontend_content("Dashboard", "Página principal de adminsitración del sistema");
    }

    /**
     * Página de certificados
     *
     * @return string
     */
    public function certificate(): string {
        return $this->get_frontend_content("Certificados", "Revise y consulte los certificados de los estudiantes inscritos");
    }

    /**
     * Historial de carga
     *
     * @return string
     */
    public function history(): string {
        return $this->get_frontend_content("Historial", "Revisa el histórico de actividades");
    }

    /**
     * Página de configuración
     *
     * @return string
     */
    public function settings(): string {
        return $this->get_frontend_content("Configuración", "Coloque el nombre de su empresa o marca personal, logotipo y más");
    }

    /**
     * Página de perfil
     *
     * @return string
     */
    public function profile(): string {
        return $this->get_frontend_content("Mi perfil", "Actualice su contraseña");
    }
}