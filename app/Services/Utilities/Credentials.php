<?php

/**
 * Copyright (c) 2025 David E Luna M
 * Licensed under the MIT License. See LICENSE file for details.
 */

declare(strict_types=1);

namespace DLUnire\Services\Utilities;

use DLStorage\Storage\SaveData;
use DLUnire\Models\DTO\DBConection;

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
     * Guarda las credenciales de conexión a base de datos en un archivo local.
     *
     * Convierte el arreglo de configuración en una estructura fuertemente validada
     * mediante el DTO `DBConection`, que agrupa variables del entorno asociadas
     * al sistema de instalación (entorno, nombre de la base de datos, usuario, contraseña, etc.).
     *
     * El archivo puede ser protegido opcionalmente con una frase de entropía, 
     * lo que fortalece la confidencialidad al almacenarlo en formatos como `.dlstorage`.
     *
     * @param string $filename Nombre del archivo donde se guardarán los datos (por ejemplo, "credenciales.dlstorage").
     * @param array $credentials Arreglo asociativo con las claves requeridas por `DBConection`.
     * @param string|null $entropy Frase opcional de entropía para cifrado del archivo.
     * @return void
     */
    public function save_credentials(string $filename, array $credentials, ?string $entropy = NULL): void {
        /** @var DBConection $conection */
        $conection = new DBConection($credentials);
        $this->save_data($filename, json_encode($conection), $entropy);
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
