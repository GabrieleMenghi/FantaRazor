<?php
$pw = "segreto123"; // Cambia questa password
if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] !== 'admin' || $_SERVER['PHP_AUTH_PW'] !== $pw) {
  header('WWW-Authenticate: Basic realm="Gift Card Admin"');
  header('HTTP/1.0 401 Unauthorized');
  echo 'Accesso negato';
  exit;
}

$messaggio_html = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nuovo_saldo = floatval($_POST['saldo']);
  $data = ['saldo' => $nuovo_saldo];
  file_put_contents('../data.json', json_encode($data));
  $messaggio_html = '<div class="msg">Saldo aggiornato a € ' . number_format($nuovo_saldo, 2, ',', '.') . '</div>';
} else {
  $data = json_decode(file_get_contents('../data.json'), true);
}
$saldo_corrente = number_format($data['saldo'], 2, ',', '.');

$template = file_get_contents('template-admin.html');
$page = str_replace(['{{SALDO}}', '{{MESSAGGIO}}'], [$saldo_corrente, $messaggio_html], $template);

echo $page;
?>