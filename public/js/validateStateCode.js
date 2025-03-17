function validateStateCode() {
    var abbreviation = document.getElementsByName("uf")[0].value;
    var errorMessage = document.getElementById("abbreviationError");

    // Validar se a sigla tem exatamente 2 caracteres
    if (abbreviation.trim() === "" || abbreviation.length !== 2) {
        errorMessage.classList.remove("hidden"); // Torna o span visível
        errorMessage.classList.add("block", "text-red-500", "text-xs");
        errorMessage.innerText = "Código do estado deve ter 2 caracteres";
        return false; // Impede o envio do formulário
    }

    errorMessage.classList.add("hidden"); // Esconde o span
    return true;
}
