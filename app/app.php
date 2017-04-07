<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Store.php";
  require_once __DIR__.'/../src/Brand.php';

  use Symfony\Component\Debug\Debug;
  Debug::enable();

  $app = new Silex\Application();
  $DB = new PDO('mysql:host=localhost:8889;dbname=shoes', 'root', 'root');
  $app['debug'] = true;
  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

  $app->get("/", function() use ($app) {
    return $app['twig']->render('index.html.twig');
  });

  $app->get("/stores", function() use ($app) {
    return $app['twig']->render('stores.html.twig', array("stores" => Store::getAll()));
  });
  $app->get("/brands", function() use ($app) {
    return $app['twig']->render('brands.html.twig', array("brands" => Brand::getAll()));
  });
  $app->get("/addstore", function() use ($app) {
        return $app['twig']->render('addstore.html.twig', array("stores" => Brand::getAll()));
  });
  return $app;
 ?>
