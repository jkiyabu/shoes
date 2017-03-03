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

    $app->post('/delete_brands', function() use ($app) {
        Brand::deleteAll();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    $app->get('/stores', function() use ($app) {
        $stores = Store::getAll();
        return $app['twig']->render('stores.html.twig', array('stores' => $stores));
    });

    $app->post('/stores', function() use ($app) {
        $store = new Store($_POST['store_name']);
        $store->save();
        $stores = Store::getAll();
        return $app['twig']->render('stores.html.twig', array('stores' => $stores));
    });

    $app->post('/delete_stores', function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    return $app;
?>
