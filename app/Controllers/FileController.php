<?php

declare(strict_types=1);

namespace DLUnire\Controllers;

use DLCore\Core\BaseController;
use DLUnire\Models\Entities\Filename;
use DLUnire\Models\Views\FilenameView;

final class FileController extends BaseController {


    /**
     * Carga el contenido del archivo marcado como público
     *
     * @param object{uuid: string} $param Parámetro de la petición
     * @return void
     */
    public function public_file(object $param) {
        return $this->print_file($param->uuid, false);
    }

    /**
     * Devuelve el contenido del archivo
     *
     * @param object{uuid: string} $param Parámetros de la petición
     * @return void
     */
    public function private_file(object $param) {
        return $this->print_file($param->uuid, true);
    }

    /**
     * Envía el archivo al cliente HTTP con el tipo MIME adecuado
     *
     * @param string $uuid
     * @param boolean $private
     * @return Filename
     */
    private function print_file(string $uuid, bool $private = false): Filename {
        /** @var bool $preview */
        $preview = boolval($this->get_input('preview'));

        /** @var Filename $filename */
        $filename = FilenameView::get_file($uuid, $private);

        return $filename;
    }
}
