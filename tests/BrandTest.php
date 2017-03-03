<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once 'src/Brand.php';

$server = 'mysql:host=localhost:3306;dbname=shoes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class BrandTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Brand::deleteAll();
    }

    function test_getId()
    {
        //Arrange
        $name = 'Nike';
        $id = 1;
        $test_Brand = new Brand($name, $id);

        //Act
        $result = $test_Brand->getId();

        //Assert
        $this->assertEquals(1, $result);
    }

    function test_getName()
    {
        //Arrange
        $name = 'Nike';
        $test_Brand = new Brand($name);

        //Act
        $result = $test_Brand->getName();

        //Assert
        $this->assertEquals('Nike', $result);
    }

    function test_setName()
    {
        //Arrange
        $name = 'Nike';
        $new_name = 'Adidas';
        $test_Brand = new Brand($name);

        //Act
        $test_Brand->setName($new_name);
        $result = $test_Brand->getName();

        //Assert
        $this->assertEquals('Adidas', $result);
    }

    function test_save()
    {
        //Arrange
        $name = 'Nike';
        $test_Brand = new Brand($name);

        //Act
        $test_Brand->save();
        $result = Brand::getAll();

        //Assert
        $this->assertEquals([$test_Brand], $result);
    }

    function test_getAll()
    {
        //Arrange
        $name1 = 'Nike';
        $name2 = 'Adidas';
        $test_Brand1 = new Brand($name1);
        $test_Brand1->save();
        $test_Brand2 = new Brand($name2);
        $test_Brand2->save();

        //Act
        $result = Brand::getAll();

        //Assert
        $this->assertEquals([$test_Brand1, $test_Brand2], $result);
    }

    function test_deleteAll()
    {
        //Arrange
        $name1 = 'Nike';
        $name2 = 'Adidas';
        $test_Brand1 = new Brand($name1);
        $test_Brand1->save();
        $test_Brand2 = new Brand($name2);
        $test_Brand2->save();

        //Act
        Brand::deleteAll();
        $result = Brand::getAll();

        //Assert
        $this->assertEquals([], $result);
    }

    function test_find()
    {
        //Arrange
        $name1 = 'Nike';
        $name2 = 'Adidas';
        $test_Brand1 = new Brand($name1);
        $test_Brand1->save();
        $test_Brand2 = new Brand($name2);
        $test_Brand2->save();

        //Act
        $result = Brand::find($test_Brand1->getId());

        //Assert
        $this->assertEquals($test_Brand1, $result);
    }

    function test_update()
    {
        //Arrange
        $name = 'Nike';
        $new_name = 'Adidas';
        $test_Brand = new Brand($name);
        $test_Brand->save();

        //Act
        $test_Brand->update($new_name);
        $result = $test_Brand->getName();

        //Assert
        $this->assertEquals('Adidas', $result);
    }

    function test_delete()
    {
        //Arrange
        $name1 = 'Nike';
        $name2 = 'Adidas';
        $test_Brand1 = new Brand($name1);
        $test_Brand1->save();
        $test_Brand2 = new Brand($name2);
        $test_Brand2->save();

        //Act
        $test_Brand1->delete();
        $result = Brand::getAll();

        //Assert
        $this->assertEquals([$test_Brand2], $result);
    }

    function test_addStore()
    {
        //Arrange
        $name = 'Nike';
        $test_Brand = new Brand($name);
        $test_Brand->save();

        $name = 'Champs';
        $test_Store = new Store($name);
        $test_Store->save();

        //Act
        $test_Brand->addStore($test_Store);
        $result = $test_Brand->getStores();

        //Assert
        $this->assertEquals([$test_Store], $result);
    }

    function test_getStores()
    {
        //Arrange
        $brand_name = 'Nike';
        $test_Shoe = new Brand($brand_name);
        $test_Shoe->save();

        $store_name1 = 'Champs';
        $test_Store1 = new Store($store_name1);
        $test_Store1->save();

        $store_name2 = 'Foot Action';
        $test_Store2 = new Store($store_name2);
        $test_Store2->save();

        //Act
        $test_Shoe->addStore($test_Store1);
        $test_Shoe->addStore($test_Store2);
        $result = $test_Shoe->getStores();

        //Assert
        $this->assertEquals([$test_Store1, $test_Store2], $result);
    }
}
?>
