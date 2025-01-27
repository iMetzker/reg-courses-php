document.getElementById("id_student_bth").addEventListener("blur", function () {
    const dateInput = this.value;
    if (!dateInput) return; 

    const currentDate = new Date(); 
    const enteredDate = new Date(dateInput); 

    if (isNaN(enteredDate.getTime())) {
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Data inválida",
            text: "O campo de data de realização não pode ficar vazio.",
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            dateInput.focus();
        });
        return;
    }

    // CÁLCULO DA IDADE
    const age = currentDate.getFullYear() - enteredDate.getFullYear();

      // RESTRINGINDO IDADE ENTRE 10 E 100 ANOS
    if (age < 10 || age > 100) {
            Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Data inválida.",
            text: "A data informada não está dentro do intervalo permitido. Informe uma data válida.",
            showConfirmButton: false,
            allowOutsideClick: true,
            timer: 2500
        }).then(() => {
            dateInput.value = "";
            dateInput.focus();
        });
        this.classList.add('is-invalid');
    } else {
        this.classList.remove('is-invalid');
    }
});
