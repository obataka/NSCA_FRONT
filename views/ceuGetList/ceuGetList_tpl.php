<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>CEU取得状況</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/ceu_shutoku_jyokyo.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">
	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/ceuGetList.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
</head>

<body>
	<?php include('../views/templates/header.php'); ?>
	<div class="wrap">
		<h1>CEU取得状況</h1>
		<div class="content_wrap">
			<section>
				<div class="ceu">
					<p>CEU</p>
					<div>
						<div class="ceu-wrap">
							<div class="text-wrap">
								<span>CSCS</span>
								<span>1.0/6.0<span>(CEU取得率/CEU必要数)</span></span>
								<span>取得率：17％</span>
							</div>
							<div class="percent">
								<span></span>
							</div>
						</div>
						<div class="ceu-wrap">
							<div class="text-wrap">
								<span>NSCA-CPT</span>
								<span>1.0/6.0<span>(CEU取得率/CEU必要数)</span></span>
								<span>取得率：17％</span>
							</div>
							<div class="percent">
								<span></span>
							</div>
						</div>
					</div>
				</div>
				<div class="link">
					<p>CEUリンク集</p>
					<ul>
						<li id="kyoiku"><a href="">継続教育（CEU）について</a></li>
						<li id="program"><a href="">特別プログラム(*D)</a></li>
						<li id="ceu_kanri"><a href="">CEU管理の移行(日本←→米国)</a></li>
						<li id="qa"><a href="">Q&amp;A</a></li>
					</ul>
				</div>
			</section>
			<div class="ceu_jyokyo">
				<h2>CEU取得状況</h2>
				<table>
					<thead>
						<tr>
							<th></th>
							<th>CSCS</th>
							<th>NSCA-CPT</th>
							<th>取得ポイント</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>必要CEU（①）</td>
							<td id="cscs_hitsuyo" data-label="CSCS"></td>
							<td id="cpt_hitsuyo" data-label="NSCA-CPT"></td>
							<td class="pc-only"></td>
						</tr>
						<tr>
							<td>カテゴリーA</td>
							<td id="cscs_category_a" data-label="CSCS"></td>
							<td id="cpt_category_a" data-label="NSCA-CPT"></td>
							<td id="a_syutoku_p" data-label="取得ポイント"></td>
						</tr>
						<tr>
							<td>カテゴリーB</td>
							<td id="cscs_category_b" data-label="CSCS"></td>
							<td id="cpt_category_b" data-label="NSCA-CPT"></td>
							<td id="b_syutoku_p" data-label="取得ポイント"></td>
						</tr>
						<tr>
							<td>カテゴリーC</td>
							<td id="cscs_category_c" data-label="CSCS"></td>
							<td id="cpt_category_c" data-label="NSCA-CPT"></td>
							<td id="c_syutoku_p" data-label="取得ポイント"></td>
						</tr>
						<tr>
							<td>カテゴリーD</td>
							<td id="cscs_category_d" data-label="CSCS"></td>
							<td id="cpt_category_d" data-label="NSCA-CPT"></td>
							<td id="d_syutoku_p" data-label="取得ポイント"></td>
						</tr>
						<tr>
							<td>現在取得CEU（②）</td>
							<td id="cscs_genzai" data-label="CSCS"></td>
							<td id="cpt_genzai" data-label="NSCA-CPT"></td>
							<td class="pc-only"></td>
						</tr>
						<tr>
							<td>残りCEU（①－②）</td>
							<td id="cscs_zan" data-label="CSCS"></td>
							<td id="cpt_zan" data-label="NSCA-CPT"></td>
							<td class="pc-only"></td>
						</tr>
					</tbody>

				</table>
				<p>セミナー受講等のCEU活動は、マイページに反映されるまで、<br>
					活動日から1ヵ月ほどかかる場合がございますので、あらかじめご了承ください。</p>
			</div>
			<div class="ceu_joho">
				<h2>CEU情報</h2>
				<table>
					<thead>
						<tr>
							<th>取得日</th>
							<th>カテゴリー</th>
							<th>CEU数</th>
							<th>CSCS</th>
							<th>CPT</th>
							<th>レベル&#8545;P</th>
							<th>CEU内容</th>
						</tr>
					</thead>
					<tbody id="ceu_joho">
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>

				</table>
			</div>
		</div>
	</div>
	<?php include('../views/templates/footer.php'); ?>
</body>

</html>