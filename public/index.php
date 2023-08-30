<?php 

require __DIR__ . '/../vendor/autoload.php';

use App\App;
use App\Core\Manager;
use App\Core\Router;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\Template;
use App\Core\Configuration;

$appConfiguration = require_once __DIR__ . '/../resources/app/config.php';
$config = new Configuration();
$config->add('app', $appConfiguration);

$manager = new Manager();
$manager->setConfiguration($config);

$session = new Session();;
$manager->setSession($session);

$router = new Router(new Request($_REQUEST, $manager->getSession()));
$pagesDir = $config->get('app', 'app')['pages_dir'];
$router->setPagesLocation($pagesDir);
$manager->setRouter($router);

$template = new Template();
$templateDir = $config->get('app', 'app')['templates_dir'];
$template->setTemplatePath($templateDir);
$manager->setTemplate($template);

$response = new Response();
$manager->setResponse($response);

$app = new App($manager);
$app->setEnvironment('development');
$app->setTimeZone('Asia/Jakarta');
$app->run();