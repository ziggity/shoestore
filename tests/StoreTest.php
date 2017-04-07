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
}






?>
