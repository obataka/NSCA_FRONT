<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>入会申込</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/registMail.css" />

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/registMail.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
    </head>
    <body>
        <header class="header_logo">
            <div>
            	<img src="../../viewIncludeFiles/image/NSCA_Japan_rev.png" alt="ロゴ">
            </div>
        </header>
        <div class="wrap mh_c btn_b_wrap">
            <h1>入会申込</h1>
            <div class="content_wrap">
                <p class="h2_text">【登録の流れ】</p>
                <ul>
                    <li>1.下記にメールアドレスを入力して、[メール送信]ボタンを押下します。</li>
                    <li>2.メールが届いたら、メールに記載されているURLをクリックします。</li>
                    <li>3.利用登録に必要なお名前やご連卓先などを入力して登録完了となります。</li>
                </ul>
                <form>
                    <table>
                        <tr>
                            <th><span class="required">必須</span>メールアドレス</th>
                            <td>
                                <input id="mail" class="w_80" type="email" name="mail" value="">
                                <ul class="error_ul">
                                    <li class="error"></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </form>
                <section>
                    <button class="button btn_b btn_b_1" type="submit" value="" onclick="location.href='#'"><span>メール送信</span></button>
                </section>
            </div>
        </div>
        <footer id="footer">
        </footer>
    </body>
    </html>
