<?php
    class Brand
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
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

        static function find($search_id)
        {
            $found_brand = null;
            $brands = Brand::getAll();
            foreach($brands as $brand) {
                $id = $brand->getId();
                if ($id == $search_id) {
                $found_brand = $brand;
                }
            }
            return $found_brand;
        }

        static function getAll()
        {
            $brands = [];
            $queried_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            foreach ($queried_brands as $brand) {
                $id = $brand['id'];
                $name = $brand['name'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }
    }
?>
