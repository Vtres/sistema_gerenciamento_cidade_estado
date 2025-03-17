<?php
require_once '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = ucwords(strtolower($_POST['name']));
    $uf = strtoupper($_POST['uf']);

    if (empty($uf) || strlen($uf) != 2) {
        echo "O UF do estado deve ter exatamente 2 caracteres." . strlen($uf);
        exit;
    }

    $conn->query("INSERT INTO estados (nome, sigla) VALUES ('$name', '$uf')");
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
            <h2 class="text-xl font-semibold mb-4 text-center">Adicionar Estado</h2>
            <form method="post" onsubmit="return validateStateCode()" class="space-y-4">
                <div>
                    <label class="block text-gray-700">Estado:</label>
                    <input type="text" name="name" required class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-400">
                </div>
                <div>
                    <label class="block text-gray-700">UF:</label>
                    <input type="text" name="uf" maxlength="2" required class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-400">
                    <span class="hidden" id="abbreviationError"></span>
                </div>
                <div id="mensagemErro" class="text-red-500 hidden"></div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition cursor-pointer">Salvar</button>
            </form>
            <a href="../index.php" class="block text-center text-blue-500 mt-4 hover:underline">Voltar</a>
        </div>
        <script src="../public/js/validateStateCode.js"></script>
    </body>
</html>
