<?php

namespace Library;

class UserService{

    private $container;
    private $users;

    public function __construct(){
        $this->container = new \MongoDB\Client("mongodb://localhost");
        $this->users = $this->container->dante->users;
    }

    public function getAllUsers(){
        $cursor = $this->users->find();
        $usersList = array();

        foreach($cursor as $user){
            $usersList[] = $user["name"];
        }

        return $usersList;
    }
    
    public function userExists(string $user){
        $usersList = $this->getAllUsers();
        foreach($usersList as $savedUser){
            if ($user == $savedUser){
                return True;
            }
        }
        return False;
    }
    
    public function saveUser(string $user){
        if ($this->userExists($user)){
            return False;
        }
        $this->users->insertOne(
            array(
                "name" => $user
            )
        );
        return True;
    }

    public function drop(){
        $usersList = $this->getAllUsers();
        foreach($usersList as $user){
            $this->users->deleteOne(array("name" => $user));
        }
    }
}