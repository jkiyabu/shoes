<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Store.php';

    $server = 'mysql:host=localhost:3306;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $name = 'Champs';
            $id = 1;
            $test_Store = new Store($name, $id);

            //Act
            $result = $test_Store->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_getName()
        {
            //Arrange
            $name = 'Champs';
            $test_Store = new Store($name);

            //Act
            $result = $test_Store->getName();

            //Assert
            $this->assertEquals('Champs', $result);
        }

        function test_setName()
        {
            //Arrange
            $name = 'Champs';
            $new_name = 'Foot Action';
            $test_Store = new Store($name);

            //Act
            $test_Store->setName($new_name);
            $result = $test_Store->getName();

            //Assert
            $this->assertEquals('Foot Action', $result);
        }

        function test_save()
        {
            //Arrange
            $name = 'Champs';
            $test_Store = new Store($name);

            //Act
            $test_Store->save();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_Store], $result);
        }

        function test_getAll()
        {
            //Arrange
            $name1 = 'Champs';
            $name2 = 'Foot Action';
            $test_Store1 = new Store($name1);
            $test_Store1->save();
            $test_Store2 = new Store($name2);
            $test_Store2->save();
            //Act
            $result = Store::getAll();
            //Assert
            $this->assertEquals([$test_Store1, $test_Store2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name1 = 'Champs';
            $name2 = 'Foot Action';
            $test_Store1 = new Store($name1);
            $test_Store1->save();
            $test_Store2 = new Store($name2);
            $test_Store2->save();

            //Act
            Store::deleteAll();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name1 = 'Champs';
            $name2 = 'Foot Action';
            $test_Store1 = new Store($name1);
            $test_Store1->save();
            $test_Store2 = new Store($name2);
            $test_Store2->save();

            //Act
            $result = Store::find($test_Store1->getId());

            //Assert
            $this->assertEquals($test_Store1, $result);
        }

        function test_update()
        {
            //Arrange
            $name = 'Champs';
            $new_name = 'Foot Action';
            $test_Store = new Store($name);
            $test_Store->save();

            //Act
            $test_Store->update($new_name);
            $result = $test_Store->getName();

            //Assert
            $this->assertEquals('Foot Action', $result);
        }

        function test_delete()
        {
            //Arrange
            $name1 = 'Champs';
            $name2 = 'Foot Action';
            $test_Store1 = new Store($name1);
            $test_Store1->save();
            $test_Store2 = new Store($name2);
            $test_Store2->save();

            //Act
            $test_Store1->delete();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_Store2], $result);
        }

        function test_addBrand()
        {
            //Arrange
            $name1 = 'Champs';
            $test_Store = new Store($name1);
            $test_Store->save();

            $name2 = 'Nike';
            $test_Brand = new Brand($name2);
            $test_Brand->save();

            //Act
            $test_Store->addBrand($test_Brand);
            $result = $test_Store->getBrands();

            //Assert
            $this->assertEquals([$test_Brand], $result);
        }

        function test_getBrands()
        {
            //Arrange
            $name1 = 'Champs';
            $test_Store = new Store($name1);
            $test_Store->save();

            $name2 = 'Nike';
            $test_Brand1 = new Brand($name2);
            $test_Brand1->save();

            $name3 = 'Adidas';
            $test_Brand2 = new Brand($name3);
            $test_Brand2->save();

            //Act
            $test_Store->addBrand($test_Brand1);
            $test_Store->addBrand($test_Brand2);
            $result = $test_Store->getBrands();

            //Assert
            $this->assertEquals([$test_Brand1, $test_Brand2], $result);
        }
    }
?>
