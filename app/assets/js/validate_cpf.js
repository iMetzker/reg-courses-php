  function validarCPF(cpf) {

    // REMOVENDO CARACTERES NÃO NUMÉRICOS (. E -)
    cpf = cpf.replace(/\D+/g, '');

    // VERIFICAÇÃO SE OS DÍGITOS SÃO REPETIDOS
    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

    const calcularDigito = (base) => {
      const total = base
        .split('')
        .map((num, index) => num * (base.length + 1 - index))
        .reduce((acc, curr) => acc + curr, 0);

      const resto = total % 11;
      return resto < 2 ? 0 : 11 - resto;
    };

    const digito1 = calcularDigito(cpf.substring(0, 9));
    const digito2 = calcularDigito(cpf.substring(0, 10));
    return cpf === cpf.substring(0, 9) + digito1 + digito2;
  }


  document.getElementById('id_student_cpf').addEventListener('blur', function () {
    const cpf = this.value;
    if (!validarCPF(cpf)) {
      alert('CPF inválido!');
      this.classList.add('is-invalid');
    } else {
      this.classList.remove('is-invalid');
    }
  });