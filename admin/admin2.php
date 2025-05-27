<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$messaggio_html = "";
$data = json_decode(file_get_contents('../data.json'), true); // Lettura iniziale

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $saldoDaSottrarre = floatval($_POST['saldoDaSottrarre']);
  
  // Controllo e calcolo nuovo saldo
  $saldo_corrente = isset($data['SaldoAttuale2']) ? floatval($data['SaldoAttuale2']) : 0;
  $nuovo_saldo = $saldo_corrente - $saldoDaSottrarre;

  // Aggiorna il saldo nel file JSON
  $data['SaldoAttuale2'] = $nuovo_saldo;
  file_put_contents('../data.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

  // Messaggio di conferma
  $messaggio_html = '<div class="msg">Saldo aggiornato a € ' . number_format($nuovo_saldo, 2, ',', '.') . '</div>';
}

// Formatta saldo da mostrare
$saldo_corrente = number_format($data['SaldoAttuale2'] ?? 0, 2, ',', '.');

// Carica template e sostituisci segnaposti
$template = file_get_contents('template-admin.html');
$page = str_replace(['{{SALDO_ATTUALE}}', '{{MESSAGGIO}}'], [$saldo_corrente, $messaggio_html], $template);

echo $page;
?>