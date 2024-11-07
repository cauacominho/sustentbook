/* Função para o olho */
// Seleciona todos os botões de alternância de senha
const togglePasswords = document.querySelectorAll('.togglePassword');

togglePasswords.forEach(togglePassword => {
    togglePassword.addEventListener('click', function () {
        // Seleciona o campo de senha relacionado ao botão clicado
        const passwordField = this.closest('.password-container').querySelector('.controlPassword');
        
        // Alternar o tipo de input entre 'password' e 'text'
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        
        // Alternar o ícone entre 'visibility_off' e 'visibility'
        this.textContent = type === 'password' ? 'visibility_off' : 'visibility';
    });
});
