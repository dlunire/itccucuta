<?php

declare(strict_types=1);

namespace DLUnire\Models\Entities;

use DLCore\Database\Model;
use Exception;

final class UserEntity extends Model {
    protected static string $timezone = '-05:00';
    protected static ?string $table = "SELECT * FROM dl_users WHERE users_username = :username AND users_records_status = 1 LIMIT 1";

    /**
     * Valida si el usuario existe
     *
     * @param string $username Nombre de usuario a ser analizado
     * @return void
     */
    public static function validate_user(string $username): void {

        /** @var array<string,string|int|null> $data */
        $data = self::first([
            ":username" => $username
        ]);

        if (count($data) < 1) {
            throw new Exception("El usuario seleccionado no existe", 404);
        }
    }
}
