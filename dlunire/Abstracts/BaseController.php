<?php

declare(strict_types=1);

namespace Framework\Abstracts;

use DLCore\Core\BaseController as CoreBaseController;
use DLUnire\Services\Traits\CheckConectionTrait;
use DLUnire\Services\Traits\FrontendTrait;

abstract class BaseController extends CoreBaseController {
    use FrontendTrait, CheckConectionTrait;
}