<?php

declare(strict_types=1);

namespace Config;

use Dotenv\Dotenv;

class Setup
{
    private static $conn;
    private static $allowed_methods = ['GET', 'POST'];

    public static function cros(string $url): void
    {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: " . $url);
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            }
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
            }
            exit(0);
        }
        // header("Access-Control-Allow-Origin: " . $url);
        // header('Access-Control-Allow-Credentials: true');
        // header('Access-Control-Max-Age: 86400');
        // header("Access-Control-Allow-Methods: GET, POST");
        // header("Access-Control-Allow-Headers: Content-Type, Authorization");
        // if (!in_array($_SERVER['REQUEST_METHOD'], self::$allowed_methods)) {
        //     header('HTTP/1.1 405 Method Not Allowed');
        //     header('Allow: GET, POST');
        //     exit;
        // }
    }

    public static function database(): Database
    {

        $var = Dotenv::createImmutable(__DIR__ . "/../..");
        $var->load();
        return self::$conn ?: (self::$conn = new Database(
            $_ENV['DB_DRIVER'],
            [
                'host' => $_ENV['DB_HOST'],
                'port' => $_ENV['DB_PORT'],
                'dbname' => $_ENV['DB_NAME'],
            ],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD']
        ));
    }
}
