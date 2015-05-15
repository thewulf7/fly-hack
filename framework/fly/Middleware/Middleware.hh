<?hh // strict

namespace Fly\Middleware;

use Fly\Http\Request;
use Fly\Http\Response;

interface Middleware
{
    public function handle(Request $request, Response $response): void;
}
