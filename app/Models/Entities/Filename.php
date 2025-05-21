<?php

declare(strict_types=1);

namespace DLUnire\Models\Entities;

use DLCore\Core\BaseController;
use DLUnire\Models\Tables\Filenames;

final class Filename {

    /**
     * URL del archivo que se construirá sobre la marcha
     *
     * @var string $url
     */
    public readonly string $url;

    /**
     * Vista previa del archivo
     *
     * @var string|null $preview
     */
    public readonly ?string $preview;

    /**
     * Tipo de archivos
     *
     * @var string $type
     */
    public readonly string $type;

    /**
     * Cantidad total de bytes del archivo
     *
     * @var integer|float $bytes;
     */
    public readonly int|float $bytes;

    /**
     * Formato de archivo
     *
     * @var string $format
     */
    public readonly string $format;

    /**
     * Tamaño del archivo enviado
     *
     * @var string $size
     */
    public readonly string $size;

    public function __construct(array $datafile) {
        $this->load_file($datafile);
    }

    /**
     * Carga la información del archivo
     *
     * @return void
     */
    public function load_file(array $datafile = []): void {

        $url = $datafile[''] ?? null;
    }
}
