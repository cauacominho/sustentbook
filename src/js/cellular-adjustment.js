document.getElementById('controlTelefone').addEventListener('input', function (e) {
    let input = e.target.value.replace(/\D/g, ''); // Remove qualquer caractere que não seja número
    input = input.substring(0, 11); // Limita a 11 dígitos
    const parte1 = input.substring(0, 2); // Código de área
    const parte2 = input.substring(2, 7); // Primeira parte do número
    const parte3 = input.substring(7, 11); // Segunda parte do número

    if (input.length > 7) {
        e.target.value = `(${parte1}) ${parte2}-${parte3}`;
    } else if (input.length > 2) {
        e.target.value = `(${parte1}) ${parte2}`;
    } else if (input.length > 0) {
        e.target.value = `(${parte1}`;
    }
});