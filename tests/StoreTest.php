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
}
?>
