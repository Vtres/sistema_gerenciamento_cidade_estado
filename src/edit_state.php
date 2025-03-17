<?php
require_once '../config/config.php';

$id = $_GET['id'] ?? 0;

// Buscar estado atual
$stmt = $conn->prepare("SELECT * FROM estados WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$estado = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = ucwords(strtolower(trim($_POST['nome'])));
    $uf = strtoupper(trim($_POST['uf']));

    // Validação
    if (empty($uf) || strlen($uf) != 2) {
        echo "<script>document.getElementById('mensagemErro').innerText = 'O UF do estado deve ter exatamente 2 caracteres.';</script>";
        exit;
    }

    // Atualização no banco de dados
    $stmt = $conn->prepare("UPDATE estados SET nome = ?, sigla = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nome, $uf, $id);
    $stmt->execute();
    $stmt->close();
    
    header("Location: ./view_state.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<?php include('./includes/header.php'); ?>

<body class="bg-gray-100 text-gray-900">
    <?php include('./includes/navbar.php'); ?>
    
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md mx-auto mt-10">
        <h2 class="text-xl font-semibold mb-4 text-center">Editar Estado</h2>
        <form method="post" class="space-y-4">
            <div>
                <label class="block text-gray-700">Nome do Estado:</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($estado['nome']) ?>" required class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block text-gray-700">UF:</label>
                <input type="text" name="uf" maxlength="2" value="<?= htmlspecialchars($estado['sigla']) ?>" required class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-400">
                <div id="mensagemErro" class="text-red-500 mt-1 hidden"></div>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition cursor-pointer">Salvar</button>
        </form>
        <a href="../index.php" class="block text-center text-blue-500 mt-4 hover:underline cursor-pointer">Voltar</a>
    </div>
</body>
</html>
