<?php
  class Brand
{
    private $name;
    private $id;

    function __construct($name, $id=null)
    {
        $this->name =$name;
        $this->id = $id;
    }
    function getName()
    {
        return $this->name;
    }
    function setName($new_name)
    {
        $this->name = $new_name;
    }
    function getId()
    {
        return $this->id;
    }
    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }
    static function getAll()
    {
        $brand = array();
        $returned_brands = $GLOBALS['DB']->query('SELECT * FROM brands;');
        foreach($returned_brands as $brands)
        {
          $newBrand = new Brand($brands['name'],  $brands["id"]);
          array_push($brand, $newBrand);
        }
        return $brand;
    }
    function delete()
    {
      $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->id};");
      $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE brand_id = {$this->id};");
    }
    static function deleteAll()
    {
        $deleteAll = $GLOBALS['DB']->exec("DELETE FROM brands;");
        if ($deleteAll)
        {
          return true;
        }else {
          return false;
        }
    }
    function update()
    {
        $GLOBALS['DB']->exec("UPDATE brands SET name = '{$this->name}' WHERE id = {$this->id};");
    }
    function getStoreList()
    {
        $returned_store_ids = $GLOBALS['DB']->query("SELECT brands_stores.store_id FROM brands JOIN brands_stores on (brands.id = brands_stores.brand_id) WHERE brands.id = {$this->id};");
        $stores = array();
        foreach($returned_store_ids as $id) {
            $search_id = $id['store_id'];
            array_push($stores, Store::findById($search_id));
        }
        return $stores;
    }
    static function findById($search_id)
    {
        $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands WHERE id = {$search_id};");
        foreach($returned_brands as $brand) {
            $id = $brand['id'];
            $name = $brand['name'];
            return new Brand($name, $id);
      }
    }
  }

 ?>
