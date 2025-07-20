<?php

declare(strict_types=1);

namespace DLUnire\Controllers\Admin\Files;

use DLUnire\Models\Entities\Filename;
use DLUnire\Services\Utilities\File;
use Framework\Abstracts\BaseController;

/**
 * Copyright (c) 2025 David E Luna M
 * Todos los derechos reservados. Uso restringido bajo licencia comercial.
 *
 * Este controlador gestiona la recepción de archivos enviados desde el cliente
 * en el entorno administrativo. Puede extenderse para validar, almacenar o
 * procesar los archivos recibidos.
 *
 * @version v0.0.1
 * @package DLUnire\Controllers\Admin\Files
 * @author David E Luna M
 * @license Licencia Comercial – Prohibida su distribución no autorizada
 */
final class FileController extends BaseController {
    /**
     * Recibe uno o varios archivos enviados desde el cliente HTTP.
     * 
     * Establece el código de respuesta HTTP 201 (Created) y retorna un arreglo
     * indicando el éxito de la operación. No realiza procesamiento adicional en esta versión.
     *
     * @return array{
     *     status: bool,
     *     success: string
     * }
     */
    public function upload(): array {
        /** @var Filename[] $filenames */
        $filenames = File::upload($this, 'file', '*/*', '/storage/uploads/file');

        http_response_code(201);
        return [
            "status" => true,
            "success" => "Se ha recibido el archivo correctamente",
            "details" => $filenames
        ];
    }
}