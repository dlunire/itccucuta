<?php

declare(strict_types=1);

namespace DLUnire\Controllers\Admin\Settings;

use Framework\Abstracts\BaseController;

final class SettingsController extends BaseController {

    /**
     * Devuelve la configuración actual del sistema.
     *
     * @return array
     */
    public function index(): array {

        return [];
    }

    /**
     * Almacena el nombre del campo del campo que se utiliza para mostrar el registro de de estudiantes
     *
     * @return array
     */
    public function store(): array {

        /** @var string $name */
        $name = $this->get_string("name");

        /** @var lastname */
        $lastname = $this->get_string("lastname");

        /** @var string $document */
        $document = $this->get_string("document");

        /** @var string $date */
        $date = $this->get_required("date");

        /** @var string $course */
        $course = $this->get_required('course');

        $field_names = [
            "name" => $name,
            "lastname" => $lastname,
            "document" => $document,
            "date" => $date,
            "course" => $course
        ];

        http_response_code(201);
        return [
            "status" => true,
            "success" => "La configuración del sistema se ha actualizado correctamente",
            "details" => $this->get_values()
        ];
    }
}