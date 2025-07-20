<?php

declare(strict_types=1);

namespace Framework\Abstracts;

use DLCore\Core\BaseController as CoreBaseController;
use DLRoute\Server\DLServer;
use DLStorage\Errors\StorageException;
use DLUnire\Models\DTO\FilenameData;
use DLUnire\Models\DTO\Frontend;
use DLUnire\Services\Traits\CheckConectionTrait;
use DLUnire\Services\Traits\FrontendTrait;
use Exception;

abstract class BaseController extends CoreBaseController {
    use FrontendTrait, CheckConectionTrait;

    /**
     * Devuelve el contenido del frontend
     *
     * @param string $title Título del frontend
     * @param string $description Descripción del frontend
     * @return string
     */
    public function get_frontend_content(string $title = "Consultas", string $description = "Consulta de registros"): string {
        /** @var Frontend $frontend */
        $frontend = new Frontend();

        $frontend->set_title($title);
        $frontend->set_description($description);
        $frontend->set_token($this->generate_uuid());
        $frontend->set_csrf($this->get_csrf());

        return $this->get_frontend($frontend);
    }

    /**
     * Convierte un archivo CSV a un array
     *
     * @param FilenameData $file Archivo a ser analizado
     * @return array
     */
    protected function csv_to_array(FilenameData $file): array {

        /** @var string $content */
        $content = $this->get_csv_content($file->name);

        throw new Exception($content, 404);
        return [];
    }

    /**
     * Devuelve el contenido del archivo CSV
     *
     * @param string $filename Archivo a ser analizado
     * @return string
     * 
     * @throws StorageException
     */
    private function get_csv_content(string $filename): string {
        $filename = $this->debug_route($filename);

        /** @var string $root */
        $root = DLServer::get_document_root();

        /** @var string $separator */
        $separator = DIRECTORY_SEPARATOR;

        /** @var string $file */
        $file = "{$root}{$separator}{$filename}";

        /** @var string $name_only */
        $name_only = basename($file);

        if (!file_exists($file)) {
            throw new StorageException("El archivo «{$name_only}» no existe o fue eliminado", 404);
        }

        return strval(file_get_contents($file));
    }

    /**
     * Depura la ruta para convertirla al formado del sistema operativo en el que está
     * corriendo la aplicación
     *
     * @param string $route Ruta a ser depurada
     * @return string
     */
    private function debug_route(string $route): string {
        $route = trim($route);
        $route = trim($route, "\\\/");
        $route = preg_replace("/\/+|\\\\+/", DIRECTORY_SEPARATOR, $route);
        return $route;
    }
}
