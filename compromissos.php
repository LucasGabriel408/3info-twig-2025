<?php

require_once('twig_carregar.php');
require('inc/banco.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_GET['id'])) {
    $dados = $pdo->prepare('INSERT INTO compromissos (nome, data) VALUES (:nome, :data)');

    $dados->bindValue(':nome', $_POST['nome']);
    $dados->bindValue(':data', $_POST['data']);

    $dados->execute();

    header('location: compromissos.php');

} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
    $dados = $pdo->query("UPDATE * FROM compromissos WHERE id = :id");

    $dados->bindValue(':nome', $_POST['nome']);
    $dados->bindValue(':data', $_POST['data']);

    $dados->execute();

    header('location: compromissos.php');

} else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {



    $dados = $pdo->prepare("SELECT * FROM compromissos WHERE id = :id");

    $dados->bindValue(':id', $_GET['id']);
    
    $dados->execute();

    $comp = $dados->fetch();

    echo $twig->render('compromissos_edt.html', [
        'compromisso' => $comp,
    ]);




} else {
    $dados = $pdo->query("SELECT * FROM compromissos ORDER BY data");
    $comp = $dados->fetchAll(PDO::FETCH_ASSOC);
    
    echo $twig->render('compromissos.html', [
        'compromissos' => $comp,
    ]);

}
