<?php

class Router{

    private $routeList = array();

    public function addRoute($regex,$target){

        if(is_string($regex) and !array_key_exists("#".$regex."#",$this->routeList)){
            $this->routeList["#".$regex."#"] = $target;
            return True;
        }else{
            return False;
        }
    }

    public function match($path){
        
        foreach($this->routeList as $regex => $target){

            $r = preg_match_all($regex,$path);
            
            if($r>0){
                return $target;
            }
        }
        return False;
    }
}