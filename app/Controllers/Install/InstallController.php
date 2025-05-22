<?php

namespace DLUnire\Controllers\Install;

use DLCore\Core\BaseController;
use DLUnire\Services\Utilities\File;

final class InstallController extends BaseController {

    public function credentials(): string {

        return view('install.install', [
            "token" => $this->get_random_token(),
            "title" => "Programa de instalación"
        ]);
    }

    /**
     * Almacena las credenciales en un formato binario
     *
     * @return array
     */
    public function store(): array {

        http_response_code(201);
        return [
            "status" => true,
            "message" => "Instalación de credenciales completada"
        ];
    }

    /**
     * Permite la subida de archivos
     *
     * @return array
     */
    public function upload(): array {

        $files = File::upload($this, 'file');

        http_response_code(201);
        return [
            "status" => true,
            "success" => "Archivo subido correctamente",
            "details" => $files
        ];
    }
}
