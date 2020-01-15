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
				} else {

                        tbEventJoho = JSON.parse(rtn);

					// �C�x���g�\������2�������[�v��������
					for(var i = 0; i < 2 ; i++) {
						// �f�[�^������ꍇ�̓f�[�^���Z�b�g����
						if(i < tbEventJoho.length){
							$("#event_list"+(i+1)).show();
				            $("#event_meisho"+(i+1)).html(tbEventJoho[i]["meisho"]);
				            $("#event_naiyo"+(i+1)).html(tbEventJoho[i]["shutoku_naiyo"]);
							if(tbEventJoho[i]["nokori"] == 0){
								$("#event_nokori"+(i+1)).hide();
							}else{
								$("#event_nokori"+(i+1)).show();
							}
						// �f�[�^���Ȃ��ꍇ�͔�\���ɂ���
						}else{
							$("#event_list"+(i+1)).hide();
//							$("#event_meisho"+(i+1)).hide();
//							$("#event_naiyo"+(i+1)).hide();
//							$("#event_nokori"+(i+1)).hide();
//							$("#event_button"+(i+1)).hide();
						}
					}
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
	*�\���󋵏��擾
	*************************************************************/
    jQuery.ajax({
        url:  '../../classes/mypageGetApply.php',
        type: 'POST',
        success: function(rtn) {

            // �\���󋵏�A�Y���Ȃ�
                if (rtn == 0) {
//		            $("#err_pass_1").html("���ݐ\����񂪂������܂���");
				} else {

                        tbEventJoho = JSON.parse(rtn);

					// �C�x���g�\������4�������[�v��������
					for(var i = 0; i < 4 ; i++) {
						// �f�[�^������ꍇ�̓f�[�^���Z�b�g����
						if(i < tbEventJoho.length){
							$("#apply_list"+(i+1)).show();
				            $("#apply_naiyo"+(i+1)).html(tbEventJoho[i]["shutoku_naiyo"]);
				            $("#apply_button"+(i+1)).text(tbEventJoho[i]["button_text"]);
						// �f�[�^���Ȃ��ꍇ�͔�\���ɂ���
						}else{
							$("#apply_list"+(i+1)).hide();
//							$("#apply_naiyo"+(i+1)).hide();
//							$("#apply_button"+(i+1)).hide();
						}
					}
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
	*�x�����擾
	*************************************************************/
    jQuery.ajax({
        url:  '../../classes/mypageGetPayment.php',
        type: 'POST',
        success: function(rtn) {

            // �\���󋵏�A�Y���Ȃ�
                if (rtn == 0) {
//		            $("#err_pass_1").html("���ݎx������񂪂������܂���");
				} else {

                        tbEventJoho = JSON.parse(rtn);

					// �C�x���g�\������4�������[�v��������
					for(var i = 0; i < 4 ; i++) {
						// �f�[�^������ꍇ�̓f�[�^���Z�b�g����
						if(i < tbEventJoho.length){
							$("#payment_list"+(i+1)).show();
				            $("#payment_naiyo"+(i+1)).html(tbEventJoho[i]["shutoku_naiyo"]);
						// �f�[�^���Ȃ��ꍇ�͔�\���ɂ���
						}else{
							$("#payment_list"+(i+1)).hide();
						}
					}
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

