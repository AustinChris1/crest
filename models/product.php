<?php

namespace Models;

require_once __DIR__ . '/../vendor/thingengineer/mysqli-database-class/dbObject.php';

class Product extends \dbObject
{
    protected $dbTable = 'stock';
}