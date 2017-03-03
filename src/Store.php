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

    static function find($search_id)
    {
        $found_store = null;
        $stores = Store::getAll();
        foreach($stores as $store) {
            $id = $store->getId();
            if ($id == $search_id) {
            $found_store = $store;
            }
        }
        return $found_store;
    }

    function update($new_name)
    {
        $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
        $this->setName($new_name);
    }
    
    function delete()
    {
        $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
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
