<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta name='format-detection' content='telephone=no' />
    <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
    <title>購入動画再生</title>
    <!-- favicon -->
    <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
    <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
    <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
    <link rel="stylesheet" href="../../viewIncludeFiles/css/konyuzumi_doga_saisei.css">
    <link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

    <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
    <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
    <script type="text/javascript" src="../../viewIncludeFiles/js/videoPlayBack.js"></script>
    <script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
    <script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
    <script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>

</head>

<body>
    <header id="header">
    </header>
    <div class="wrap mh_c btn_b_wrap">
        <form>
            <input type="hidden" id="doga_id" name="doga_id" value="<?php echo $doga_id; ?>">
        </form>
        <h2>購入動画再生</h2>
        <section id="video">
        </section>
        <button class="button btn_b btn_b_1" type="button" id="videoList" value="" onclick="location.href='#'"><span>購入済み動画一覧へ</span></button>
    </div>
    <footer id="footer">
    </footer>
</body>

</html>