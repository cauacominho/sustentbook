<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- MATERIAL ICONS GOOGLE -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- LINK BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- LINK CSS -->
    <link rel="stylesheet" href="./src/css/global.css">

    <title>Cadastrar</title>
</head>

<body class="bg">


    <div class="container vh-100 d-flex flex-column justify-content-center">
        <!-- Título centralizado -->
        <div class="row justify-content-center mb-3">
            <div class="col-12 col-md-auto text-primary fw-bold text-center fs-1">SUSTENTBOOK</div>
        </div>

        <!-- Formulário centralizado -->
        <div class="row justify-content-center mt-4">
            <div class="col-12 col-md-6 col-lg-4">
                <form action="./src/backend/user-registration-control.php" method="post">
                    <div class="mb-3">
                        <input type="text" name="controlNome" id="controlNome" placeholder="Nome completo" class="form-default">
                    </div>

                    <div class="mb-3">
                        <input type="tel" name="controlTelefone" id="controlTelefone" placeholder="Telefone" class="form-default">
                    </div>

                    <div class="mb-3">
                        <input type="email" name="controlEmail" id="controlEmail" placeholder="E-mail" class="form-default">
                    </div>

                    <div class="mb-3 position-relative password-container">
                        <input type="password" name="controlPassword" id="controlPassword" placeholder="Senha" class="form-default controlPassword">
                        <span class="material-symbols-outlined text-primary togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                            visibility_off
                        </span>
                    </div>

                    <div class="mb-3 position-relative password-container">
                        <input type="password" name="controlConfirmPassword" id="controlConfirmPassword" placeholder="Confirmar senha" class="form-default controlPassword">
                        <span class="material-symbols-outlined text-primary togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                            visibility_off
                        </span>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" role="switch" id="souAutor" name="souAutor" value="author">
                        <label class="form-check-label" for="souAutor">Sou autor</label>
                    </div>

                    <button type="submit" class="btn-default w-100">Cadastrar</button>
                </form>

            </div>
        </div>

        <!-- Link "Criar conta" centralizado -->
        <div class="row justify-content-center fixed-bottom mb-3">
            <div class="col-auto">
                <a href="./login.html">Já tem conta? Entrar</a>
            </div>
        </div>
    </div>

    <script src="./src/js/see-eye.js"></script>
    <script src="./src/js/cellular-adjustment.js"></script>

    <!-- LINK BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>