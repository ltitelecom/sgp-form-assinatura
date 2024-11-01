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

// Inicializa a sessão cURL
$curl = curl_init();

// Configura um array com opções para a sessão cURL
curl_setopt_array($curl, array(
    CURLOPT_URL => URL_SGP .'/api/precadastro/vendedor/list',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode(array(
        "app" => APP_SGP,
        "token" => TOKEN_SGP // Use a variável de ambiente se configurada
    )),
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer '.TOKEN_SGP // Use a variável de ambiente se configurada
    ),
));

// Executa a requisição cURL
$response = curl_exec($curl);

// Verifica se houve erro na requisição
if (curl_errno($curl)) {
    echo 'Erro na requisição: ' . curl_error($curl);
} else {
    // Decodifica a resposta JSON
    $vendedores = json_decode($response, true);

    // Verifica se a resposta é um array
    if (is_array($vendedores)) {
        echo '<select class="form-control" id="vendedor_id" name="vendedor_id" required>';
        echo '<option value="">Selecione um vendedor</option>'; // Opção padrão
        foreach ($vendedores as $vendedor) {
            $id = htmlspecialchars($vendedor['id']); // ID do vendedor
            $nome = htmlspecialchars($vendedor['nome']); // Nome do vendedor
            echo '<option value="' . $id . '">' . $nome . '</option>'; // Opção exibida
        }
        echo '</select>';
    } else {
        echo 'Erro ao buscar os vendedores ou nenhum vendedor disponível.';
    }
}

// Fecha a sessão cURL
curl_close($curl);
?>
