<?php

require_once 'PHPUnit/Framework.php';
require_once '../src/Ilib/ClassLoader.php';

class ClassLoaderTest extends PHPUnit_Framework_TestCase 
{
    
    
    function testAutoload() {
        
        spl_autoload_register(Array('Ilib_ClassLoader', 'autoload'));
        
        $test = new Example_Test();
        $this->assertTrue($test->test());
        
        spl_autoload_register();
        
    }
}
?>
