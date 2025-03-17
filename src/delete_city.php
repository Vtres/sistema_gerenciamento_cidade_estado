<?php
require_once '../config/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM cidades WHERE id = $id");
}

header("Location: ./view_cities.php");
exit;
