<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>ログイン画面</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/login.css" />

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/login.js"></script>
    </head>
    <body id="login">
        <form method="POST" id="loginForm" name="loginForm">
            <div class="content_wrap">
                <div class="content">
                    <div class="login_img">
                        <img src="../../viewIncludeFiles/image/NSCA_Japan_rev.png" alt="NSCAジャパン">
                    </div>
                    <input type="text" placeholder="ログインID" name="login_id" id="login_id" class="input_w_300" maxlength="256">
                    <input type="password" placeholder="パスワード" name="password" id="password" class="input_w_300" maxlength="25">
                    <ul class="error_ul mb_15">
                        <li class="error"></li>
                    </ul>
                    <button class="button btn_1 mt_30" type="button" name="__send" id="__send" value=""><span>Login</span></button>
                    <div class="login_text">
                        <p>
                            <a href="../changePasswordMail/">パスワードをお忘れですか？</a><br>
                            <a href="../registInformation/" target="_blank">入会案内</a><span>|</span>
                            <a href="../registMail/">新規登録はこちら</a>
                        </p>
                    </div>
                </div>
            </div>
        </form>
        <?php include('../views/templates/footer.php'); ?>
    </body>
</html>
