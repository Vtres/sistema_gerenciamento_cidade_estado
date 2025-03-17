document.addEventListener("DOMContentLoaded", function () {
    const table = document.getElementById("dataTable");
    const tbody = table.querySelector("tbody");
    const p = document.getElementById("noDataTable");

    if (!tbody || tbody.rows.length === 0) {
        table.style.display = "none";
        p.style.display = "block";
    } else {
        table.style.display = "table";
        p.style.display = "none";
    }
});
