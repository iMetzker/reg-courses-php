document.getElementById("id_student_bth").addEventListener("blur", function () {
    const dateInput = this.value;
    if (!dateInput) return; 

    const currentDate = new Date(); 
    const enteredDate = new Date(dateInput); 

    if (isNaN(enteredDate.getTime())) {
        alert("Data inválida. Por favor, insira uma data válida.");
        this.value = ""; // Limpa o campo
        return;
    }

    // CÁLCULO DA IDADE
    const age = currentDate.getFullYear() - enteredDate.getFullYear();

      // RESTRINGINDO IDADE ENTRE 10 E 100 ANOS
    if (age < 10 || age > 100) {
        alert("Idade inválida.");
        this.value = ""; 
    }
});