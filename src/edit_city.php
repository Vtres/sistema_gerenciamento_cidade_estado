<?php
require_once '../config/config.php';

$id = $_GET['id'];


// Prevenção de SQL Injection
$stmt = $conn->prepare("SELECT * FROM cidades WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$cidade = $stmt->get_result()->fetch_assoc();

// Buscar estados
$estados = $conn->query("SELECT * FROM estados ORDER BY nome");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $estado_id = $_POST['estado_id'];

    // Atualizar tanto o nome quanto o estado da cidade
    $stmt = $conn->prepare("UPDATE cidades SET nome = ?, estado_id = ? WHERE id = ?");
    $stmt->bind_param("sii", $nome, $estado_id, $id);
    $stmt->execute();

    header("Location: ./view_cities.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <?php include('./includes/header.php'); ?>

    <body class="bg-gray-100 text-gray-900">

        <?php include('./includes/navbar.php'); ?>
        
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md mx-auto mt-10">
            <h2 class="text-xl font-semibold mb-4 text-center">Editar Cidade</h2>
            <form method="post" class="space-y-4">
                <div>
                    <label class="block text-gray-700">Nome da Cidade:</label>
                    <input type="text" name="nome" value="<?= htmlspecialchars($cidade['nome']) ?>" required class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-400">
                </div>
                <div>
                    <label class="block text-gray-700">Estado:</label>
                    <select name="estado_id" required class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-400">
                        <?php while ($estado = $estados->fetch_assoc()): ?>
                            <option value="<?= $estado['id'] ?>" <?= $estado['id'] == $cidade['estado_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($estado['nome']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition cursor-pointer">Salvar</button>
            </form>
            <a href="./view_cities.php" class="block text-center text-blue-500 mt-4 hover:underline cursor-pointer">Voltar</a>
        </div>
    </body>
</html>
