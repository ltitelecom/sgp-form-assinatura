    <?php
/* 
###################################################
# App: Formulário e Assinatura AJAX - SGP Provedor#
# Versão: 1.0                                     #
# Data: 01/11/2024                                #
# Autor: Willemberg P. Santos                     #
# Email: willembergps@gmail.com                   #
# Site: https://www.ltitelecom.com.br             #
###################################################
*/

    // Define as constantes do sistema
    define("URL_SGP", "URL_DO_SEU_SGP"); // Ex: https://seuprovedor.sgp.net.br
    define("TOKEN_SGP", "SEUTOKEN"); // Seu TOKEN de integração com a API, disponível no menu do SGP em -> Administração -> Integrações -> Tokens
    define("APP_SGP", "SEU_APP"); // Nome do APP criado no SGP, disponível em -> Administração -> Integrações -> Tokens

        
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Coleta os dados do formulário
            $url = URL_SGP . '/api/precadastro/J';
            $token = TOKEN_SGP;
            // Coleta os dados do formulário
            $nome = $_POST['nome'];
            $cpfcnpj = $_POST['cpfcnpj'];
            $nomefantasia = $_POST['nomefantasia']; // Novo campo
            $respempresa = $_POST['respempresa']; // Novo campo
            $respcpf = $_POST['respcpf']; // Novo campo
            $email = $_POST['email'];
            $celular = $_POST['celular'];
            $datanasc = $_POST['datanasc'];
            $logradouro = $_POST['logradouro'];
            $numero = $_POST['numero'];
            $complemento = $_POST['complemento'];
            $bairro = $_POST['bairro'];
            $cidade = $_POST['cidade'];
            $cep = $_POST['cep'];
            $uf = $_POST['uf'];
            $pais = $_POST['pais']; // Novo campo
            $pontoreferencia = $_POST['pontoreferencia'];
            $observacao = $_POST['observacao'];
            $plano_id = $_POST['plano_id'];
            $vencimento_id = $_POST['vencimento_id'];

        // Prepara os dados para envio
        $data = [
            "app" => APP_SGP,
            "token" => $token,
            "nome" => $nome,
            "cpfcnpj" => $cpfcnpj,
            "nomefantasia" => $nomefantasia, // Novo campo
            "respempresa" => $respempresa, // Novo campo
            "respcpf" => $respcpf, // Novo campo
            "email" => $email,
            "celular" => $celular,
            "datanasc" => $datanasc,
            "logradouro" => $logradouro,
            "numero" => (int)$numero,
            "complemento" => $complemento,
            "bairro" => $bairro,
            "cidade" => $cidade,
            "cep" => $cep,
            "uf" => $uf,
            "pais" => "BR",
            "pontoreferencia" => $pontoreferencia,
            "observacao" => $observacao,
            "plano_id" => (int)$plano_id,
            "vencimento_id" => (int)$vencimento_id,
            // "vendedor_id" => (int)$vendedor_id,
            // Adicione outros campos necessários conforme o exemplo da API
        ];

        // Inicia a requisição cURL
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        // Executa a requisição e obtém a resposta
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "<script>alert('Erro ao enviar o formulário: " . $err . "');</script>";
        } else {
            $responseData = json_decode($response, true);
            if (isset($responseData['message'])) {
                echo "<script>alert('" . $responseData['message'] . "');</script>";
            } else {
                echo "<script>alert('Cadastro enviado com sucesso!');</script>";
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        <title>Formulário de Assinatura</title>
    </head>
    <body>
    <div class="container">
            <div class="card">
                <div class="card-title">
                    <h2>Informe os dos da Empresa</h2>
                </div>
                <div class="card-body">
                <form action="form_assinatura_pj.php" id="Assinar" method="POST">
                        <!-- Dados do Assinante -->
                        <h3>Por favor, preencha os dados abaixo:</h3>
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="cpfcnpj">CNPJ da Empresa:</label>
                    <input type="text" class="form-control" id="cpfcnpj" name="cpfcnpj" placeholder="Somente números" required>
                </div>
                <div class="form-group">
                    <label for="nomefantasia">Nome Fantasia:</label>
                    <input type="text" class="form-control" id="nomefantasia" name="nomefantasia"placeholder="SUA EMPRESA" required>
                </div>
                <div class="form-group">
                    <label for="respempresa">Nome do Responsável pela Empresa:</label>
                    <input type="text" class="form-control" id="respempresa" name="respempresa"placeholder="Nome do Reponsável pela Empresa" required>
                </div>
                <div class="form-group">
                    <label for="respcpf">CPF do Responsável pela Empresa:</label>
                    <input type="text" class="form-control" id="respcpf" name="respcpf"placeholder="CPF do Reponsável pela Empresa" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Comercial:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ex: voce@suaempresa.com.br" required>
                </div>
                <div class="form-group">
                    <label for="celular">Celular/WhatsApp:</label>
                    <input type="text" class="form-control" id="celular" name="celular" placeholder="Somente números Ex: 74999990000" required>
                </div>
                <div class="form-group">
                    <label for="datanasc">Data de Nascimento:</label>
                    <input type="date" class="form-control" id="datanasc" name="datanasc" required>
                </div>
                <div class="form-group">
                    <label for="logradouro">Endereço:</label>
                    <input type="text" class="form-control" id="logradouro" name="logradouro" required>
                </div>
                <div class="form-group">
                    <label for="numero">Número:</label>
                    <input type="number" class="form-control" id="numero" name="numero" required>
                </div>
                <div class="form-group">
                    <label for="complemento">Complemento:</label>
                    <input type="text" class="form-control" id="complemento" name="complemento">
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro:</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" required>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade:</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" required>
                </div>
                <div class="form-group">
                    <label for="cep">CEP:</label>
                    <input type="text" class="form-control" id="cep" name="cep" placeholder="Somente números EX: 44798000" required>
                </div>
                <div class="form-group">
                    <label for="uf">UF:</label>
                    <input type="text" class="form-control" id="uf" name="uf" placeholder="Exemplo: BA" required>
                </div>
                <div class="form-group">
                    <label for="pontoreferencia">Ponto de Referência:</label>
                    <input type="text" class="form-control" id="pontoreferencia" name="pontoreferencia">
                </div>
                <div class="form-group">
                    <label for="observacao">Tipo de Imóvel:</label>
                    <select class="form-control" id="observacao" name="observacao" required>
                        <option value="Imóvel Próprio">Próprio</option>
                        <option value="Imóvel Alugado">Alugado</option>
                        <option value="Imóvem de Terceiros">Imóvel de Terceiros</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="plano_id">Escolha o Plano:</label>
                    
                <!-- Seleção de Plano -->
                <?php
                $planos = @include 'select_planos.php';
                if ($planos === false) {
                 echo "Erro ao incluir select_planos.php";
                }
                ?>     
                <!-- FIM da Seleção de Plano -->
                </div>
                <div class="form-group">
                    <label for="vencimento_id">Escolha o dia para pagamento:</label>
                    <!-- Seleção de Dia de Vencimento -->
                <?php
                $planos = @include 'dias_vencimento.php';
                if ($planos === false) {
                 echo "Erro ao incluir select_planos.php";
                }
                ?>
                <!-- FIM da Seleção de Dia de Vencimento -->
                </div>
                <button type="submit" class="btn btn-primary">Contratar Agora!</button>
            </form>
        </div>

        <script>

            // Função para validar o formulário
        document.getElementById('Assinar').onsubmit = function(event) {
            
            // Coleta os valores dos campos
            var nome = document.getElementById('nome').value;
            var cpfcnpj = document.getElementById('cpfcnpj').value;
            var nomefantasia = document.getElementById('nomefantasia').value;
            var respempresa = document.getElementById('respempresa').value;
            var respcpf = document.getElementById('respcpf').value;
            var email = document.getElementById('email').value;
            var celular = document.getElementById('celular').value;
            var datanasc = document.getElementById('datanasc').value;
            var logradouro = document.getElementById('logradouro').value;
            var numero = document.getElementById('numero').value;
            var complemento = document.getElementById('complemento').value;
            var bairro = document.getElementById('bairro').value;
            var cidade = document.getElementById('cidade').value;
            var cep = document.getElementById('cep').value;
            var uf = document.getElementById('uf').value;
            var pontoreferencia = document.getElementById('pontoreferencia').value;
            var observacao = document.getElementById('observacao').value;
            var plano_id = document.getElementById('plano_id').value;
            var vencimento_id = document.getElementById('vencimento_id').value;
            // var vendedor_id = document.getElementById('vendedor_id').value;

            // Valida os campos do formulário
            if (!nome || !cpfcnpj || !nomefantasia || !respempresa || !respcpf || !email || !celular || !datanasc || !logradouro || !numero || !bairro || !cidade || !cep || !uf || !observacao || !plano_id || !vencimento_id) {
                alert("Por favor, preencha todos os campos obrigatórios.");
                event.preventDefault(); // Previne o envio apenas se a validação falhar
            return false;
        }

    // Se tudo estiver válido, o formulário será enviado normalmente
    return true;
    };
    </script>
    </body>
    </html>
