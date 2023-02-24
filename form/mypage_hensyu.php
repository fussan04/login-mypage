<?php
mb_internal_encoding("utf-8");

session_start();
?>


<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>マイページ登録</title>
        <link rel="stylesheet" type="text/css" href="./style.css/hensyu.css">
    </head>
    <body>
        <header>
            <img src="4eachblog_logo.jpg">
            <div class="logauto"><a href="logi_out.php">ログアウト</a></div>
        </header>
        <main>
            <div class="confirm">
                    <div class="greeting">
                    <h2>会員情報</h2>
                        <p> <?php echo "こんにちは！" . $_SESSION['name'];"さん" ?></p>
                    </div>
                <form action="mypage_update.php" method="post">
                    <div class="profile_pic">
                     <img src="<?php echo $_SEESION['picture']; ?>">
                    </div>
                 <div class="myself_info">
                    <p>氏名：<input type="text" size="30" value="<?php echo $_SEESION['name']; ?>" name="name">
                    </p>
                    <p>メール：<input type="text" size="30" value="<?php echo $_SEESION['mail']; ?>" name="mail">
                    </p>
                    <p>パスワード：<input type="text" size="30" value="<?php echo $_SEESION['password']; ?>" name="password">
                    </p>
                    <input type="hidden" value="<?php echo rand(1,10);?>" name="mypage_hensyu">
                    <textarea rows="5" cols="15" name="comments"><?php echo $_SEESION['comments']; ?></textarea>
                    </form>
                    <div class="submit_button">
                    <input type="submit" size="35" value="編集する">
                </div>
            </div>
        </main>

        <footer>
        ©2018 InterNous.inc.All rights reserved
        </footer>
    </body>
</html>