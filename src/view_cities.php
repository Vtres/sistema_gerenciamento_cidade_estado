<?php
require_once '../config/config.php';

// Busca todas as cidades
$cidades = $conn->query("SELECT cidades.id, cidades.nome AS cidade, estados.nome AS estado 
                         FROM cidades JOIN estados ON cidades.estado_id = estados.id 
                         ORDER BY estados.nome, cidades.nome");

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <?php include('./includes/header.php'); ?>

<body class="bg-gray-100 text-gray-900">

    <?php include('./includes/navbar.php'); ?>

    <section class="max-w-4xl mx-auto mt-10">
        <!-- Seção Cidades -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-semibold mb-4">Cidades</h2>
                
                <div class="relative mb-4 max-w-xs w-full">
                    <input type="text" id="searchInput" onkeyup="filterTable()" 
                        class="w-full py-2 pl-10 pr-4 rounded-full bg-gray-100 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Pesquisar cidade..." />

                    <!-- Ícone de pesquisa -->
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                </div>

                <a href="./create_city.php" class="text-blue-600 hover:text-blue-800 font-medium">
                    <i class="fa-solid fa-circle-plus"></i>
                    <span>Adicionar Cidade</span>
                </a>
            </div>

            <div class="mt-4">
                
                <table class="w-full border-collapse border border-gray-300 shadow-md rounded-lg" id="dataTable">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">Cidade</th>
                            <th class="border border-gray-300 px-4 py-2">Estado</th>
                            <th class="border border-gray-300 px-4 py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $cidades->fetch_assoc()) : ?>
                            <tr class="odd:bg-gray-50 even:bg-white">
                                <td class="border border-gray-300 px-4 py-2 text-center"><?= $row['id'] ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['cidade'] ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['estado'] ?></td>
                                <td class="border border-gray-300 px-4 py-2 text-center flex gap-4 justify-around">
                                    <a href="./edit_city.php?id=<?= $row['id'] ?>" class="text-green-600 hover:text-green-800">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <span>Editar</span> 
                                    </a>
                                    <a href="./delete_city.php?id=<?= $row['id'] ?>" class="text-red-600 hover:text-red-800" onclick="return confirm('Tem certeza?');">
                                        <i class="fa-solid fa-trash"></i>
                                        <span>Excluir</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                
                <p id='noDataTable'>Não há cidades cadastradas.</p>
                
            </div>
        </div>
    </section>
        

    <script src="../public/js/searchCities.js"></script>
    <script src="../public/js/noDataTable.js"></script>
</body>
</html>