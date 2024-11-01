<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
            :root {
                --blue: #3699ff;
                --indigo: #6610f2;
                --purple: #6f42c1;
                --pink: #e83e8c;
                --red: #f64e60;
                --orange: #fd7e14;
                --yellow: #ffa800;
                --green: #1bc5bd;
                --teal: #20c997;
                --cyan: #3699ff;
                --white: #ffffff;
                --gray: #b5b5c3;
                --gray-dark: #7e8299;
                --primary: #3699ff;
                --secondary: #e4e6ef;
                --success: #1bc5bd;
                --info: #8950fc;
                --warning: #ffa800;
                --danger: #f64e60;
                --light: #f3f6f9;
                --dark: #181c32;
            }

            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f3f6f9;
                color: #3f4254;
                line-height: 1.5;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
            }

            .container {
                width: 100%;
                max-width: 800px;
                padding: 20px;
            }

            .card {
                background-color: #ffffff;
                border-radius: 0.42rem;
                box-shadow: 0px 0px 30px 0px rgba(82, 63, 105, 0.05);
                border: 1px solid #e4e6ef;
                overflow: hidden;
            }

            .card-title {
                background-color: var(--light);
                padding: 1.5rem 2.25rem;
                border-bottom: 1px solid #ebedf3;
                text-align: center;
            }

            .card-title h2 {
                margin: 0;
                font-size: 1.5rem;
                font-weight: 600;
                color: var(--dark);
            }
            .card-title h3 {
                margin: 0;
                font-size: 1.5rem;
                font-weight: 600;
                color: var(--dark);
            }

            .card-body {
                padding: 2.25rem;
            }

            h3 {
                font-size: 1.275rem;
                font-weight: 600;
                color: #181c32;
                margin-bottom: 1rem;
            }

            .form-group {
                margin-bottom: 1.75rem;
            }

            label {
                font-size: 0.9rem;
                font-weight: 500;
                color: #3f4254;
                display: block;
                margin-bottom: 0.5rem;
            }

            .form-control {
                width: 100%;
                height: calc(1.5em + 1.3rem + 2px);
                padding: 0.65rem 1rem;
                font-size: 1rem;
                font-weight: 400;
                line-height: 1.5;
                color: #3f4254;
                background-color: #ffffff;
                border: 1px solid #e4e6ef;
                border-radius: 0.42rem;
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

            .form-control:focus {
                border-color: #69b3ff;
                outline: 0;
                box-shadow: 0 0 0 0.2rem rgba(54, 153, 255, 0.25);
            }

            select.form-control {
                padding-right: 2rem;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3e%3cpath fill='%233f4254' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: right 1rem center;
                background-size: 8px 10px;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
            }

            .btn {
                display: inline-block;
                font-weight: 500;
                color: #3f4254;
                text-align: center;
                vertical-align: middle;
                user-select: none;
                background-color: transparent;
                border: 1px solid transparent;
                padding: 0.65rem 1rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: 0.42rem;
                transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

            .btn-primary {
                color: #ffffff;
                background-color: #3699ff;
                border-color: #3699ff;
            }

            .btn-primary:hover {
                color: #ffffff;
                background-color: #1584ff;
                border-color: #0877ff;
            }
        </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center mb-4">Selecione o Tipo de Cadastro</h3>
    <div class="mb-3">
        <label for="tipoFormulario" class="form-label">Tipo de Cadastro</label>
        <select class="form-control" id="tipoFormulario" name="tipoFormulario">
            <option value="">Selecione...</option>
            <option value="pf">Pessoa Física</option>
            <option value="pj">Pessoa Jurídica</option>
        </select>
    </div>

    <!-- Container onde o formulário será carregado -->
    <div id="formContainer" class="mt-4"></div>
</div>

<script>
    $(document).ready(function() {
        $('#tipoFormulario').on('change', function() {
            var tipo = $(this).val();
            var url = '';

            if (tipo === 'pf') {
                url = 'form_assinatura_pf.php';
            } else if (tipo === 'pj') {
                url = 'form_assinatura_pj.php';
            }

            if (url) {
                // Limpa o conteúdo do container antes de carregar um novo formulário
                $('#formContainer').empty();
                
                // Carrega o formulário na div usando AJAX
                $('#formContainer').load(url, function(response, status, xhr) {
                    if (status == "error") {
                        $('#formContainer').html('<div class="alert alert-danger" role="alert">Erro ao carregar o formulário: ' + xhr.status + ' ' + xhr.statusText + '</div>');
                    }
                });
            } else {
                // Limpa o container se a opção for "Selecione..."
                $('#formContainer').empty();
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
