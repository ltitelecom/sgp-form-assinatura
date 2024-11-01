<!--

###################################################
# App: Formulário e Assinatura AJAX - SGP Provedor#
# Versão: 1.0                                     #
# Data: 01/11/2024                                #
# Autor: Willemberg P. Santos                     #
# Email: willembergps@gmail.com                   #
# Site: https://www.ltitelecom.com.br             #
###################################################

-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Assinatura - Provedor X</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Inclusão do arquivo CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <!-- Imagem do banner centralizada -->
    <img src="imgs/banner_assinar.png" alt="Banner de Assinatura" class="banner">
    <h3 class="text-center mb-4">Selecione o tipo de cadastro</h3>
    <div class="mb-3">
        <label for="tipoFormulario" class="form-label">Onde vamos instalar a sua internet?</label>
        <select class="form-control" id="tipoFormulario" name="tipoFormulario">
            <option value="">Clique aqui para selecione...</option>
            <option value="pf">Em minha casa</option>
            <option value="pj">Em minha empresa</option>
        </select>
    </div>

    <!-- Container onde o formulário será carregado -->
    <div id="formContainer" class="mt-4"></div>
</div>

<script>
    $(document).ready(function() {
        $('#tipoFormulario').on('change', function() { // Corrigido para 'tipoFormulario'
            var tipo = $(this).val();
            var url = '';

            if (tipo === 'pf') {
                url = 'form_assinatura_pf.php';
            } else if (tipo === 'pj') {
                url = 'form_assinatura_pj.php';
            }

            if (url) {
                $('#formContainer').empty();
                $('#formContainer').load(url, function(response, status, xhr) {
                    if (status == "error") {
                        $('#formContainer').html('<div class="alert alert-danger" role="alert">Erro ao carregar o formulário: ' + xhr.status + ' ' + xhr.statusText + '</div>');
                    }
                });
            } else {
                $('#formContainer').empty();
            }
        });

        // Adiciona um evento de submit ao formulário carregado
        $(document).on('submit', '#formContainer form', function(e) {
            e.preventDefault(); // Previne o envio padrão do formulário

            // Obtém os dados do formulário
            var formData = $(this).serialize();

            // Envia os dados via AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'), // A URL para onde os dados serão enviados
                data: formData,
                success: function(response) {
                    // Processa a resposta do servidor
                    $('#formContainer').html('<div class="alert alert-success">Formulário enviado com sucesso!</div>');
                },
                error: function(xhr, status, error) {
                    // Trata erros
                    $('#formContainer').html('<div class="alert alert-danger">Erro ao enviar o formulário: ' + error + '</div>');
                }
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
