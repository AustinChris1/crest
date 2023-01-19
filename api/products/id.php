<?php

namespace Api;

require_once __DIR__ . "/../../models/Product.php";
require_once __DIR__ . "/../../utils/HttpStatus.php";

use Models\Product;

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $product_id = $_GET["id"];
        $product = Product::where('status', 0)::where('id', $product_id)->getOne();
        
        if (!$product) {
            http_response_code(404);
            echo(HttpStatus->getReasonPhrase(404));
            return;
        }

        $product->reviews = array_map(function ($review) {
            return $review->toArray();
        }, $product->getReviews());

        // echo $product;
        echo($product->toJson());

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