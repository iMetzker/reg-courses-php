document.getElementById("id_student_bth").addEventListener("blur", function () {
    const dateInput = this.value;
    if (!dateInput) return; 

    const currentDate = new Date(); 
    const enteredDate = new Date(dateInput); 

    if (isNaN(enteredDate.getTime())) {
        alert("Data de nascimento inválida. Por favor, insira uma data válida.");
        this.value = "";
        return;
    }

    // CÁLCULO DA IDADE
    const age = currentDate.getFullYear() - enteredDate.getFullYear();

      // RESTRINGINDO IDADE ENTRE 10 E 100 ANOS
    if (age < 10 || age > 100) {
        alert("A idade informada não está dentro do intervalo permitido. Por favor, insira uma data de nascimento válida.");
        this.value = ""; 
    }
});