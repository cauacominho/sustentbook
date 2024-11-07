
// Para capa do livro
const coverFileInput = document.getElementById('coverFile');
const coverFileChosen = document.getElementById('file-chosen-cover');
const btnUploadCover = document.getElementById('btnUploadCover');
const coverPreview = document.getElementById('coverPreview');

btnUploadCover.addEventListener('click', function() {
    coverFileInput.click();
});

// Validação para capa do livro
coverFileInput.addEventListener('change', function() {
    const file = coverFileInput.files[0];
    if (file && (file.type === 'image/png' || file.type === 'image/jpeg')) {
        const img = new Image();
        img.src = URL.createObjectURL(file);
        img.onload = function() {
            const {
                height
            } = img;
            if (height >= 1000 && height <= 10000) {
                coverFileChosen.textContent = file.name;
                coverFileChosen.classList.remove('text-danger');
                const reader = new FileReader();
                reader.onload = function(e) {
                    coverPreview.src = e.target.result;
                    coverPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                coverFileChosen.textContent = 'A altura deve ser entre 1000px e 10000px.';
                coverFileChosen.classList.add('text-danger');
                coverPreview.style.display = 'none';
            }
        };
    } else {
        coverFileChosen.textContent = 'Arquivo inválido. Escolha um arquivo PNG ou JPG.';
        coverFileChosen.classList.add('text-danger');
        coverPreview.style.display = 'none';
    }
});

// Para outras imagens
const otherFileInput = document.getElementById('otherImages');
const otherFileChosen = document.getElementById('file-chosen-other');
const btnUploadOther = document.getElementById('btnUploadOther');
const otherPreviewContainer = document.getElementById('otherPreviewContainer');

btnUploadOther.addEventListener('click', function() {
    otherFileInput.click();
});

otherFileInput.addEventListener('change', function() {
    const files = otherFileInput.files;
    otherFileChosen.textContent = files.length > 0 ? `${files.length} imagens escolhidas` : 'Nenhuma imagem escolhida';
    otherFileChosen.classList.remove('text-danger'); // Remove a classe de erro caso exista
    otherPreviewContainer.innerHTML = ''; // Limpa o container antes de adicionar novas imagens

    Array.from(files).forEach(file => {
        if (file.type === 'image/png' || file.type === 'image/jpeg') {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    const height = img.height;
                    if (height >= 1000 && height <= 10000) {
                        const imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.style.height = '200px'; // Define uma altura fixa para outras imagens
                        imgElement.style.width = 'auto'; // Mantém a proporção da largura
                        imgElement.style.objectFit = 'cover'; // Para garantir que a imagem se ajuste bem ao espaço
                        imgElement.classList.add('mt-2', 'me-2');
                        otherPreviewContainer.appendChild(imgElement);
                    } else {
                        otherFileChosen.textContent = 'Algum arquivo tem altura inválida. Altura deve ser entre 1000px e 10000px.';
                        otherFileChosen.classList.add('text-danger'); // Adiciona a classe de erro
                        otherPreviewContainer.innerHTML = ''; // Limpa a visualização se houver erro
                    }
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            otherFileChosen.textContent = 'Algum arquivo inválido. Apenas PNG ou JPG são permitidos.';
            otherFileChosen.classList.add('text-danger'); // Adiciona a classe de erro
            otherPreviewContainer.innerHTML = ''; // Limpa a visualização se houver erro
        }
    });
});