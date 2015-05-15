<?hh // strict

namespace Fly;

use Fly\Http\Request;
use Fly\Http\Response;
use Fly\Middleware\Route;
use Fly\Middleware\Middleware;
use Fly\Middleware\RouterMiddleware;

type MiddlewareMap = Map<string, Middleware>;

class Application
{
    private Request $request;
    private Response $reponse;
    private MiddlewareMap $middlewares;
    private ?string $currentController;

    public function __construct()
    {
        $this->request = new Request();
        $this->reponse = new Response();
        $this->middlewares['router'] = new RouterMiddleware();
    }

    public function with(string $controller): this
    {
        $this->currentController = $controller;
        return $this;
    }

    public function get(string $path, string $action): this
    {
        $router = $this->getMiddleware('router');
        $router->add($path, $this->currentController, $action);
        return $this;
    }

    public function post(string $path, string $action): this
    {
        $router = $this->getMiddleware('router');
        $router->add($path, $this->currentController, $action);
        return $this;
    }

    public function run(): void
    {
        foreach ($this->middlewares as $middleware) {
            $middleware->handle($this->request, $this->reponse);
        }

        $router = $this->getMiddleware('router');
        echo '<pre>';
        foreach ($router->getRoutes() as $path => $route) {
            echo "path: $path<br>";
            print_r($route);
            echo '-----------------------------------<br>';
        }
    }

    private function getMiddleware(string $name): Middleware
    {
        return $this->middlewares[$name];
    }
}
