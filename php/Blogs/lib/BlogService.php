<?php

namespace Library;

class BlogService{

    private $container;
    private $blogs;

    public function __construct(){
        $this->container = new \MongoDB\Client("mongodb://localhost");
        $this->blogs = $this->container->dante->blogs; 
    }

    public function savePost(string $content, string $user){
        $users = new UserService;
        if($users->userExists($user)){
            $posts = $this->getAllPosts($user);
            $this->blogs->insertOne(
                array(
                    "user" => $user,
                    "content" => $content
                )
            );
        }
    }

    public function getAllPosts(string $user){
        $cursor = $this->blogs->find(array("user" => $user));
        $blogsList = array();

        foreach($cursor as $blog){
            $blogsList[] = $blog["content"];
        }
        return $blogsList;
    }

    public function drop(){
        $this->blogs->drop();
    }
}