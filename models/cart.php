<?php

namespace Models;

require_once __DIR__ . '/../vendor/thingengineer/mysqli-database-class/dbObject.php';

class Cart extends \dbObject
{
    protected $dbTable = 'cart';
}