<?php
require('../vendor/autoload.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;
use Shavkat\Kma\db\WebContent;

$servername = "localhost";
$username = "username";
$password = "password";


$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$webContentConn = new WebContent();

$callback = function ($msg) use ($webContentConn){
    $content = file_get_contents($msg->body);
    $webContentConn->add(strlen($content));
    echo strlen($content).PHP_EOL;
};

$channel->basic_consume('test_queue', '', false, true, false, false, $callback);

while ($channel->is_open()) {
    $channel->wait();
}

$channel->close();
$connection->close();
?>
