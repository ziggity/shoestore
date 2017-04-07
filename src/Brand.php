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
}





 ?>
