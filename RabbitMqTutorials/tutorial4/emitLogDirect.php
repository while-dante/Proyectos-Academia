<?php

require_once '../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->exchange_declare('directLogs', 'direct', False, False, False);

$severity = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : 'info';
//a la izquierda del '?' es una condicion y a la derecha devuelve $argv[1] si
//la condicion es True o 'info' si es False

$data = implode(' ', array_slice($argv, 2));
if (empty($data)) {
    $data = "info: Hello World!";
}

$msg = new AMQPMessage($data);

$channel->basic_publish($msg, 'directLogs',$severity);

echo ' [x] Sent ', $data, "\n";

$channel->close();
$connection->close();