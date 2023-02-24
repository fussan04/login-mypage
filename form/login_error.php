<?php
 // password_verfy()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用
// セッション開始
session_start();
if(isset($_SESSION['id'])){
    header("Location:mypage.php");
}

$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "root";  // ユーザー名
$db['pass'] = "root";  // ユーザー名のパスワード
$db['dbname'] = "form";  // データベース名

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["mail"])) {  // emptyは値が空のとき
        $errorMessage = 'メールアドレスが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["mail"]) && !empty($_POST["password"])) {
        // 入力したユーザIDを格納
        $userid = $_POST["mail"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
       

        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['mail'], $db['password'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare('SELECT * FROM mypage_login WHERE name = ?');
            $stmt->execute(array($userid));

            $password = $_POST["password"];

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['password'])) {
                    session_regenerate_id(true);

                    // 入力したIDのユーザー名を取得
                    $id = $row['mail'];
                    $sql = "SELECT * FROM mypage_login WHERE id = $id";  //入力したIDからユーザー名を取得
                    $stmt = $pdo->query($sql);
                    foreach ($stmt as $row) {
                        $row['name'];  // ユーザー名
                    }
                    $_SESSION["NAME"] = $row['name'];
                    header("Location: mypage.php");  // メイン画面へ遷移
                    exit();  // 処理終了
                } else {
                    // 認証失敗
                    $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
                }
            } else {
                // 4. 認証成功なら、セッションIDを新規に発行する
                // 該当データなし
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            // echo $e->getMessage();
        }
    }
}
?>



<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>マイページ登録</title>
        <link rel="stylesheet" href="./login.css">
    </head>
    <body>

    <header>
         <img src="4eachblog_logo.jpg">
    </header>
    <main>
            <form action="mypage.php" method="POST">
                <div class="form_contents">
                    <div class="error">
                        <p>メールアドレスまたはパスワードが間違っています。<p>
                    </div>
                    <div class="mail">
                        <label>メールアドレス</label>
                        <br>
                        <input type="text" class="formbox" size="40" value="<?php setcookie('mail','password')?>" name="mail" placeholder="メールアドレスを入力">
                    </div>
                    <div class="password">
                        <label>パスワード</label>
                        <br>
                        <input type="text" class="formbox" size="40" name="password" placeholder="パスワードを入力">
                    </div>
                    <div class="login_check">
                        <label><input type="checkbox" class="formbox" size="40" name="login_keep" value="login_keep"
                        >ログイン状態を保持する</label>
                    <div class="toroku">
                    <input type="submit" class="submit_button" size="35" value="ログイン">
                </div>
                </div>
            </form>
    </main>
        <footer>
        ©2018 InterNous.inc.All rights reserved
        </footer>
    </body>
</html> 