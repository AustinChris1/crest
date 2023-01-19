<?php

namespace Models;

require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . '/../vendor/thingengineer/mysqli-database-class/dbObject.php';
require_once __DIR__ . '/ProductReview.php';

class Product extends \dbObject
{
    protected $dbTable = 'stock';

    protected function getReviews () {
        return ProductReview::where('product_id', $this->id)->get() ?? [];
    }
}