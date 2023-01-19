<?php

namespace Api;

session_start();

require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/Cart.php";
require_once __DIR__ . "/../models/Product.php";
require_once __DIR__ . "/../utils/HttpStatus.php";
require_once __DIR__ . "/../utils/Request.php";

use Models\Cart;
use Models\Product;


$user_id = $_SESSION["auth_user"]["id"];

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $items = Cart::where('user_id', $user_id)::where('status', 0)->JsonBuilder()->get();
        
        echo $items;

        break;
    case "POST":
        $product_id = $_JSON["product_id"];
        $product = Product::where('id', $product_id);
        
        if (!$product_id) {
            http_response_code(404);
            echo(json_encode([
                "error" => "product not found!"
            ]));
            return;
        }

        $cart_item = Cart::where('stock_id', $product_id)::where('user_id', $user_id)::where('status', 0)->getOne();
        
        if (!$cart_item) {
            $new_cart_item = new Cart([
                "stock_id" => $product_id,
                "user_id" => $user_id,
                "color" => "",
                "size" => "",
                "quantity" => 1,
                "date" => $db->now()
            ]);
            $new_cart_item->save();
        }
        else {
            $cart_item->quantity += 1;
            $cart_item->save();
        }

        http_response_code(200);
        echo(json_encode([
            "message" => "added item to cart."
        ]));

        break;
    case "DELETE":
        // remove cart item
        break;
    default:
        // 405 err
        break;
} 