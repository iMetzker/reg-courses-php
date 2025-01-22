document.addEventListener("DOMContentLoaded", () => {
    const dateInput = document.getElementById("id_course_date");

    dateInput.addEventListener("blur", () => {
        const today = new Date();
        today.setHours(0, 0, 0, 0); 
        const selectedDate = new Date(dateInput.value + "T00:00:00");

        if (!dateInput.value) {
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

        if (selectedDate < today) {
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Data inválida.",
                text: "A data de realização do curso não pode ser inferior a data atual.",
                showConfirmButton: false,
                allowOutsideClick: true,
                timer: 2500
            }).then(() => {
                dateInput.value = "";
                dateInput.focus();
            });
        }
    });
});