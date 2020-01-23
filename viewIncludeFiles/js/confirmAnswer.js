(function($){
    $(document).ready(function(){

        /******************************************************
        *�擾�����ݖ␔������<div>���쐬���A�I�������������\������
        *******************************************************/
        $.ajax({
            url:  '../../classes/getCeuQuizSetsumon.php',
            type: 'POST',
            data:
            {
                //ceu_id�Z�b�g
                ceu_id: $("#ceu_id1").val(),
            }
        })
        
        // Ajax���N�G�X�g����������������
        .done( (rtn) => {
            
            // rtn = 0 �̏ꍇ�́A�Y���Ȃ�
            if (rtn == 0) {
                return false;

            // rtn = 1 �̏ꍇ�́A�Y������
            } else {

                //�������CEU�N�C�Y�����擾�ł������̏���
                getCeuQuizSetsumon = JSON.parse(rtn);
                $(".h2_text").text(getCeuQuizSetsumon[0]["shutoku_naiyo"]);
                
                // �z��getCeuQuizSetsumon�����ɏ���
                var i = 1;
                $.each(getCeuQuizSetsumon,function(index, elem) {
                    
                    // �ݖ₪������Ȃ������Ƃ���ŏo�͒�~
                    if (elem.setsumon == "") {
                        return false;
                    }

                    //���I��<div>���쐬
                    var div = '<div class="content">' 
                             + '<p class="dai dai_' + [i] + '"></p>'
                             + '<p class="no no_' + [i] + '"></p>'
                             + '<p class="kai kai_' + [i] + '"></p>'
                             + '</div>'

                    //<div>���쐬
                    $(".p_section").append(div);

                    // �ݖ���Z�b�g
                    $(".dai_" + [i] + "").append(elem.setsumon)
                    .appendTo('#result');

                    // �ԍ����Z�b�g
                    if (elem.sentakushi_a !== "") {
                        $(".no_" + [i] + "").append("No." + elem.setsumon_no);
                    }

                    //�I�����̕������\������
                    if ($('#sel_q' + [i] + '')) {
                        var sel_q = $('#sel_q' + [i] + '').val();
                        $('.kai_' + [i] + '').html(sel_q);
                    }

                    //���[�v��id��name��class��i��+1����
                    i = i + 1;
                });               
            }
        })

        // Ajax���N�G�X�g�����s����������
        .fail( (rtn) => {
            $('.error_ul').html('�V�X�e���G���[���������܂����B');
            return false;
        })

        // Ajax���N�G�X�g�������E���s�ǂ���ł�����
        .always( (data) => {
        });

        /************************
        *�񓚂��C������{�^��������
        *************************/
       $(".back").click(function() {
            
        url = '../inputAnswer/';
            $('form').attr('action', url);
            $('form').submit();

        });

    });
})(jQuery);