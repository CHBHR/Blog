<?php

declare(strict_types=1);

// echo "index";
// echo "</br>";

// switch($request) {
//     case '/src/':
//         header("Location: /controller/AccueilController.php");
//         break;
//     case '/':
//         require_once __DIR__ . '/controller/AccueilController.php';
//         break;
//     case '':
//         require_once __DIR__ . '/controller/AccueilController.php';
//         break;
//     default:
//         http_response_code(404);
//         //require_once __DIR__ . '/views/404.php';
//         echo" 404 ";
//         break;
// }

// echo "end index";

require_once("controller/Routeur.php");

$routeur = new Routeur();

$routeur->routeReq();
