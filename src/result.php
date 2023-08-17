<?php

require('../vendor/autoload.php');


$conn = new \Shavkat\Kma\db\Connection();
$result = $conn->getResultSql('SELECT COUNT(*) AS count_of_item, CAST(created_at / 60 AS INT) AS created_time_minute, AVG(size_content) AS middle_size, CAST(created_at / 60 AS INT) AS created_time_minute, MIN(created_at) as first_item, MAX(created_at) as last_item  FROM `web_content` GROUP BY CAST(created_at / 60 AS INT);');

print_r($result);
