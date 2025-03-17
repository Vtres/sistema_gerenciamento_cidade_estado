<?php
require_once '../config/config.php';

// Buscar estados para dropdown
$estados = $conn->query("SELECT * FROM estados ORDER BY nome");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = ucwords(strtolower($_POST['nome']));
    $estado_id = $_POST['estado_id'];
    $conn->query("INSERT INTO cidades (nome, estado_id) VALUES ('$nome', '$estado_id')");
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
        <h2 class="text-xl font-semibold mb-4 text-center">Adicionar Cidade</h2>

        <form method="post" class="space-y-4">
            <label class="block text-gray-700">Nome da Cidade:</label>
            <input class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-400" type="text" name="nome"
                required>

            <label class="block text-gray-700">Estado:</label>
            <select class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-400" name="estado_id" required>
                <?php while ($row = $estados->fetch_assoc()) : ?>
                <option
                    value="<?= $row['id'] ?>">
                    <?= $row['nome'] ?></option>
                <?php endwhile; ?>
            </select>

            <button class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition cursor-pointer"
                type="submit">Salvar</button>
        </form>
        <a class="block text-center text-blue-500 mt-4 hover:underline" href="../index.php">Voltar</a>
    </div>
</body>

</html>