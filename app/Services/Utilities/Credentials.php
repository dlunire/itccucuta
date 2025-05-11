<?php

/**
 * Copyright (c) 2025 David E Luna M
 * Licensed under the MIT License. See LICENSE file for details.
 */

declare(strict_types=1);

namespace DLUnire\Services\Utilities;

use DLStorage\Storage\SaveData;

/**
 * Clase encargada de representar y gestionar credenciales dentro del sistema DLUnire.
 *
 * Esta clase extiende `SaveData`, lo cual le permite almacenar y recuperar información estructurada
 * relacionada con credenciales (por ejemplo, tokens, llaves de acceso, pares usuario/contraseña u otros
 * identificadores seguros). Al heredar de `SaveData`, se beneficia del sistema de persistencia definido
 * en la biblioteca DLStorage.
 *
 * Es una estructura clave dentro de los servicios utilitarios del framework y puede utilizarse para
 * almacenamiento seguro, serialización, encriptación u operaciones relacionadas a identidad de forma modular.
 *
 * @package DLUnire\Services\Utilities
 * @version v0.0.1
 * @license MIT
 * @author David E Luna M
 * @copyright 2025 David E Luna M
 */
final class Credentials extends SaveData {

    /**
     * Array asociativo de credenciales
     *
     * @param string $filename Nombre del archivo
     * @param array $credentials
     * @param string|null $entropy Opcional. Frase de entropía
     * @return void
     */
    public function save_credentials(string $filename, array $credentials, ?string $entropy = NULL): void {
        $this->save_data($filename, json_encode($credentials), $entropy);
    }

    /**
     * Devuelve el contenido del archivo
     *
     * @param string $filename Nombre de archivo de búsqueda
     * @param string|null $entropy Entropía utilizada previamente
     * @return array<string,mixed>
     */
    public function get_credentials(string $filename, ?string $entropy = NULL): array {

        $filename = "credentials" . DIRECTORY_SEPARATOR . $filename;

        /** @var string $content */
        $content = $this->read_storage_data($filename, $entropy);

        /** @var array $data */
        $data = json_decode($content, true);

        return (array) $data;
    }

    /**
     * Verifica si existe el archivo de credenciales
     *
     * @return boolean
     */
    public function exists(string $filename): bool {
        /** @var string $file */
        $file = $this->get_file_path("credentials" . DIRECTORY_SEPARATOR . $filename);

        return file_exists($file);
    }
}
