<?php

namespace Api;

session_start();

require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/cart.php";

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $user_id = $_SESSION["auth_user"]["id"];
        $items = \Models\Cart::where('user_id', $user_id)::where('status', 0)->JsonBuilder()->get();
        
        echo $items;

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