<?hh

require_once __DIR__.'/../vendor/autoload.php';

$app = new \Fly\Application();

$app->with('MainController')
    ->get('/', 'home');

$app->with('AssociateController')
    ->get( '/associates',    'show') // list is resever word ????
    ->get( '/associate/:id', 'find')
    ->post('/associate/:id', 'update')
    ->post('/associate',     'create');

$app->run();
