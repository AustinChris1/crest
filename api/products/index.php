<?php

namespace Api;

require_once __DIR__ . "/../../models/Product.php";

use Models\Product;

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $products = array_map(function ($product) {
            $product->reviews = array_map(function ($review) {
                return $review->toArray();
            }, $product->getReviews());
            return $product->toArray();
        }, Product::where('status', 0)->get());

        echo json_encode($products);

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