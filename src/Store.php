<?php
class Store
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
        $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $stores = [];
        $queried_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
        foreach ($queried_stores as $store) {
            $id = $store['id'];
            $name = $store['name'];
            $new_store = new Store($name, $id);
            array_push($stores, $new_store);
        }
        return $stores;
    }
    
    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM stores;");
    }
}
?>
