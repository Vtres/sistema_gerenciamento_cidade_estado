function filterTable() {
    // Obtém o valor da pesquisa
    var input = document.getElementById("searchInput");
    var filter = input.value.toLowerCase();
    var table = document.getElementById("citiesTable");
    var rows = table.getElementsByTagName("tr");

    console.log(rows);

    // Itera sobre as linhas da tabela, ocultando as que não correspondem ao filtro
    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        console.log(cells);
        var cidade = cells[1].textContent.toLowerCase();
        var estado = cells[2].textContent.toLowerCase();

        // Verifica se cidade ou estado contém o termo de pesquisa
        if (cidade.includes(filter) || estado.includes(filter)) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}
