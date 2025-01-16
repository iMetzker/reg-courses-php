function aplicarMascaraCPF(valor) {
    return valor
      .replace(/\D/g, '')
      .replace(/(\d{3})(\d)/, '$1.$2')
      .replace(/(\d{3})(\d)/, '$1.$2')
      .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
  }

  function aplicarMascaraContato(valor) {
    return valor
      .replace(/\D/g, '') 
      .replace(/(\d{2})(\d)/, '($1) $2')
      .replace(/(\d{5})(\d)/, '$1-$2');
  }

  document.getElementById('id_student_cpf').addEventListener('input', function () {
    this.value = aplicarMascaraCPF(this.value);
  });

  document.getElementById('id_student_phone').addEventListener('input', function () {
    this.value = aplicarMascaraContato(this.value);
  });