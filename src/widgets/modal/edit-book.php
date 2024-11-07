<div class="modal fade" id="editBook-<?= $book['id'] ?>" tabindex="-1" aria-labelledby="editBook-<?= $book['id'] ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="modal-title" id="editBook-<?= $book['id'] ?>Label"> <?= $book['id'] ?> - Editar livro</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="./src/backend/edit-book-control.php" method="post">

                    <input type="hidden" name="bookId" value="<?= $book['id'] ?>">

                    <div class="mb-3">
                        <label for="titleControl" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titleControl" name="titleControl" value="<?= $book['title'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="synopsisBookControl" class="form-label">Sinopse</label>
                        <textarea name="synopsisBookControl" id="synopsisBookControl" rows="10" class="form-control"><?= $book['synopsis'] ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="pagesControl">Paginas</label>
                        <input type="text" class="form-control" id="pagesControl" name="pagesControl" value="<?= $book['pages'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="languageControl">Idioma</label>
                        <input type="text" class="form-control" id="languageControl" name="languageControl" value="<?= $book['language'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="publisherControl">Editora</label>
                        <input type="text" class="form-control" id="publisherControl" name="publisherControl" value="<?= $book['publisher'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="translatedControl">Traduzido</label>
                        <input type="text" class="form-control" name="translatedControl" id="translatedControl" value="<?= $book['translated'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="valueControl">Valor diário</label>
                        <input type="tel" name="valueControl" id="valueControl_<?= $book['id'] ?>" value="<?= $book['value'] ?>"
                            class="form-control currency-input"
                            data-book-id="<?= $book['id'] ?>"
                            oninput="CurrencyFormatter.format(this)"
                            onblur="CurrencyFormatter.validate(this)">
                        <div id="totalValue_<?= $book['id'] ?>" class="mt-2"></div>
                    </div>


                    <div class=" d-grid gap-2">
                        <button type="submit" class="btn btn-default btn-with-icon">
                            Salvar edições
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    class CurrencyFormatter {
        static format(inputElement) {
            let value = inputElement.value.replace(/\D/g, "");
            value = (parseFloat(value) / 100).toFixed(2); // Converte para decimal com duas casas
            value = value.replace(".", ","); // Troca ponto por vírgula
            inputElement.value = "R$ " + value.replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Adiciona pontos para milhares
        }

        static validate(inputElement) {
            if (!inputElement.value.includes("R$")) {
                inputElement.value = "R$ 0,00"; // Define valor padrão, se vazio ou incorreto
            }
        }
    }

    // Exemplo de utilização: adicione o evento ao carregar a página
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll('.currency-input').forEach(input => {
            input.addEventListener('input', (e) => CurrencyFormatter.format(e.target));
            input.addEventListener('blur', (e) => CurrencyFormatter.validate(e.target));
        });
    });
</script>