<?php
require_once 'config/config.php';

// Busca todos os estados
$estados = $conn->query("SELECT * FROM estados ORDER BY nome");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<?php include('./src/includes/header.php'); ?>

<body class="bg-gray-100 text-gray-900">

    <?php include('./src/includes/navbar.php'); ?>

    <div class="max-w-4xl mx-auto">
       <!-- Seção Estados -->
        <section class="mb-8 bg-white p-6 rounded-lg shadow-md" >
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-semibold mb-4">Estados</h2>
                <a href="src/add_estado.php" class="text-blue-600 hover:text-blue-800 font-medium">
                    <i class="fa-solid fa-circle-plus"></i>
                    <span>Adicionar Estado</span>
                </a>
            </div>

            <div class="mt-4">
                <table class="w-full border-collapse border border-gray-300 shadow-md rounded-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">Nome</th>
                            <th class="border border-gray-300 px-4 py-2">UF</th>
                            <th class="border border-gray-300 px-4 py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $estados->fetch_assoc()) : ?>
                            <tr class="odd:bg-gray-50 even:bg-white">
                                <td class="border border-gray-300 px-4 py-2 text-center"><?= $row['id'] ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['nome'] ?></td>
                                <td class="border border-gray-300 px-4 py-2 text-center"><?= $row['sigla'] ?></td>
                                <td class="border border-gray-300 px-4 py-2 text-center flex gap-4 justify-around">
                                    <a href="src/edit_estado.php?id=<?= $row['id'] ?>"
                                        class="text-green-600 hover:text-green-800">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <span>Editar</span> 
                                    </a>
                                    <a href="src/delete_estado.php?id=<?= $row['id'] ?>" 
                                        class="text-red-600 hover:text-red-800" onclick="return confirm('Tem certeza?');">
                                            <i class="fa-solid fa-trash"></i>
                                        <span>Excluir</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>

        
        
    </div>
  <script src="./public/js/searchCities.js"></script>
</body>
</html>