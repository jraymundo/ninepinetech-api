<?php

namespace App\Resolvers;

trait ResponseResolver
{
    /**
     * @param $params
     */
    public function createResponse($params)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        http_response_code(201);

        echo json_encode($params);

        exit();
    }

    /**
     * @param $params
     */
    public function okResponse($params)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        http_response_code(200);

        echo json_encode($params);

        exit();
    }

    /**
     * @param string $message
     */
    public function unprocessableEntity($message)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');

        http_response_code(422);

        echo json_encode(['message' => $message]);

        exit();
    }
}
