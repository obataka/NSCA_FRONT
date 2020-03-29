<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>コンビニ決済確認</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/konbini_kessai_kakunin.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/sweetalert2.min.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/sweetalert2.min.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/paymentCvs.js"></script>
    </head>
	<body>
	<header id="header">
    </header>
		<div class="wrap">
			<h2>コンビニ決済確認</h2>
			<div class="content_wrap">
                <form method="post" id="paymentCvsForm" name="paymentCvsForm" action="../../paymentCvsNumber/">
                    <input type="hidden" id="conveni" name="conveni" value="">    
                    <input type="hidden" id="payNo" name="payNo" value="">
                    <input type="hidden" id="transNo" name="transNo" value="">
                    <h3>請求内容</h3>
                    <div class="table">
                        <table>
                        <tr>
                            <th>店舗名</th>
                            <td><?php echo $shopName; ?></td>
                        </tr>
                        <tr>
                            <th>お客様名</th>
                            <td id="customerName"><?php echo $customerName; ?></td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td id="phoneNo"><?php echo $phoneNo; ?></td>
                        </tr>
                        <tr>
                            <th>伝票番号</th>
                            <td id="slipNo"><?php echo $slipNo; ?></td>
                        </tr>
                        <tr>
                            <th>商品名</th>
                            <td><?php echo $itemName; ?></td>
                        </tr>
                    </table>
                    </div>

                    <div class="price">
                        <p>金額　：<span id="price"><?php echo $price; ?></span>円</p>
                    </div>
                    <h3>お支払方法の選択</h3>
                    <div class="shiharai_img">
                        <a class="chooseConveni" conveni="seveneleven" href="#"><img src="https://placehold.jp/150x150.png"></a>
                        <a class="chooseConveni" conveni="famima" href="#"><img src="https://placehold.jp/150x150.png"></a>
                        <a class="chooseConveni" conveni="lawson" href="#/"><img src="https://placehold.jp/150x150.png"></a>
                        <a class="chooseConveni" conveni="seicomart" href="#"><img src="https://placehold.jp/150x150.png"></a>
                    </div>
                    <button class="button" type="button" id="back" value=""><span>決済方法選択画面へ</span></button>
                </form>
			</div>
		</div>
	<footer id="footer">
	</footer>
</body>
</html>
