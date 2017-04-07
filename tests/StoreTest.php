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
}






?>
