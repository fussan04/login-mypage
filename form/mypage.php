<?php
mb_internal_encoding("utf-8");

session_start();
if (empty($_SESSION['id'])) {
    try {
        $pdo = new PDO("mysql:dbname=form;host=localhost;", "root", "root");
    } catch (PDOException $e) {
        die("<p>申し訳ございません。現在サーバーが込み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインしてください。</p>
    <a href='http://localhost/login_mypage/loguin.php'>ログイン画面へ</a>"
        );
    }

    $stmt = $pdo->prepare("select * from login_mypage where mail = ? && password = ?");

    $stmt->bindValue(1, $_POST["mail"]);
    $stmt->bindValue(2, $_POST["password"]);

    $stmt->execute();
    $pdo = NULL;

    while ($row = $stmt->fetch()) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['mail'] = $row['mail'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['picture'] = $row['picture'];
        $_SESSION['comments'] = $row['comments'];
    }

}

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
        <title>マイページ登録</title>
        <link rel="stylesheet" type="text/css" href="./mypage.css">
    </head>
    <body>

    <header>
         <img src="4eachblog_logo.jpg">
         <div class="logauto"><a href="logi_out.php">ログアウト</a></div>
    </header>
    <main>
            <div class="confirm">
                <h2>会員情報</h2>
                <div class="confirm_contents">
                    <div class="greeting">
                        <p> こんにちは！コーラさん</p>
                    </div>
                    <div class="photo">
                        <img src="<?php echo $_SESSION['picture']; ?>" width="100px">
                    </div>
                    <div class="myself">
                        <p>氏名：コーラ
                            
                        </p>
                        <p>メール：
                             <?php echo $_SESSION['mail']; ?>
                        </p>
                        <p>パスワード：
                            <?php echo $_SESSION['password']; ?>
                        </p>
                    </div>
                        <div class="comment">
                            <p>コメント：
                                <?php echo $_SESSION['comments']; ?>
                            </p>
                        </div>
                        <form action="mypage_hensyu.php" method="post" class="form_center">
                            <input type="hidden" value="<?php echo rand(1,10);?>" name="from_mypage">
                        <div class="submit_button">
                            <form action="mypage_hensyu.php" method="post"> 
                                <input type="submit" value="編集する">
                            </form>
                        </form>
                        </div>
                        
                </div>
            </div>
    </main>

    <footer>
    ©2018 InterNous.inc.All rights reserved
      </footer>

    </body>
</html>