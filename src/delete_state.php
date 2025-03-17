<?php
require_once '../config/config.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Garantindo que seja um número inteiro para segurança

    // Excluir todas as cidades associadas ao estado primeiro
    $conn->query("DELETE FROM cidades WHERE estado_id = $id");

    // Agora pode excluir o estado
    $conn->query("DELETE FROM estados WHERE id = $id");

    header("Location: ./view_state.php");
    exit;
}
