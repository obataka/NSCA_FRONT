<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/changePasswordMail/changePasswordMail_tpl.php';

$kaiin_no = (!empty($_POST['kaiin_no'])) ? htmlentities($_POST['kaiin_no'], ENT_QUOTES, "UTF-8") : "";
$mail_address = (!empty($_POST['mail_address'])) ? htmlentities($_POST['mail_address'], ENT_QUOTES, "UTF-8") : "";
include_once $includeView;