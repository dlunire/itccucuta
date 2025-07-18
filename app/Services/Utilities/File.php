<?php

namespace DLUnire\Services\Utilities;

use DLCore\Core\BaseController;
use DLRoute\Requests\Filename as RequestsFilename;
use DLStorage\Errors\StorageException;
use DLUnire\Models\Entities\Filename;
use DLUnire\Models\Tables\Filenames;

final class File {

    /**
     * Copia al servidor los archivos y devuelve una lista de ellos.
     *
     * Esta función se encarga de procesar archivos provenientes de un formulario HTML.
     * Valida el tipo MIME si es necesario, guarda los archivos en el directorio especificado
     * y retorna un arreglo con la información resultante. Puede manejar almacenamiento
     * en modo privado o público según el parámetro `$private`.
     *
     * @param BaseController $controller Controlador desde donde se ejecuta.
     * @param string $field Campo de formulario a procesar. El valor por defecto es `file`.
     * @param string $mimetype Tipo de archivo aceptado. Por defecto es (todos).
     * @param string $basedir Directorio base donde se guardarán los archivos. Por defecto `'/storage/file'`.
     * @param bool $private Opcional. Indica si el archivo debe estar almacenado en modo privado. Por defecto es `true`.
     * @return array<Filename> Lista de archivos subidos con su información asociada.
     */
    public static function upload(BaseController $controller, string $field = 'file', string $mimetype = '*/*',  string $basedir = "/storage/file", bool $private = true): array {
        $controller->set_basedir($basedir);

        /** @var string $token */
        $token = $controller->generate_uuid();

        /** @var array $files */
        $files = $controller->upload_file($field, $mimetype);

        /** @var array $datafiles */
        $datafiles = [];

        /** @var Filename[] $filenames */
        $filenames = [];

        foreach ($files as $file) {
            if (!($file instanceof RequestsFilename)) continue;

            /** @var string $uuid */
            $uuid = $controller->generate_uuid();

            $datafile = [
                'filenames_uuid' => $uuid,
                'filenames_name' => $file->target_file,
                'filenames_basedir' =>  $file->relative_path,
                'filenames_token' => $token,
                'filenames_private' => $private ? 1 : 0,
                'filenames_size' => $file->size,
                'filenames_readable_size' =>  $file->readable_size,
                'filenames_type' => $file->type,
                'filenames_format' => $file->file_format,
                'filenames_timezone' => Filenames::get_timezone()
            ];

            $datafiles[] = $datafile;
            $filenames[] = new Filename($datafile);
        }

        if (count($datafiles) < 1) {
            throw new StorageException("Error durante el almacenamiento de la referencia del archivo enviado al servidor", 500);
        }

        Filenames::create($datafiles);

        return $filenames;
    }
}
