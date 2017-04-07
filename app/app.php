<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Brand.php';
    require_once __DIR__.'/../src/Store.php';

    $app = new Silex\Application();
    $DB = new PDO('mysql:host=localhost:8889;dbname=shoes', 'root', 'root');
      $app['debug'] = true;

    use Symfony\Component\Debug\Debug;
    Debug::enable();


    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get('/', function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get('/stores', function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post('/stores', function() use ($app) {
        $store_name = $_POST['store_name'];
        $new_store = new Store($store_name);
        $new_store->save();
        return $app['twig']->render("stores.html.twig", array( "stores" => Store::getAll()));

    });
    $app->get('/store/{store_id}', function($store_id) use ($app) {
        $store = Store::findById($store_id);
        $store_brands = $store->getBrandList();
        $all_brands = Brand::getAll();
        return $app['twig']->render('store.html.twig', array('store' => $store, 'store_brands' => $store_brands, 'all_brands' => $all_brands));
    });

    $app->patch('/store/{store_id}', function($store_id) use ($app) {
        $store = Store::findById($store_id);
        $new_name = $_POST['store_name'];
        $store->setName($new_name);
        $store->update();
        return $app->redirect('/store/' . $store_id);
    });

    $app->delete('/store/{store_id}', function($store_id) use ($app) {
        $store = Store::findById($store_id);
        $store->delete();
        return $app->redirect('/stores');
    });

    $app->post('/store/{store_id}/add_brand', function($store_id) use ($app) {
        $store = Store::findById($store_id);
        $brand_id = $_POST['brand_id'];
        $brand = Brand::findById($brand_id);
        $store->addBrand($brand);
        return $app->redirect('/store/' . $store_id);
    });

    $app->delete('/store/{store_id}/remove_brand', function($store_id) use ($app) {
        $store = Store::findById($store_id);
        $brand_id = $_POST['brand_id'];
        $brand = Brand::findById($brand_id);
        $store->deleteBrand($brand);
        return $app->redirect('/store/' . $store_id);
    });
    $app->get('/brands', function() use ($app) {
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });
    $app->post('/brands', function() use ($app) {
        $brand_name = $_POST['brandName'];
        $new_brand = new Brand($brand_name);
        $new_brand->save();
        return $app->redirect('/brands');
    });
    $app->get('/brand/{brand_id}', function($brand_id) use ($app) {
        $brand = Brand::findById($brand_id);
        $brand_stores = $brand->getStoreList();
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'brand_stores' => $brand_stores, 'all_stores' => Store::getAll()));
    });

    $app->delete('/brand/{brand_id}', function($brand_id) use ($app) {
        $brand = Brand::findById($brand_id);
        $brand->delete();
        return $app->redirect('/brands');
    });

    $app->patch('/brand/{brand_id}', function($brand_id) use ($app) {
        $brand = Brand::findById($brand_id);
        $new_name = $_POST['brandName'];
        $brand->setName($new_name);
        $brand->update();
        return $app->redirect('/brand/' . $brand_id);
    });

    $app->post('/brand/{brand_id}/addBrandStore', function($brand_id) use ($app) {
        $brand = Brand::findById($brand_id);
        $store_id = $_POST['store_id'];
        $store = Store::findById($store_id);
        $store->addBrand($brand);
        return $app->redirect('/brand/' . $brand_id);
    });

    $app->delete('/brand/{brand_id}/remove_brand', function($brand_id) use ($app) {
        $brand = Brand::findById($brand_id);
        $store_id = $_POST['store_id'];
        $store = Store::findById($store_id);
        $store->deleteBrand($brand);
        return $app->redirect('/brand/' . $brand_id);
    });

    return $app;
 ?>
