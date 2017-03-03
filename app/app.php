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

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get('/', function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get('/brands', function() use ($app) {
        $brands = Brand::getAll();
        return $app['twig']->render('brands.html.twig', array('brands' => $brands));
    });

    $app->get('brands/{id}', function($id) use ($app) {
        $brand = Brand::find($id);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->get('/brands/{id}/edit', function($id) use ($app) {
        $brand = Brand::find($id);
        return $app['twig']->render('brand_edit.html.twig', array('brand' => $brand));
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

    $app->patch('/brands/{id}', function($id) use ($app) {
        $new_brand = $_POST['brand'];
        $brand = Brand::find($id);
        $brand->update($new_brand);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->delete('/brands/{id}', function($id) use ($app) {
        $brand = Brand::find($id);
        $brand->delete();
        return $app->redirect("/brands");
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

    $app->post('/add_store', function() use ($app) {
        $store = Store::find($_POST['store_id']);
        $brand = Brand::find($_POST['brand_id']);
        $brand->addStore($store);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'brands' => Brand::getAll(), 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    return $app;
?>
