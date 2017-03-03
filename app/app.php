<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Brand.php';
    require_once __DIR__.'/../src/Store.php';

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:3306;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get('/', function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get('/brands', function() use ($app) {
        $brands = Brand::getAll();
        return $app['twig']->render('brands.html.twig', array('brands' => $brands));
    });

    $app->post('/brands', function() use ($app) {
        $brand = new Brand($_POST['brand_name']);
        $brand->save();
        $brands = Brand::getAll();
        return $app['twig']->render('brands.html.twig', array('brands' => $brands));
    });

    $app->post('/delete_shoes', function() use ($app) {
        Brand::deleteAll();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    return $app;
?>
