<?php
require('../vendor/autoload.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

$channel = $connection->channel();

$channel->exchange_declare('test_exchange', 'direct', false, false, false);
$channel->queue_declare('test_queue', false, false, false, false);
$channel->queue_bind('test_queue', 'test_exchange', 'test_key');


$urls = [
    'https://codeforces.com/contests',
    'https://github.com/ShavkatAminov',
    'https://oilprice.com/oil-price-charts/',
    'https://www.xe.com/currencycharts/?from=USD&to=RUB&view=12H',
    'https://www.co2.earth/daily-co2',
    'https://rutracker.net/forum/viewforum.php?f=252',
    'https://kun.uz/news/list',
    'https://yandex.uz/pogoda/maps/temperature?ll=-64.445663_65.984883&z=4&lat=67.86327179105155&lon=-47.65855337500006&le_TemperatureBalloons=0&le_WindParticles=1',
    'https://hh.ru/',
    'https://daryo.uz/category/dunyo',
];
foreach ($urls as $url) {
    $msg = new AMQPMessage($url);
    $channel->basic_publish($msg, 'test_exchange', 'test_key');
    $sleepTime = rand(5, 30);
    print_r($url.PHP_EOL);
    sleep($sleepTime);
}
$channel->close();
$connection->close();
