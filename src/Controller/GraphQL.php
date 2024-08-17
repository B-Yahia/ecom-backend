<?php

declare(strict_types=1);

namespace Controller;

use RuntimeException;
use GraphQL\GraphQL as GraphQLBase;
use Schema\SchemaSetup;
use Service\OrderService;
use Throwable;

class GraphQL
{
    static public function handle()
    {
        try {
            $rawInput = file_get_contents('php://input');
            if ($rawInput === false) {
                throw new RuntimeException('Failed to get php://input');
            }

            $input = json_decode($rawInput, true);
            $query = $input['query'];
            $variableValues = $input['variables'] ?? null;

            $rootValue = ['prefix' => 'You said: '];
            $result = GraphQLBase::executeQuery(SchemaSetup::getSchema(), $query, $rootValue, null, $variableValues);
            $output = $result->toArray();
        } catch (Throwable $e) {
            $output = [
                'error' => [
                    'message' => $e->getMessage(),
                ],
            ];
        }

        header('Content-Type: application/json; charset=UTF-8');
        return json_encode($output);
    }

    public static function home()
    {
        // echo "<h1> You can see bellow the list of the Orders </h1>";
        $orderService = new OrderService();
        $orders = $orderService->getAllOrders();
        include __DIR__ . "/../../public/orders.php";
        // $data = "";
        // foreach ($orders as $order) {
        //     $data .= "<h4>Order id is " . $order->id . " and total is " . $order->total . "</h4>";
        // }
        // echo $data;
    }
}
