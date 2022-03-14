<?php 

$config = [
    'host' => '',
    'dbname' => '',
    'username' => '',
    'password' => '',
    'tablename' => '',
];

$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try{
    $db = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['username'], $config['password'], $opt);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo "An error occurs when connecting to db: ".$e->getMessage();
    exit();
}
