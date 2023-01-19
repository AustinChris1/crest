<?php

namespace Models;

require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . '/../vendor/thingengineer/mysqli-database-class/dbObject.php';

class ProductReview extends \dbObject
{
    protected $dbTable = 'review_table';
}