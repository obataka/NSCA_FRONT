(function($){
    $(document).ready(function(){


        //�擾�����ݖ␔������<div>���쐬����
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
                    
                    //�I���������W�I�{�^���̒l���Z�b�g����ׁA���I��hidden��input�^�O���쐬
                    var input1 = $('<input>').attr({
                        type: 'hidden',
                        id: 'sel_q' + [i] + '_1',
                        name: 'sel_q' + [i] + '_1',
                        value: '<?php echo $sel_q' + [i] + '_1; ?>'
                    });
                    $('form').prepend(input1);

                    //�I���������W�I�{�^���̃e�L�X�g���Z�b�g����ׁA���I��hidden��input�^�O���쐬
                    var input2 = $('<input>').attr({
                        type: 'hidden',
                        id: 'val_q' + [i] + '_1',
                        name: 'val_q' + [i] + '_1',
                        value: '<?php echo $val_q' + [i] + '_1; ?>'
                    });
                    $('form').prepend(input2);

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

        // //var arr = [$("#sel_q1_1").val()];

         console.log($('#sel_q1_1').val()); 

        // var r = $('#sel_q1_1').val();
        // console.log(r[0]);
        

        // var t = $("#sel_q1_1:nth-child(0)").val();


        // //var r = $('#sel_q1_1').val([1]);
        

        // console.log(t);
        

        // // �z��members�����ɏ���
        // $.each($("#sel_q1_1").val(),function(index, elem) {
        //     // �N�40�ȏ�̃����o�[�����������Ƃ���ŏo�͒�~
        //     if (elem >= 5) { return false; }
        //         // �����o�[�����u���O�i�N��j�v�̌`���Ń��X�g�ɐ��`
        //         $('.kai_1')
        //         .append(elem[1])
        //         .appendTo('#result');
        // });







    
    });
})(jQuery);