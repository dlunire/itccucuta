<?php

namespace DLUnire\Services\Utilities;

use DLCore\Core\BaseController;

final class File {

    /**
     * Devuelve los datos del o los archivos enviados al servidor.
     *
     * @param BaseController $controller Controlador de la aplicación
     * @param string $field Campo del formulario que contienen los archivos
     * @param string $mimetype Tipo de archivos permitidos
     * @param string $basedir Directorio base
     * @return array
     */
    public static function upload(BaseController $controller, string $field = 'file', string $mimetype = '*/*',  string $basedir = "/storage/file"): array {

        $controller->set_basedir($basedir);
        $files = $controller->upload_file($field, $mimetype);

        return [];
    }
}
