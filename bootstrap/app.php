<?php
use Slim\Http\Request;
use Slim\Http\Response;

$app = new \Slim\App([
	'settings' => [
		'displayErrorDetails' => true
	]
]);

$container = $app->getContainer();

$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

$container['view'] = function ($container) {
	$view = new \Slim\Views\Twig(__DIR__ . '/../public/resources/views', [
		'cache' => false
	]);

	$router = $container->get('router');
	$uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
	$view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

	return $view;
};

?>