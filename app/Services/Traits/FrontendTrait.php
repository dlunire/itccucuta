<?php

declare(strict_types=1);

namespace DLUnire\Services\Traits;

use Exception;
use InvalidArgumentException;

/**
 * Trait FrontendTrait
 *
 * Ofrece protección CSRF y funciones utilitarias para el frontend del sistema.
 *
 * @package DLUnire\Services\Traits
 * @version v0.0.1
 * @author David E Luna M
 * @license Comercial
 * @copyright Copyright (c) 2025 David E Luna M
 * @copyright Copyright (c) 2025 Alvaro Mantilla
 */
trait FrontendTrait {
    /**
     * Longitud del token en caracteres hexadecimales (debe ser par).
     *
     * @var integer $token_length
     */
    private int $token_length = 500;

    /**
     * Devuelve el Frontend del Sistema
     *
     * @param string $title Título de la ruta del sistema.
     * @param string|null $description Descripción (opcional). Descripción de la ruta.
     * @param string|null $token Token aleatorio (opcional). Puede ser null si aún no se ha generado.
     * @return string
     */
    public function get_frontend(string $title = "Título del sistema", ?string $description = null, ?string $token = null): string {
        return view('home', [
            "token" => $token,
            "title" => trim($title),
        ]);
    }

    /**
     * Establece el token de protección contra ataques de referencia cruzada.
     *
     * @param string $field Nombre del campo que contiene el token CSRF.
     * @return void
     * 
     * @throws Exception
     */
    private function set_csrf_token(string $field = 'csrf_token'): void {
        $this->validate_session();

        if (!$this->token_exists($field)) {
            $_SESSION[$field] = bin2hex(random_bytes($this->token_length / 2));
        }
    }

    /**
     * Devuelve el token CSRF para evitar ataques por referencia cruzada (CSRF).
     * 
     * Si el token aún no existe o no es válido, se genera automáticamente.
     *
     * @param string $field Nombre del campo donde se encuentra el token.
     * @return string Token CSRF válido para ser usado en formularios.
     * 
     * @throws Exception Si la sesión no está iniciada.
     */

    public function get_csrf_token(string $field = 'csrf_token'): string {
        $this->validate_session();
        $this->set_csrf_token($field);
        return $_SESSION[$field];
    }

    /**
     * Verifica si el token de protección contra ataques de referencia cruzada (CSRF) existe.
     *
     * @param string $field Campo donde se encuentra el token
     * @return boolean
     * 
     * @throws Exception
     */
    private function token_exists(string $field = 'csrf_token'): bool {
        $this->validate_session();

        /** @var string|null $token */
        $token = $_SESSION[$field] ?? null;

        /** @var string $pattern */
        $pattern = "/^[0-9a-f]{{$this->token_length}}$/i";

        return is_string($token) && boolval(preg_match($pattern, $token));
    }

    /**
     * Verifica si la sesión se encuentra activa
     *
     * @return boolean
     */
    private function session_active(): bool {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    /**
     * Valida si la sesión PHP está activa.
     * 
     * Lanza una excepción si la sesión no ha sido iniciada mediante `session_start()`.
     *
     * @return void
     * 
     * @throws Exception Si la sesión no está activa.
     */

    private function validate_session(): void {
        if (!$this->session_active()) {
            throw new Exception("Debe colocar «session_start();» para poder generar tokens");
        }
    }

    /**
     * Establece la longitud del token CSRF.
     *
     * Si se proporciona un número impar, se ajustará automáticamente al siguiente número par.
     *
     * @param integer $length Opcional. Longitud del token CSRF en caracteres hexadecimales. Valor por defecto: 500.
     * @return void
     * 
     * @throws InvalidArgumentException Si la longitud está fuera del rango permitido.
     */

    public function set_csrf_token_length(int $length = 500): void {

        if ($length < 32 || $length > 4096) {
            throw new InvalidArgumentException("La longitud del token debe estar entre 32 y 4096 caracteres.");
        }

        if (($length & 1) === 1) {
            ++$length;
        }

        $this->token_length = $length;
    }
}