<?php

namespace Library;

class FileStore{

    private $filePath = "";

    public function __construct(string $name){
        $this->filePath = "../files/".$name;
        if(!file_exists($this->filePath)){
            file_put_contents($this->filePath,"");
        }
    }

    public function read(){
        $content = file_get_contents($this->filePath);
        $data = explode(",\n",$content);
        return $data;
    }

    public function save(array $data){
        $path = $this->filePath;
        $content = implode(",\n",$data);
        file_put_contents($path,$content);
        return True;
    }
}