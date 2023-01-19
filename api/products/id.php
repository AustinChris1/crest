<?php

namespace Api;

require_once __DIR__ . "/../../models/Product.php";
require_once __DIR__ . "/../../utils/HttpStatus.php";

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $product_id = $_GET["id"];
        $product = \Models\Product::where('status', 0)::where('id', $product_id)->getOne();
        
        if (!$product) {
            http_response_code(404);
            return HttpStatus->getReasonPhrase(404);
        }

        // echo $product;
        var_dump($product->reviews);

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