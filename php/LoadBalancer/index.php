<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteContext;

require __DIR__ . '/./vendor/autoload.php';

session_start();

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, array $args){
    $motherLB = new \LB\RoundRobin("mother");
    $firstSonLB = new \LB\RoundRobin("firstSon");
    $secondSonLB = new \LB\Random("secondSon");
    
    $server1 = new \Servers\ServerOk("ok");
    $server11 = new \LB\Counter($server1);
    
    $server2 = new \Servers\ServerFail("fail");
    $server22 = new \LB\Counter($server2);
    
    $server3 = new \Servers\ServerQuirky("q");
    $server33 = new \LB\Counter($server3);
    
    $server4 = new \Servers\ServerDoomsdayClock("clock",4);
    $server44 = new \LB\Counter($server4);
    
    $server5 = new \Servers\ServerRedirect3F("3F");
    $server55 = new \LB\Counter($server5);
    
    $servers = array($server11,$server22,$server33,$server44,$server55);
    
    $secondSonLB->addServer($server11);
    $secondSonLB->addServer($server22);
    $secondSonLB->addServer($server33);
    
    $firstSonLB->addServer($server44);
    $firstSonLB->addServer($server55);
    
    $motherLB->addServer($server11);
    $motherLB->addServer($server22);
    $motherLB->addServer($firstSonLB);
    $motherLB->addServer($server33);
    $motherLB->addServer($secondSonLB);
    
    for($i=0;$i<1000;$i+=1){
        $motherLB->call();
    }

    $data = array();
    
    foreach($servers as $server){
        $data[] = $server->getData();
    }

    $teData = new \LB\TemplateEngine("./templates/dataTemplate.html");

    $i = 1;
    foreach($data as $server){

        $teCalls = new \LB\TemplateEngine("./templates/callsTemplate.html");

        if(array_key_exists(0,$server["calls"])){
            $teCalls->addVariable(0,$server["calls"][0]);
        }else{
            $teCalls->addVariable(0,0);
        }

        if(array_key_exists(200,$server["calls"])){
            $teCalls->addVariable(200,$server["calls"][200]);
        }else{
            $teCalls->addVariable(200,0);
        }

        if(array_key_exists(300,$server["calls"])){
            $teCalls->addVariable(300,$server["calls"][300]);
        }else{
            $teCalls->addVariable(300,0);
        }

        if(array_key_exists(400,$server["calls"])){
            $teCalls->addVariable(400,$server["calls"][400]);
        }else{
            $teCalls->addVariable(400,0);
        }

        if(array_key_exists(500,$server["calls"])){
            $teCalls->addVariable(500,$server["calls"][500]);
        }else{
            $teCalls->addVariable(500,0);
        }

        $teCalls->addVariable("total",$server["total"]);
        $teData->addVariable("server"."$i",$server["name"]);
        $teData->addVariable("data"."$i",$teCalls->render());

        $i += 1;
    }
    $teData->addVariable("genericos","Estadisticas de LBs genericos.");

    $response->getBody()->write($teData->render());

    return $response;
});

$app->get('/generic', function (Request $request, Response $response, array $args){
    $RR1 = new \Strategies\StrategyRoundRobin;
    $RR2 = new \Strategies\StrategyRoundRobin;
    $random = new \Strategies\StrategyRandom;

    $motherLB = new \LB\LoadBalancer("mother",$RR1);
    $firstSonLB = new \LB\LoadBalancer("firstSon",$RR2);
    $secondSonLB = new \LB\LoadBalancer("secondSon",$random);
    
    $server1 = new \Servers\ServerOk("ok");
    $server11 = new \LB\Counter($server1);
    
    $server2 = new \Servers\ServerFail("fail");
    $server22 = new \LB\Counter($server2);
    
    $server3 = new \Servers\ServerQuirky("q");
    $server33 = new \LB\Counter($server3);
    
    $server4 = new \Servers\ServerDoomsdayClock("clock",4);
    $server44 = new \LB\Counter($server4);
    
    $server5 = new \Servers\ServerRedirect3F("3F");
    $server55 = new \LB\Counter($server5);
    
    $servers = array($server11,$server22,$server33,$server44,$server55);
    
    $secondSonLB->addServer($server11);
    $secondSonLB->addServer($server22);
    $secondSonLB->addServer($server33);
    
    $firstSonLB->addServer($server44);
    $firstSonLB->addServer($server55);
    
    $motherLB->addServer($server11);
    $motherLB->addServer($server22);
    $motherLB->addServer($firstSonLB);
    $motherLB->addServer($server33);
    $motherLB->addServer($secondSonLB);
    
    for($i=0;$i<1000;$i+=1){
        $motherLB->call();
    }

    $data = array();
    
    foreach($servers as $server){
        $data[] = $server->getData();
    }

    $teData = new \LB\TemplateEngine("./templates/dataTemplate.html");

    $i = 1;
    foreach($data as $server){

        $teCalls = new \LB\TemplateEngine("./templates/callsTemplate.html");

        if(array_key_exists(0,$server["calls"])){
            $teCalls->addVariable(0,$server["calls"][0]);
        }else{
            $teCalls->addVariable(0,0);
        }

        if(array_key_exists(200,$server["calls"])){
            $teCalls->addVariable(200,$server["calls"][200]);
        }else{
            $teCalls->addVariable(200,0);
        }

        if(array_key_exists(300,$server["calls"])){
            $teCalls->addVariable(300,$server["calls"][300]);
        }else{
            $teCalls->addVariable(300,0);
        }

        if(array_key_exists(400,$server["calls"])){
            $teCalls->addVariable(400,$server["calls"][400]);
        }else{
            $teCalls->addVariable(400,0);
        }

        if(array_key_exists(500,$server["calls"])){
            $teCalls->addVariable(500,$server["calls"][500]);
        }else{
            $teCalls->addVariable(500,0);
        }

        $teCalls->addVariable("total",$server["total"]);
        $teData->addVariable("server"."$i",$server["name"]);
        $teData->addVariable("data"."$i",$teCalls->render());

        $i += 1;
    }

    $teData->addVariable("especificos","Estadisticas de LBs especificos.");

    $response->getBody()->write($teData->render());

    return $response;
});

$app->run();