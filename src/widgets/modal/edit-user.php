<div class="modal fade" id="editUser-<?= $usuario['id'] ?>" tabindex="-1" aria-labelledby="editUser-<?= $usuario['id'] ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="modal-title" id="editUser-<?= $usuario['id'] ?>Label"> <?= $usuario['id'] ?> - Editar usuário</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="./src/backend/edit-user-control.php" method="post">
                    <input type="hidden" name="userId" value="<?= $usuario['id'] ?>">

                    <div class="mb-3">
                        <label for="nameControl-<?= $usuario['id'] ?>" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nameControl-<?= $usuario['id'] ?>" name="nameControl" value="<?= $usuario['name'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="emailControl-<?= $usuario['id'] ?>" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="emailControl-<?= $usuario['id'] ?>" name="emailControl" value="<?= $usuario['email'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="telControl-<?= $usuario['id'] ?>" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" id="telControl-<?= $usuario['id'] ?>" name="telControl" value="<?= $usuario['phone'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="tokenControl-<?= $usuario['id'] ?>" class="form-label">Token</label>
                        <input type="text" class="form-control" id="tokenControl-<?= $usuario['id'] ?>" name="tokenControl" value="<?= $usuario['token'] ?>" readonly>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn-white btn-sm mt-1" onclick="generateToken(<?= $usuario['id'] ?>)">Gerar novo token</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="accessControl" class="form-label">Acesso: <?= $usuario['access'] ?></label>
                        <select class="form-select" name="accessControl" id="accessControl">
                            <option value="<?= $usuario['access'] ?>" selected>Selecione</option>
                            <option value="simple">Simples</option>
                            <option value="author">Autor</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn-default btn-with-icon">
                            Salvar edições
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function generateToken(userId) {
        // Gera um token hexadecimal de 32 caracteres
        const token = [...Array(32)]
            .map(() => Math.floor(Math.random() * 16).toString(16))
            .join('');

        // Atualiza o campo de token com o novo valor
        document.getElementById('tokenControl-' + userId).value = token;

        // Chama a função para atualizar o token no backend
        updateToken(token);
    }
</script>