<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

$DB = new PDO('mysql:host=localhost:8889;dbname=shoes_test', "root", "root");
require_once "src/Brand.php";
require_once "src/Store.php";
class BrandTest extends PHPUnit_Framework_TestCase
{
  protected function tearDown()
  {
    Store::deleteAll();
    Brand::deleteAll();

  }
    function test_save()
    {
      $name = 'E';
      $test_brand = new Brand($name);
      $test_brand->save();
      $result = Brand::getAll();
      $this->assertEquals([$test_brand], $result);
    }

    function test_deleteAll()
    {
      $newBrand = new Brand ("max");
      $newBrand->save();
      Brand::deleteAll();
      $result = Brand::getAll();
      $this->assertEquals($result, []);
    }
    function test_getAll()
    {
    $newBrand = new Brand ('tar');
    $newBrand2 = new Brand ('jax');
    $newBrand->save();
    $newBrand2->save();
    $result = Brand::getAll();
    $this->assertEquals($result, [$newBrand, $newBrand2] );
    }
    function test_update()
    {
    $brand_name = "Best shoes ever!";
    $test_Brand = new Brand($brand_name);
    $test_Brand->save();
    $new_name = "too fast too furious";
    $test_Brand->setName($new_name);
    $test_Brand->update();
    $result = Brand::getAll();
    $this->assertEquals([$test_Brand], $result);
    }
  }






?>
