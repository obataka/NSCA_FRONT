(function($){
    $(document).ready(function(){


	/************************************************************
	*������擾 
	*************************************************************/
    jQuery.ajax({
        url:  '../../classes/mypage.php',
        type: 'POST',
        success: function(rtn) {

           // ������A�Y���Ȃ�
                if (rtn == 0) {
//		            $("#err_pass_1").html("�L���������߂��Ă��܂��B�p�X���[�h�ύX�˗����[����ʂ��������x��蒼���Ă��������B");
//                    $("#pass_1").prop("disabled", true);
//                    return false;
				}else{

                        tbKaiinJoho = JSON.parse(rtn);

						// ������
                        $('#kaiin_no').html(tbKaiinJoho["kaiin_no"]);
                        $('#kaiin_name').html(tbKaiinJoho["kaiin_name"]);
                        $('#kaiin_sbt').html(tbKaiinJoho["kaiin_sbt"]);
                        $('#yuko_hizuke').html(tbKaiinJoho["yuko_hizuke"]);
                        $('#eibun_option').html(tbKaiinJoho["eibun_option"]);

						// ����
                        $('#nintei_no_c').html(tbKaiinJoho["nintei_no_c"]);
                        $('#ninteibi_c').html(tbKaiinJoho["ninteibi_c"]);
                        $('#yuko_kigen_c').html(tbKaiinJoho["yuko_kigen_c"]);
                        $('#nintei_no_n').html(tbKaiinJoho["nintei_no_n"]);
                        $('#ninteibi_n').html(tbKaiinJoho["ninteibi_n"]);
                        $('#yuko_kigen_n').html(tbKaiinJoho["yuko_kigen_n"]);

				}
            },
            fail: function(rtn) {
                return false;
            },
            error: function(rtn) {
                return false;
            }
    });

	/************************************************************
	*�C�x���g���擾 
	*************************************************************/

    jQuery.ajax({
        url:  '../../classes/mypageGetEvent.php',
        type: 'POST',
        success: function(rtn) {

            // �C�x���g���A�Y���Ȃ�
                if (rtn == 0) {
//		            $("#err_pass_1").html("���݃C�x���g��񂪂������܂���");
				}else{

                        tbEventJoho = JSON.parse(rtn);

for(tbEventJoho i = 0; i < tbEventJoho.length; i++) {
//  tbEventJoho[i]["ceu_id"]
//  tbEventJoho[i]["shutoku_naiyo"]
}
//                        $('#kaiin_no').html(tbKaiinJoho["kaiin_no"]);
//alert("---");
//alert(tbEventJoho[0]["shutoku_naiyo"]);
				}
            },
            fail: function(rtn) {
                return false;
            },
            error: function(rtn) {
                return false;
            }
    });





    });
})(jQuery);

