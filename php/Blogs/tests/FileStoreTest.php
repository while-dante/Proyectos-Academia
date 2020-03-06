<?php

use PHPUnit\Framework\TestCase;

final class FileStoreTest extends TestCase{

    public function testClassExists(){
        $this->assertTrue(class_exists("\Library\FileStore"));
        $file = new \Library\FileStore("fileName.data");
        $this->assertFalse(empty($file));
        unlink("files/fileName.data");
    }

    public function testRead(){
        $file = new \Library\FileStore("fileName.data");
        $content = $file->read();
        $this->assertFalse(empty($content));
        $this->assertEquals(array(""),$content);
        unlink("files/fileName.data");
    }

    public function testSave(){
        $file = new \Library\FileStore("fileName.data");
        $names = array("Fulano","Mengano");

        $this->assertTrue($file->save($names));
        $this->assertEquals($names,$file->read());
        unlink("files/fileName.data");
    }
}