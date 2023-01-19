<?php

namespace Models;

require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . '/../vendor/thingengineer/mysqli-database-class/dbObject.php';
require_once __DIR__ . '/ProductReview.php';

class Product extends \dbObject
{
    protected $dbTable = 'stock';

    function __construct (...$args) {
        parent::__construct(...$args);
        $this->slashed = $this->price + $this->price * 0.2;
    }

    protected function getReviews () {
        return ProductReview::where('product_id', $this->id)->get() ?? [];
    }
}