<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('tasksDurable', False, True, False, False);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg){
    echo "[x] Recieved '". $msg->body ."'\n";
    sleep(substr_count($msg->body,'.'));
    echo "[x] Done\n";
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('tasksDurable','',False,False,False,False,$callback);

while($channel->is_consuming()){
    $channel->wait();
}