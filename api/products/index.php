<?php

namespace Api;

require_once __DIR__ . "/../../models/Product.php";

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $products = \Models\Product::where('status', 0)->JsonBuilder()->get();
        
        echo $products;

        break;
    case "POST":
        // add cart item
        break;
    case "DELETE":
        // remove cart item
        break;
    default:
        // 405 err
        break;
} 