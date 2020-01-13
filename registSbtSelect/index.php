<?php
namespace Was;

include_once '../ctrl/parts/beforeLoginHeader.php';

require '../classes/Config/Config.php';
require '../classes/DBAccess/Db.php';
require '../classes/DBAccess/Tb_new_token.php';

$wk_error_msg = "";
$wk_mail_address = "";
$includeView = '../views/registSbtSelect/registSbtSelect_tpl.php';

// GET�p�����[�^�̃`�F�b�N
// GET�p�����[�^��id���Ȃ��ꍇ
if (!isset($_GET['id'])) {

    // �G���[���b�Z�[�W��ݒ�
    $wk_error_msg = "URL�������ł��B";

    // �e���v���[�g���G���[�p�ɐݒ�
    $includeView = '../views/registSbtSelect/registSbtSelectError_tpl.php';

// GET�p�����[�^��id�͂��邪token���Ȃ��ꍇ
} elseif (!isset($_GET['token'])) {

    // �G���[���b�Z�[�W��ݒ�
    $wk_error_msg = "URL�������ł��B";

    // �e���v���[�g���G���[�p�ɐݒ�
    $includeView = '../views/registSbtSelect/registSbtSelectError_tpl.php';

// GET�p�����[�^�͐ݒ肪����ꍇ
} else {

    // GET�p�����[�^��ޔ�
    $wk_id = $_GET['id'];
    $wk_token = $_GET['token'];

    // TB�V�K����p�g�[�N���e�[�u������f�[�^���擾����
    $tb_new_token = (new Tb_new_token())->findById($wk_id);

    // �Y���f�[�^�Ȃ��̏ꍇ
    if ($tb_new_token == "") {

        // �G���[���b�Z�[�W��ݒ�
        $wk_error_msg = "URL�������ł��B";

        // �e���v���[�g���G���[�p�ɐݒ�
        $includeView = '../views/registSbtSelect/registSbtSelectError_tpl.php';

    // �Y���f�[�^����̏ꍇ
    } else {

        // �g�[�N�����e�[�u����GET�p�����[�^�ňقȂ�ꍇ
        if ($wk_token != $tb_new_token['one_time_token']) {

            // �G���[���b�Z�[�W��ݒ�
            $wk_error_msg = "URL�������ł��B";

            // �e���v���[�g���G���[�p�ɐݒ�
            $includeView = '../views/registSbtSelect/registSbtSelectError_tpl.php';

        // �g�[�N�����e�[�u����GET�p�����[�^�œ����ꍇ
        } else {

            $limitMax = $tb_new_token['yukokigen_nichiji'];
            $wkNow = date("Y-m-d H:i:s");

            // �L�������𒴂��Ă�ꍇ
            if ($limitMax < $wkNow) {

                // �G���[���b�Z�[�W��ݒ�
                $wk_error_msg = "URL�������ł��B";

                // �e���v���[�g���G���[�p�ɐݒ�
                $includeView = '../views/registSbtSelect/registSbtSelectError_tpl.php';

                // TB�V�K����p�g�[�N���e�[�u���̊Y���f�[�^���폜
                $del_ret = (new Tb_new_token())->deleteRec($wk_id);

            // �L�������𒴂��Ă��Ȃ��ꍇ
            } else {

                // ���[���A�h���X��ޔ�
                $wk_mail_address = $tb_new_token['mail_address'];

            }
        }
    }
}

include_once $includeView;
