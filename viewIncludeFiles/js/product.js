(function($){
    $(document).ready(function(){

	/************************************************************
	*���i�ڍ׏��擾
	*************************************************************/
    jQuery.ajax({
        url:  '../../classes/product.php',
        type: 'POST',
        data:{hambai_id: $("#hambai_id").val()},
        success: function(rtn) {
           // ���i�ڍ׏��A�Y���Ȃ�
                if (rtn == 0) {
//		            $("#err_pass_1").html("�L���������߂��Ă��܂��B�p�X���[�h�ύX�˗����[����ʂ��������x��蒼���Ă��������B");
//                    $("#pass_1").prop("disabled", true);
//                    return false;
				}else{

                    tbHanbaiJoho = JSON.parse(rtn);
                        $('#product_title').html(tbHanbaiJoho["hambai_title"]);
					var ippan_kakaku = Number(tbHanbaiJoho["ippan_kakaku_zeikomi"]).toLocaleString();
					var kakaku = Number(tbHanbaiJoho["kakaku_zeikomi"]).toLocaleString();
					var kaiin_kakaku = Number(tbHanbaiJoho["kaiin_kakaku_zeikomi"]).toLocaleString();

//                        $('#product_img').html(tbHanbaiJoho["gazo_url"]);
                        $('#price_ippan').html(ippan_kakaku);
                        $('#price_kaiin').html(kakaku);
                        $('#price_label').html(tbHanbaiJoho["kakaku_title"]);
                        $('#gaiyo').html(tbHanbaiJoho["gaiyo"]);
                        $('#setsumei').html(tbHanbaiJoho["setsumei"]);
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
