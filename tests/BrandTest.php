<?php
require_once 'src/Brand.php';
class BrandTest extends PHPUnit_Framework_TestCase
{
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
}
?>
