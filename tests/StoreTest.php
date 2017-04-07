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
      // Arrange
      $name = 'Payless';
      $test_store = new Store($name);
      // Act
      $test_store->save();
      // Assert
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
    $store_name = "shoepalace";
    $test_Store = new Store($store_name);
    $test_Store->save();
    $new_name = "shoesRus";
    $test_Store->setName($new_name);
    $test_Store->update();
    $result = Store::getAll();
    $this->assertEquals([$test_Store], $result);
  }
  function test_addBrand()
  {
    $store_name = "shoeRnice";
    $test_Store = new Store($store_name);
    $test_Store->save();
    $brand_name = "Donttreadonme";
    $test_Brand = new Brand($brand_name);
    $test_Brand->save();
    $test_Store->addBrand($test_Brand);
    $result = $test_Store->getBrandList();
    $this->assertEquals([$test_Brand], $result);
  }
  function test_delete()
  {
      $store_name = "Anker";
      $test_Store = new Store($store_name);
      $test_Store->save();
      $store_name2 = "king";
      $test_Store2 = new Store($store_name2);
      $test_Store2->save();
      $test_Store->delete();
      $result = Store::getAll();
      $this->assertEquals([$test_Store2], $result);
  }
  function test_deleteBrand()
  {
      $store_name = "Tooo";
      $test_Store = new Store($store_name);
      $test_Store->save();
      $brand_name = "Nikes";
      $test_Brand = new Brand($brand_name);
      $test_Brand->save();
      $test_Store->addBrand($test_Brand);
      $test_Store->deleteBrand($test_Brand);
      $result = $test_Store->getBrandList();
      $this->assertEquals([], $result);
  }
  function test_findById()
  {
      $store_name = "Shoepocalypse";
      $test_Store = new Store($store_name);
      $test_Store->save();
      $store_name2 = "Shoemageddon";
      $test_Store2 = new Store($store_name2);
      $test_Store2->save();
      $search_id = $test_Store->getId();
      $result = Store::findById($search_id);
      $this->assertEquals($test_Store, $result);
  }

}






?>
