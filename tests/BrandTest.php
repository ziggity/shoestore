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
      $brandName = "Best shoes ever!";
      $brandTest = new Brand($brandName);
      $brandTest->save();
      $new_name = "too fast too furious";
      $brandTest->setName($new_name);
      $brandTest->update();
      $result = Brand::getAll();
      $this->assertEquals([$brandTest], $result);
  }
  function test_delete()
  {
      $brandName = "Koss";
      $brandTest = new Brand($brandName);
      $brandTest->save();
      $brandName2 = "Apples";
      $brandTest2 = new Brand($brandName2);
      $brandTest2->save();
      $brandTest->delete();
      $result = Brand::getAll();
      $this->assertEquals([$brandTest2], $result);
  }
  function test_findById()
  {
      $brandName = "Orange";
      $brandTest = new Brand($brandName);
      $brandTest->save();
      $brandName2 = "faster";
      $brandTest2 = new Brand($brandName2);
      $brandTest2->save();
      $search_id = $brandTest->getId();
      $result = Brand::findById($search_id);
      $this->assertEquals($brandTest, $result);
  }
  function test_getStoreList()
  {
      $brandName = "Thunda";
      $brandTest = new Brand($brandName);
      $brandTest->save();
      $brandName2 = "bolt";
      $brandTest2 = new Brand($brandName2);
      $brandTest2->save();
      $storeName = "hey";
      $storeTest = new Store($storeName);
      $storeTest->save();
      $storeTest->addBrand($brandTest);
      $storeTest->addBrand($brandTest2);
      $storeName2 = "Yo";
      $storeTest2 = new Store($storeName2);
      $storeTest2->save();
      $storeTest2->addBrand($brandTest);
      $result = $brandTest->getStoreList();
      $this->assertEquals([$storeTest, $storeTest2], $result);
  }

}






?>
