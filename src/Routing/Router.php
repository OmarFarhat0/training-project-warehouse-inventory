<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Routing;

use Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Response\Response;
use Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests\ValidatableRequest;
use Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests\Request;

class Router {
    private array $routes = [];

    public function post (string $path, array $action, string $requestClass = Request::class): void {
        $this->routes["POST"][$path] = [
            'action' => $action,
            'requestClass' => $requestClass
        ];
    }

    public function get (string $path, array $action, string $requestClass = Request::class): void {
        $this->routes["GET"][$path] = [
            'action' => $action,
            'requestClass' => $requestClass
        ];
    }

    public function put (string $path, array $action, string $requestClass = Request::class): void {
        $this->routes["PUT"][$path] = [
            'action' => $action,
            'requestClass' => $requestClass
        ];
    }

    public function dispatch(string $httpMethod, string $uri): void {
        $route = $this->routes[$httpMethod][$uri] ?? null;

        if (!$route) {
            new Response(
                message: 'Route Not Found',
                statusCode: 404
            )->send();
            return;
        }

        $action = $route['action'];
        $requestClass = $route['requestClass'];

        [$conrtoller, $controllerMethod ] = $action;
        $request = new $requestClass();

        if ($request instanceof ValidatableRequest) {
            $request->validate();
        };

        $conrtoller->$controllerMethod($request);
    }
}
