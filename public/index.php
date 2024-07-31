<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";

use Entities\Currency;
use GraphQL\GraphQL;
use Repository\CurrencyRepository;
use Schema\SchemaSetup;
use Service\ProductService;


$repo = new CurrencyRepository();

// print_r($repo->getCurrencyId(1));
$curen = $repo->getCurrencyId(1);
$curen['id'] = 1;

$currency = new Currency($curen);

print_r($currency);

// $service = new ProductService();
// print_r($service->getProductById(1));



// try {
//     $schema = SchemaSetup::getSchema();

//     $rawInput = file_get_contents('php://input');
//     if ($rawInput === false) {
//         throw new RuntimeException('Failed to get php://input');
//     }

//     $input = json_decode($rawInput, true);
//     $query = $input['query'];
//     $variableValues = $input['variables'] ?? null;

//     $rootValue = ['prefix' => 'You said: '];
//     $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
//     $output = $result->toArray();
// } catch (Throwable $e) {
//     $output = [
//         'error' => [
//             'message' => $e->getMessage(),
//         ],
//     ];
// }

// header('Content-Type: application/json; charset=UTF-8');
// echo json_encode($output, JSON_THROW_ON_ERROR);
