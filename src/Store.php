<?php
  class Store
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
          $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
          $this->id = $GLOBALS['DB']->lastInsertId();
      }
    static function getAll()
      {
        $stores = array();
        $returned_stores = $GLOBALS['DB']->query('SELECT * FROM stores;');
        foreach($returned_stores as $store)
        {
          $newStore = new Store($store['name'], $store["id"]);
          array_push($stores, $newStore);
        }

        return $stores;
      }
      static function deleteAll()
      {
         $GLOBALS['DB']->exec("DELETE FROM stores;");
         $GLOBALS['DB']->exec("DELETE FROM brands_stores;");

      }
    function update()
      {
        $GLOBALS['DB']->exec("UPDATE stores SET name = '{$this->name}' WHERE id = {$this->id};");
      }
      function getBrandList()
      {
        $returned_brand_ids = $GLOBALS['DB']->query("SELECT brands_stores.brand_id FROM stores
          JOIN brands_stores ON (stores.id = brands_stores.store_id)
          WHERE stores.id = {$this->id};");
        $brands = array();
        foreach($returned_brand_ids as $id) {
            $search_id = $id['brand_id'];
            array_push($brands, Brand::findById($search_id));
        }
        return $brands;
      }
    function addBrand($brand)
      {
        $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$brand->getId()}, {$this->id});");
      }
      static function findById($search_id)
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$search_id};");
            foreach ($returned_stores as $store) {
                $id = $store['id'];
                $name = $store['name'];
                return new Store($name, $id);
            }
        }
    }

 ?>
