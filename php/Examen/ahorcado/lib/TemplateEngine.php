<?php

namespace Library;

class TemplateEngine{

    private $template;
    private $variables = array();

    public function __construct($path){
        $this->template = file_get_contents($path);
    }

    public function addVariable($keyword,$variable){
        $this->variables[$keyword] = $variable;
        return True;
    }

    public function render(){
        $copy = $this->template;

        foreach($this->variables as $keyword => $variable){
            $copy = str_replace("{{".$keyword."}}",$variable,$copy);
        }

        $revisedCopy = "";
        $j = 0;

        for($i=0; $i<strlen($copy); $i+=1){
            
            if($copy[$i] === "{" and $copy[$i+1] === "{"){
                $flag = True;

                $j = 1;
                while($flag){

                    if($copy[$i+$j] === "}" and $copy[$i+$j+1] === "}"){
                        $flag = False;
                    }
                    $j+=1;
                }
            }else{
                $i+=$j;
                $revisedCopy = $revisedCopy.$copy[$i];
                $j = 0;
            }
        }
        return $revisedCopy;
    }

    public function keyWords(){

        $keywordList = array();
        $keyword = "";
        $inside = False;

        for ($i=0; $i<strlen($this->template); $i++){
            if ($this->template[$i-2] === "{" and $this->template[$i-1] === "{"){
                $inside = True;
            }
            if ($this->template[$i] === "}" and $this->template[$i+1] === "}"){
                $inside = False;
            }
            if ($inside){
                $keyword.=$this->template[$i];
            }
            if (!$inside and !empty($keyword)){
                
                if(!in_array($keyword,$keywordList)){
                    $keywordList[] = $keyword;
                }
                $keyword = "";
            }
        }

        $keywordList["number"] = count($keywordList);
        
        return $keywordList;
    }
}