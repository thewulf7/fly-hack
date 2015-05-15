<?hh // strict

namespace Fly\Middleware;

use Fly\Http\Request;
use Fly\Http\Response;

type Route = shape('controller' => string, 'action' => string);
type RoutesMap = Map<string, Route>;

class RouterMiddleware implements Middleware
{
    private RoutesMap $routes;

    public function __construct()
    {
        $this->routes['init'] = shape(
            'controller' => 'string',
            'action' => 'string'
        );
    }

    public function add(string $path, string $controller, string $action): void
    {
        $this->routes[$path] = shape(
            'controller' => $controller,
            'action' => $action
        );
    }

    public function handle(Request $request, Response $response): void
    {
        $route = $this->getRoute($request->getPath());
        $controllerClass = 'Application\Controller\\' . $route['controller'];
        $controller = new $controllerClass();
        $action = inst_meth($controller, $route['action']);
        $action();
    }

    public function getRoute(string $path): Route
    {
        return $this->routes[$path];
    }

    public function getRoutes(): array<string, array>
    {
        return $this->routes;
    }
}
