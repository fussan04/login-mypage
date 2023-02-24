<?php
mb_internal_encoding("utf-8");

session_start();


$stmt = $pdo->prepare("update login_mypage set name = ?, mail = ?, password = ?, comments id = ?, where id = ?");

$stmt->bindvalue(1, $_POST['name']);
$stmt->bindvalue(2, $_POST['mail']);
$stmt->bindvalue(3, $_POST['password']);
$stmt->bindvalue(4, $_POST['comments']);
$stmt->bindvalue(5, $_SESSION['id']);

$stmt->execute();
$pdo = NULL;

$stmt = $pdo->prepare("select * form login_mypage where mail = ? && password = ?");

$stmt->bindvalue(1, $_POST['mail']);
$stmt->bindvalue(2, $_POST['password']);

$stmt->execute();
$pdo = NULL;

while($row=$stmt->fetch()){
    $stmt->bindvalue(1, $_POST['name']);
    $stmt->bindvalue(2, $_POST['mail']);
    $stmt->bindvalue(3, $_POST['password']);
    $stmt->bindvalue(4, $_POST['path_filename']);
    $stmt->bindvalue(5, $_POST['comments']);
}

header("Location:http://localhost/login_mypage/mypage.php");
?>
