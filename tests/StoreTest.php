<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

$DB = new PDO('mysql:host=localhost:8889;dbname=shoes_test', "root", "root");
require_once "src/Brand.php";
require_once "src/Store.php";

class StoreTest extends PHPUnit_Framework_TestCase
  {
  protected function tearDown()
  {
    Store::deleteAll();
    Brand::deleteAll();
  }
  function test_save()
  {
      $name = 'Payless';
      $test_store = new Store($name);
      $test_store->save();
      $result = Store::getAll();
      $this->assertEquals($test_store, $result[0]);
  }
  function test_deleteAll()
  {
      $newStore = new Store ("max");
      $newStore->save();
      Store::deleteAll();
      $result = Store::getAll();
      $this->assertEquals($result, []);
  }
  function test_getAll()
  {
      $newStore = new Store ('max');
      $newStore2 = new Store ('jack');
      $newStore->save();
      $newStore2->save();
      $result = Store::getAll();
      $this->assertEquals($result, [$newStore, $newStore2] );
  }
  function test_update()
  {
      $storeName = "shoepalace";
      $storeTest = new Store($storeName);
      $storeTest->save();
      $new_name = "shoesRus";
      $storeTest->setName($new_name);
      $storeTest->update();
      $result = Store::getAll();
      $this->assertEquals([$storeTest], $result);
  }
  function test_addBrand()
  {
      $storeName = "shoeRnice";
      $storeTest = new Store($storeName);
      $storeTest->save();
      $brandName = "Donttreadonme";
      $brandTest = new Brand($brandName);
      $brandTest->save();
      $storeTest->addBrand($brandTest);
      $result = $storeTest->getBrandList();
      $this->assertEquals([$brandTest], $result);
  }
  function test_delete()
  {
      $storeName = "Anker";
      $storeTest = new Store($storeName);
      $storeTest->save();
      $storeName2 = "king";
      $storeTest2 = new Store($storeName2);
      $storeTest2->save();
      $storeTest->delete();
      $result = Store::getAll();
      $this->assertEquals([$storeTest2], $result);
  }
  function test_deleteBrand()
  {
      $storeName = "Tooo";
      $storeTest = new Store($storeName);
      $storeTest->save();
      $brandName = "Nikes";
      $brandTest = new Brand($brandName);
      $brandTest->save();
      $storeTest->addBrand($brandTest);
      $storeTest->deleteBrand($brandTest);
      $result = $storeTest->getBrandList();
      $this->assertEquals([], $result);
  }
  function test_findById()
  {
      $storeName = "ShoesRus";
      $storeTest = new Store($storeName);
      $storeTest->save();
      $storeName2 = "Shoetastic";
      $storeTest2 = new Store($storeName2);
      $storeTest2->save();
      $search_id = $storeTest->getId();
      $result = Store::findById($search_id);
      $this->assertEquals($storeTest, $result);
  }
  function test_getBrandList()
  {
      $storeName = "Orange";
      $storeTest = new Store($storeName);
      $storeTest->save();
      $brandName = "Best";
      $brandTest = new Brand($brandName);
      $brandTest->save();
      $brandName2 = "Fastest";
      $brandTest2 = new Brand($brandName2);
      $brandTest2->save();
      $storeTest->addBrand($brandTest);
      $storeTest->addBrand($brandTest2);
      $result = $storeTest->getBrandList();
      $this->assertEquals([$brandTest, $brandTest2], $result);
  }

}






?>
