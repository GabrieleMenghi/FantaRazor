<?php
$pw = "segreto123"; // Cambia questa password
if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] !== 'admin' || $_SERVER['PHP_AUTH_PW'] !== $pw) {
  header('WWW-Authenticate: Basic realm="Gift Card Admin"');
  header('HTTP/1.0 401 Unauthorized');
  echo 'Accesso negato';
  exit;
}

$data = json_decode(file_get_contents('../data.json'), true);

$template = file_get_contents('home-admin.html');
$page = str_replace('{{NOME_SQUADRA1}}', $data['NomeSquadra1'], $template);
$page = str_replace('{{NOME_SQUADRA2}}', $data['NomeSquadra2'], $page);
$page = str_replace('{{NOME_SQUADRA3}}', $data['NomeSquadra3'], $page);

echo $page;
?>