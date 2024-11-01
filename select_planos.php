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

// Inicializa a seesão cURL
$curl = curl_init();
// Constroe um Array com opções para uma sessão cURL. Esta função é útil para definir um grande número de opções cURL sem precisar chamar repetidamente  a função curl_setopt().
curl_setopt_array($curl, array(
  CURLOPT_URL => URL_SGP .'/api/precadastro/plano/list',
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

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo 'Erro na requisição: ' . curl_error($curl);
} else {
    // Decodifica a resposta JSON
    $planos = json_decode($response, true);

    // Verifica se a resposta é um array
    if (is_array($planos)) {
        echo '<select class="form-control" id="plano_id" name="plano_id" required>
        ';
        echo '<option value="">Selecione um plano</option>'; // Opção padrão
        foreach ($planos as $plano) {
            $id = htmlspecialchars($plano['id']);
            $descricao = htmlspecialchars($plano['descricao']);
            $valor = htmlspecialchars(number_format($plano['valor'], 2, ',', '.')); // Formata o valor com 2 casas decimais
            echo '<option value="' . $id . '">' . $descricao . ' - R$ ' . $valor . '</option>';
        }
        echo '</select>';
    } else {
        echo 'Erro ao buscar os planos ou nenhum plano disponível.';
    }
}

curl_close($curl);
?>
