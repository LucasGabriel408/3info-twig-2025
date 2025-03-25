<?php

require('twig_carregar.php');

// Montar uma página no Twig chamada horário. Será possível acessar pelo menu. Deverá mostar a data de hoje e a data de amanhã.

use Carbon\Carbon;

$hoje = Carbon::now();
$amanha = $hoje->addDay(1);

echo $twig->render('horario.html', [
    'hoje' => $hoje,
    'amanha' => $amanha,
]);
