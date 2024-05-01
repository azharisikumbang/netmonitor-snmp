<?php ob_start();

require __DIR__ . '/../vendor/autoload.php';

use App\App;
use App\Core\Database;
use App\Core\Manager;
use App\Core\Router;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\Template;
use App\Core\Configuration;

$appServices = require_once __DIR__ . '/../resources/app/services.php';
$container = new DI\Container($appServices);

$appConfiguration = require_once __DIR__ . '/../resources/app/config.php';

$config = new Configuration();
$config->add('app', $appConfiguration['app']);
$config->add('db', $appConfiguration['database']); // TODO: implementasikan di DI Container

$manager = new Manager();
$manager->setConfiguration($config);

$session = new Session();
$manager->setSession($session);

$router = new Router(new Request($_REQUEST));
$pagesDir = $config->get('app', 'pages_dir');
$router->setPagesLocation($pagesDir);
$manager->setRouter($router);

$template = new Template();
$templateDir = $config->get('app', 'templates_dir');
$template->setTemplatePath($templateDir);
$manager->setTemplate($template);

$response = new Response();
$manager->setResponse($response);

$database = Database::createInstance(
    $config->get('db', 'database'),
    $config->get('db', 'username'),
    $config->get('db', 'password')
);
$manager->setDatabase($database);

$app = new App($manager, $container);
$app->loadFunction('functions');
$app->setEnvironment('development');
$app->setTimeZone('Asia/Jakarta');
$app->run();