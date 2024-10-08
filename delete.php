<?php
require_once 'koneksi_database.php';
require_once 'werehouse.php';

$database = new Database();
$db = $database->mendapatkan_koneksi();

$werehouse = new Werehouse($db);

$werehouse->id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Missing ID.');
$werehouse->delete();

header("Location: index.php");
exit;
