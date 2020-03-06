<?php

namespace Library;

class UserService{

    public function getAllUsers(){
        $usersFile = new \Library\FileStore('users.data');
        $usersList = $usersFile->read();
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
        $usersList = $this->getAllUsers();
        $usersList[] = $user;
        $users = array();

        foreach($usersList as $u){
            if(!empty($u)){
                $users[] = $u;
            }
        }

        $usersFile = new \Library\FileStore('users.data');
        $usersFile->save($users);
        return True;
    }
}