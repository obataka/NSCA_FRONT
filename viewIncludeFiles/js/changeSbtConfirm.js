(function ($) {
    $(document).ready(function () {
        /******************************************
         *�����ʑI��ύX�{�^����������
         ******************************************/
        $("#back").click(function () {
            location.href = "../../changeSbt/";
        });
        /******************************************
        *���݂̉����ʎ擾����
        ******************************************/
        //�����ʂ��i�[����ϐ�
        var wk_kaiin_sbt;
        $.ajax({
            url: '../../classes/getKaiinSbt.php',
            type: 'POST',
        }).done((rtn) => {
            console.log(rtn);
            wk_kaiin_sbt = JSON.parse(rtn);
            if (wk_kaiin_sbt[0] == 0) {
                $("#kaiin_sbt_currnt").text("���p���(����)");
            } else if (wk_kaiin_sbt[0] == 1) {
                $("#kaiin_sbt_currnt").text("NSCA�����");
            } else if (wk_kaiin_sbt[0] == 2) {
                $("#kaiin_sbt_currnt").text("�w�����");
            } else {
                return false;
            }
        }).fail((rtn) => {
            return false;
        });

        //���f�[�^���i�[����ϐ�
        var wk_kaihi;
        // ���f�[�^�擾����
        $.ajax({
            url: '../../classes/getKaihiData.php',
            type: 'POST',
        }).done((rtn) => {
            // rtn = 0 �̏ꍇ�́A�Y���Ȃ�
            if (rtn == 0) {
                return false;
            } else {
                wk_cmControl = JSON.parse(rtn);
                //���f�[�^�\������
                if (wk_kaiin_sbt[0] == 0) {
                    $("#kaihi_currnt").text("����");
                } else if (wk_kaiin_sbt[0] == 1) {
                    wk_kaihi = Math.floor(wk_cmControl['20']).toLocaleString() + "�~";
                    $("#kaihi_currnt").text(wk_kaihi);
                } else if (wk_kaiin_sbt[0] == 2) {
                    wk_kaihi = Math.floor(wk_cmControl['21']).toLocaleString() + "�~";
                    $("#kaihi_currnt").text(wk_kaihi);
                } else {
                    return false;
                }
            }
        }).fail((rtn) => {
            return false;
        });

        /******************************************
         *�ύX�{�^����������
         ******************************************/
        $("#next").click(function () {
            //���݂̉����ʂ���������̏ꍇ�A�V�K�o�^��ʂɑJ�ڂ���B
            //����ȊO�̏ꍇ�A�p���葱���̂��肢�։�ʑJ�ڂ���B
            if (wk_kaiin_sbt[0] == 0) {
                url = '../../registMember/';
                $('form').attr('action', url);
                $('form').submit();
            } else {
                url = '../../continueRequest/';
                $('form').attr('action', url);
                $('form').submit();
            }
        });
    });
})(jQuery);
