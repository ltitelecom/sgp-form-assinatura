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

// Inicializa o cURL
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => URL_SGP .'/api/precadastro/vencimento/list',
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
curl_close($curl);

// Decodifica a resposta JSON
$vencimentos = json_decode($response, true);

// Verifica se a resposta é um array
if (is_array($vencimentos)) {
    echo '<select name="vencimento_id" required>';
    echo '<option value="">Selecione o dia de vencimento</option>'; // Opção padrão
    foreach ($vencimentos as $vencimento) {
        // Agora a resposta contém as chaves 'id' e 'dia'
        $id = htmlspecialchars($vencimento['id']); // ID do dia
        $dia = htmlspecialchars($vencimento['dia']); // Dia do vencimento
        echo '<option value="' . $id . '">Dia ' . $dia . '</option>'; // Opção exibida
    }
    echo '</select>';
} else {
    echo 'Erro ao buscar os dias de vencimento ou nenhum dia disponível.';
}
?>
