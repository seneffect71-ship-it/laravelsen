<?php
$db = 'database/database.sqlite';
$pdo = new PDO('sqlite:'.$db);
$stmt = $pdo->query("PRAGMA table_info('mahasiswa')");
foreach ($stmt as $row) {
    echo implode('|', $row) . PHP_EOL;
}
