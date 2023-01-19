<?php

namespace Models;

require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . '/../vendor/thingengineer/mysqli-database-class/dbObject.php';

class Product extends \dbObject
{
    protected $dbTable = 'stock';

    protected $relations = [
        'reviews' => ['hasMany', 'ProductReview', 'product_id']
    ];
}