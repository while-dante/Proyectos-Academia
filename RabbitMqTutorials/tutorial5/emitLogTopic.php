<?php

require_once '../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->exchange_declare('topicLogs', 'topic', False, False, False);

$routingKey = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : '#.default';
//a la izquierda del '?' es una condicion y a la derecha devuelve $argv[1] si
//la condicion es True o 'info' si es False

$data = implode(' ', array_slice($argv, 2));
if (empty($data)) {
    $data = "empty message";
}

$msg = new AMQPMessage($data);

$channel->basic_publish($msg, 'topicLogs', $routingKey);

echo ' [x] Sent ', $routingKey, ': ', $data, "\n";

$channel->close();
$connection->close();