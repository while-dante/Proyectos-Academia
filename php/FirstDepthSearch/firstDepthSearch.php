<?php

class DepthFirstSearch{

    private function getCurrentDir(){
        $currentDir = getcwd();
        return $currentDir;
    }

    private function getChildren($currentDir){
        $children = scandir($currentDir);
        return $children;
    }

    private function exploreChild($child){
        return chdir($child);
    }

    public function search($startDir,$target){
        $dirArray = explode('/',$startDir);
        $dirName = array_pop($dirArray);

        if($dirName == $target){
            return $this->getCurrentDir();
        }
        $children = $this->getChildren($startDir);
    
        if(is_array($children)){
            
            foreach($children as $child){
                $this->exploreChild($child);
                $result = $this->search($child,$target);
                if($result != 'Not Found'."\n"){
                    return $result;
                }
            }
        }
        return 'Not Found'."\n";
    }
}

$DFS = new DepthFirstSearch();

echo $DFS->search('/home/pelusod','Laberinto');
