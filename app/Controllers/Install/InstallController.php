<?php

namespace DLUnire\Controllers\Install;

use DLCore\Core\BaseController;
use DLUnire\Models\Entities\Filename;
use DLUnire\Models\Tables\Filenames;
use DLUnire\Models\Users;
use DLUnire\Models\Views\TestConection;
use DLUnire\Services\Utilities\Credentials;
use DLUnire\Services\Utilities\File;

final class InstallController extends BaseController {
    private string $entropy = "Base de datos";

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
        /** @var Credentials $credentials */
        $credentials = new Credentials();

        $credentials->save_credentials('database', [
            "environment" => [
                "varname" => "DL_PRODUCTION",
                "value" => $this->get_boolean('environment')
            ],

            "lifetime" => [
                "varname" => "DL_LIFETIME",
                "value" => $this->get_integer('lifetime')
            ],

            "database_name" => [
                "varname" => "DL_DATABASE_NAME",
                "value" => $this->get_required('database-name')
            ],

            "database_user" => [
                "varname" => "DL_DATABASE_USER",
                "value" => $this->get_required('database-user')
            ],

            "database_password" => [
                "varname" => "DL_DATABASE_PASSWORD",
                "value" => $this->get_required('database-password')
            ],

            "server" => [
                "varname" => "DL_DATABASE_HOST",
                "value" => $this->get_required('hostname')
            ],

            "port" => [
                "varname" => "DL_DATABASE_PORT",
                "value" => $this->get_integer('number-port')
            ],

            "charset" => [
                "varname" => "DL_DATABASE_CHARSET",
                "value" => $this->get_string('database-charset')
            ],

            "collation" => [
                "varname" => "DL_DATABASE_COLLATION",
                "value" => $this->get_string('database-collation')
            ],

            "drive" => [
                "varname" => "DL_DATABASE_DRIVE",
                "value" => $this->get_string('database-drive')
            ],

            "prefix" => [
                "varname" => "DL_PREFIX",
                "value" => $this->get_string('database-prefix')
            ],
        ], $this->entropy);

        $credentials->generate_env($this->entropy);
        http_response_code(201);

        return [
            "status" => true,
            "message" => "Instalación de credenciales completada",
            "details" => $this->get_values()
        ];
    }

    /**
     * Permite la subida de archivos
     *
     * @return array
     */
    public function upload(): array {
        /** @var Filename[] $files */
        $files = File::upload(controller: $this, field: 'file', mimetype: "text/csv");

        http_response_code(201);
        return [
            "status" => true,
            "success" => "Archivo subido correctamente",
            "details" => $files
        ];
    }

    /**
     * Verifica que las credenciales de acceso a la base de datos sean correctas.
     *
     * @return array
     */
    public function check(): array {

        return [
            "status" => false,
            "success" => "Las credenciales ingresadas fueron instaladas con éxito"
        ];
    }
}