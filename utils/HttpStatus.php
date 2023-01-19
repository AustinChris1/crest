<?php

require_once __DIR__ . '/../vendor/lukasoppermann/http-status/src/Httpstatus.php';
require_once __DIR__ . '/../vendor/lukasoppermann/http-status/src/LanguageInterface.php';
require_once __DIR__ . '/../vendor/lukasoppermann/http-status/src/languages/en.php';

use Lukasoppermann\Httpstatus\Httpstatus;

define('HttpStatus', new Httpstatus());