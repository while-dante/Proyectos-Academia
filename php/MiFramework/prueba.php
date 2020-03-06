<?php

require_once("TemplateEngine.php");

/*
$template = new TemplateEngine("index.template");

$template->addVariable("cabecera","Soy una Cabecera de prueba");
//$template->addVariable("titulo","Soy un Titulo de prueba");
$template->addVariable("parrafo","Soy un Parrafo de prueba");


$templateReplaced = $template->render();

echo $templateReplaced."\n";

$keyWords = $template->keyWords();

print_r($keyWords);
*/

$playbook = new TemplateEngine("playbook.template");

$playbook->addVariable("PLAYBOOK","The Biter");
$playbook->addVariable("SUMMARY","It bites...");
$playbook->addVariable("STATNAME1","MUSCLE");
$playbook->addVariable("STATVALUE1","5");
$playbook->addVariable("STATNAME2","BRAIN");
$playbook->addVariable("STATVALUE2","2");
$playbook->addVariable("STATNAME3","SCENSES");
$playbook->addVariable("STATVALUE3","3");
$playbook->addVariable("STATNAME4","SAVAGERY");
$playbook->addVariable("STATVALUE4","4");
$playbook->addVariable("MOVENAME1","Blood Lust");
$playbook->addVariable("TRIGGER1","you taste blood for the first time this session");
$playbook->addVariable("DESCRIPTION1","Roll +SAVAGERY,<br> on 10+: take +1 ongoing while pursuing your victim <br> on a 7-9:");


$render = $playbook->render();

echo $render;