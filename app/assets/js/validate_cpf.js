document.getElementById("id_student_cpf").addEventListener("blur", function () {
  let cpf = this.value;
  if(!cpf) return;

  // REMOVENDO CARACTERES NÃO NUMÉRICOS (. E -)
  cpf = cpf.replace(/\D+/g, "");

  // VERIFICAÇÃO SE OS DÍGITOS SÃO REPETIDOS E SE TEM 11 DÍGITOS
  if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
    showInvalidCPFMessage(this);
    return;
  }

  const calcDigit = (base) => {
    const total = base
      .split("")
      .map((num, index) => num * (base.length + 1 - index))
      .reduce((acc, curr) => acc + curr, 0);

    const resto = total % 11;
    return resto < 2 ? 0 : 11 - resto;
  };

  const digit1 = calcDigit(cpf.substring(0, 9));
  const digit2 = calcDigit(cpf.substring(0, 10));

  const isValid = cpf === cpf.substring(0, 9) + digit1 + digit2;

  if (!isValid) {
    showInvalidCPFMessage(this);
  } else {
    this.classList.remove("is-invalid");
  }
});

function showInvalidCPFMessage(inputElement) {
  Swal.fire({
    position: "top-end",
    icon: "error",
    title: "CPF Inválido.",
    text: "Este CPF não existe, favor inserir um CPF válido.",
    showConfirmButton: false,
    allowOutsideClick: true,
    timer: 2500,
  }).then(() => {
    inputElement.value = "";
    inputElement.focus();
  });
  inputElement.classList.add("is-invalid");
}
