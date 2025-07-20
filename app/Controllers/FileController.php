<?php

declare(strict_types=1);

namespace DLUnire\Controllers;

use DLCore\Core\BaseController;
use DLRoute\Server\DLServer;
use DLUnire\Models\DTO\FilenameData;
use DLUnire\Models\Views\FilenameView;
use Exception;

final class FileController extends BaseController {


    /**
     * Carga el contenido del archivo marcado como público
     *
     * @param object{uuid: string} $param Parámetro de la petición
     * @return void
     */
    public function public_file(object $param): void {
        $this->print_file($param->uuid, false);
    }

    /**
     * Devuelve el contenido del archivo
     *
     * @param object{uuid: string} $param Parámetros de la petición
     * @return void
     */
    public function private_file(object $param): void {
        $this->print_file($param->uuid, true);
    }

    /**
     * Envía el archivo al cliente HTTP con el tipo MIME adecuado
     *
     * @param string $uuid
     * @param boolean $private
     * @return void
     */
    private function print_file(string $uuid, bool $private = false): void {
        /** @var bool $preview */
        $preview = boolval($this->get_input('preview'));

        /** @var FilenameData $filename */
        $filename = FilenameView::get_file($uuid, $private);

        /** @var string $root */
        $root = DLServer::get_document_root();

        /** @var string $separator */
        $separator = DIRECTORY_SEPARATOR;

        /** @var string $file */
        $file = "{$root}{$separator}{$filename->name}";

        /** @var string $file_preview */
        $file_preview = "{$root}{$separator}thumbnail{$separator}{$filename->name}";

        /** @var string|false $content */
        $content = false;

        if ($preview && file_exists($file_preview)) {
            $content = file_get_contents($file_preview);

            /** @var string $name_only */
            $name_only = basename($file_preview);

            if (!$content) {
                throw new Exception("Error al obtener el contenido del archivo «{$name_only}»", 500);
            }

            header("Content-type: {$filename->type}", true, 200);
            print_r($content);
            exit;
        }

        /** @var string $name_only */
        $name_only = basename($file);

        if (!(file_exists($file))) {
            throw new Exception("El «{$name_only}» no existe o fue eliminado", 500);
        }

        $content = file_get_contents($file);

        if (!$content) {
            throw new Exception("Error al obtener el contenido del archivo «{$name_only}»", 500);
        }

        header("Content-type: {$filename->type}", true, 200);
        // header("Content-type: text/html", true, 200);
        print_r($content);
        exit;
    }
}