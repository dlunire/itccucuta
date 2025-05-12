<?php

namespace DLUnire\Controllers\Install;

use DLCore\Core\BaseController;

final class InstallController extends BaseController {

    public function credentials(): string {

        return view('install.install', [
            "token" => $this->get_random_token()
        ]);
    }
}
