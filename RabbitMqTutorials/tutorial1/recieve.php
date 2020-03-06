<?php

require_once '../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function($msg){
    echo '[x] Recieved ' . $msg->body ."\n";
};

$channel->basic_consume('hello','',False,False,False,False,$callback);

while($channel->is_consuming()){
    $channel->wait();
}