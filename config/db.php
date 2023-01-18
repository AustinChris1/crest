<?php

namespace Config;

require_once realpath(__DIR__ . '/../vendor/thingengineer/mysqli-database-class/MysqliDb.php');
require_once realpath(__DIR__ . '/../vendor/thingengineer/mysqli-database-class/dbObject.php');

$db = new \MysqliDb('localhost', 'root', '', 'crest');
\dbObject::autoload(realpath(__DIR__ . '/../models'));

return $db;