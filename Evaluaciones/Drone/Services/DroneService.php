<?php

namespace Service;

class DroneService{

    private $collection;

    public function __construct($collection){
        $this->collection = $collection;
    }

    public function register($name,$prize,$colour,$model){
        $list = $this->list();
        foreach($list as $drone){
            if($drone["name"] == $name){
                return False;
            }
        }
        $this->collection->insertOne(
            array(
                "name" => $name,
                "prize" => $prize,
                "colour" => $colour,
                "model" => $model
            )
        );
        return True;
    }

    public function delete($name){
        $confirm = $this->collection->deleteOne(
            array(
                "name" => $name
            )
        );
        if($confirm->getDeletedCount() == 0){
            return False;
        }
        return True;
    }

    public function list(){
        $cursor = $this->collection->find(array());
        $droneList = array();
        foreach($cursor as $droneInfo){
            $drone = array();
            $drone["name"] = $droneInfo["name"];
            $drone["prize"] = $droneInfo["prize"];
            $drone["colour"] = $droneInfo["colour"];
            $drone["model"] = $droneInfo["model"];
            $droneList[] = $drone;
        }
        return $droneList;
    }
}