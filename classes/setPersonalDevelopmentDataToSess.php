<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';

$return_value = -1;

// POSTデータを取得
// seminarConfirm.jsでセットしたPOSTデータからSESSIONにセット

$_SESSION['kaiin_no'] = (!empty($_POST['kaiin_no'])) ? htmlentities($_POST['kaiin_no'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['ceu_id'] = (!empty($_POST['ceu_id'])) ? htmlentities($_POST['ceu_id'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['category_kbn'] = (!empty($_POST['category_kbn'])) ? htmlentities($_POST['category_kbn'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['nendo_id'] = (!empty($_POST['nendo_id'])) ? htmlentities($_POST['nendo_id'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['ceusu'] = (!empty($_POST['ceusu'])) ? htmlentities($_POST['ceusu'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['shutokubi'] = (!empty($_POST['shutokubi'])) ? htmlentities($_POST['shutokubi'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['chkCSCS'] = (!empty($_POST['chkCSCS'])) ? htmlentities($_POST['chkCSCS'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['chkCPT'] = (!empty($_POST['chkCPT'])) ? htmlentities($_POST['chkCPT'], ENT_QUOTES, "UTF-8") : "";

$_SESSION['tranScreen'] = (!empty($_POST['tranScreen'])) ? htmlentities($_POST['tranScreen'], ENT_QUOTES, "UTF-8") : "";

echo $return_value;
die();
