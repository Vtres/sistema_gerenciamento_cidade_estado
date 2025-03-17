<?php
require_once 'config/config.php';

$query = "SELECT estados.nome AS estado, COUNT(cidades.id) AS total 
          FROM cidades 
          JOIN estados ON cidades.estado_id = estados.id 
          GROUP BY estados.nome 
          ORDER BY total DESC";

$result = $conn->query($query);

$labels = [];
$values = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row["estado"];
    $values[] = $row["total"];
}

$dadosDisponiveis = count($labels) > 0;

// Converter os arrays para JSON para serem usados no JavaScript
$labelsJson = json_encode($labels);
$valuesJson = json_encode($values);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<?php include('./src/includes/header.php'); ?>

<body class="bg-gray-100 text-gray-900">
  <?php include('./src/includes/navbar.php'); ?>

  <section class="max-w-4xl mx-auto mt-10">
    <?php if ($dadosDisponiveis): ?>
      
      <canvas id="estadoChart" width="400" height="200"></canvas>
    <?php else: ?>
      <p class="text-center">Não há registros de cidades e estados para exibir na home.</p>
    <?php endif; ?>
  </section>

  <!-- Passando os dados diretamente para o JS -->
  <script>
      const estados = <?php echo json_encode($labels); ?>;
      const quantidades = <?php echo json_encode($values); ?>;

      document.addEventListener("DOMContentLoaded", function () {
          const ctx = document.getElementById("estadoChart").getContext("2d");

          new Chart(ctx, {
              type: "bar", // Tipo do gráfico (barras)
              data: {
                  labels: estados,
                  datasets: [
                      {
                          label: "Número de cidades por estado",
                          data: quantidades,
                          backgroundColor: "rgba(75, 192, 192, 0.5)",
                          borderColor: "rgba(75, 192, 192, 1)",
                          borderWidth: 1,
                      },
                  ],
              },
              options: {
                  responsive: true,
                  scales: {
                      y: {
                          beginAtZero: true,
                      },
                  },
              },
          });
      });
  </script>

  <script src="./public/js/searchCities.js"></script>
  <!-- <script src="./public/js/createGraph.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>
