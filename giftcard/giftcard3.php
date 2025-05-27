<?php
$data = json_decode(file_get_contents('../data.json'), true);
$saldoIniziale = number_format($data['SaldoIniziale3'], 2, ',', '.');
$saldoAttuale = number_format($data['SaldoAttuale3'], 2, ',', '.');
$nomeSquadra = $data['NomeSquadra3'];

$template = file_get_contents('template-giftcard.html');
$page = str_replace('{{NOME_SQUADRA}}', $nomeSquadra, $template);
$page = str_replace('{{POSIZIONE}}', "3°", $page);
$page = str_replace('{{SALDO_INIZIALE}}', $saldoIniziale, $page);
$page = str_replace('{{SALDO_ATTUALE}}', $saldoAttuale, $page);

echo $page;
?>
