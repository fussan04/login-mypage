<?php
mb_internal_encoding("utf-8");

$pdo = new PDO("mysql:dbname=form;host=localhost;","root", "root");

$stmt = $pdo->prepare("insert into login_mypage(name,mail,password,picture,comments)values(?,?,?,?,?)");

$stmt->bindvalue(1, $_POST['name']);
$stmt->bindvalue(2, $_POST['mail']);
$stmt->bindvalue(3, $_POST['password']);
$stmt->bindvalue(4, $_POST['path_filename']);
$stmt->bindvalue(5, $_POST['comments']);

$stmt->execute();
$pdo = NULL;

header('Location:after_register.html');
?>