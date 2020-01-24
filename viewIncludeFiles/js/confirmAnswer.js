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

        /************************
        *���ϕ��@�I���փ{�^��������
        *************************/
        $("#next_button").click(function() {

            /*************
            *��������擾
            **************/
            $.ajax({
               url:  '../../classes/getTbkaiinJoho.php',
            })
          
            // Ajax���N�G�X�g����������������
            .done( (rtn) => {
            
                // rtn = 0 �̏ꍇ�́A�Y���Ȃ�
                if (rtn == 0) {
                   
                    $('.error_ul').html('�V�X�e���G���[���������܂����B');
                    return false;
               
                // rtn = 0 �ȊO�̏ꍇ�́A�������s
                } else {
                    
                    //�Ԃ��Ă�����������Z�b�g
                    getTbkaiinJoho = JSON.parse(rtn);
                    console.log(getTbkaiinJoho);
                    
                    var name_mei = getTbkaiinJoho['shimei_sei'] + getTbkaiinJoho['shimei_mei'];
                    var name_kana = getTbkaiinJoho['furigana_sei'] + getTbkaiinJoho['furigana_mei'];
                    
                    
                    //tel���󔒂łȂ��ꍇ�Atel���Z�b�g�Btel���󔒂̏ꍇ�Akeitai_no���Z�b�g
                    if (getTbkaiinJoho['tel'] !== "") {
                        var tel1 = getTbkaiinJoho['tel'];
                    } else {
                        var tel1 = getTbkaiinJoho['keitai_no'];
                    }
                    console.log(tel1);
                    
                    /**********************
                    *CM�R���g���[�������擾
                    ***********************/
                    $.ajax({
                        url:  '../../classes/getCmControl.php',
                    })
                
                    // Ajax���N�G�X�g����������������
                    .done( (rtn) => {
                    
                        // rtn = 0 �̏ꍇ�́A�Y���Ȃ�
                        if (rtn == 0) {
                            
                            $('.error_ul').html('�V�X�e���G���[���������܂����B');
                            return false;
                        
                        // rtn = 0 �ȊO�̏ꍇ�́A�������s
                        } else {
                            //�Ԃ��Ă���CM�R���g���[�������Z�b�g
                            getCmControl = JSON.parse(rtn);
                            console.log(getCmControl);
                            var quiz = getCmControl["quiz_tokuten"];
                            
                            /******************
                            *CEU�N�C�Y�����擾
                            *******************/
                            $.ajax({
                                url:  '../../classes/getQuiz.php',
                                type: 'POST',
                                data:{
                                    //ceu_id���Z�b�g
                                    ceu_id : $("#ceu_id1").val(),
                                }
                            })
                            
                            // Ajax���N�G�X�g����������������
                            .done( (rtn) => {
        
                            // rtn = 0 �̏ꍇ�́A�Y���Ȃ�
                            if (rtn == 0) {
        
                                $('.error_ul').html('�V�X�e���G���[���������܂����B');
                                return false;
        
                                // rtn = 0 �ȊO�̏ꍇ�́A�������s
                                } else {
                                    //�Ԃ��Ă���CM�R���g���[�������Z�b�g
                                    getQuiz = JSON.parse(rtn);
                                    console.log(getQuiz);
        
                                    var sankaryo1 = getQuiz['sankaryo'];
                                    var shutoku_naiyo1 = getQuiz['shutoku_naiyo'] + getQuiz['sankaryo'];
                                    var payeasy_mei = getQuiz['shutoku_naiyo'] + getQuiz['sankaryo'];
                                    var payeasy_kana = getQuiz['shutoku_naiyo'] + getQuiz['sankaryo'];
                                    var keiri1 = "08";
                                    var keiri2 = "02";
                                    var keiri3 = "";
                                    console.log(sankaryo1);
                                    console.log(shutoku_naiyo1);
                                    console.log(payeasy_mei);
                                    console.log(payeasy_kana);
                                    console.log(keiri1);
                                    console.log(keiri2);
                                    console.log(keiri3);
                                    
                                    // HIDDEN�f�[�^��SESSION�ɐύ��ޏ���
                                    $.ajax({
                                        url:  '../../classes/setKaiinDataToSess.php',
                                        type: 'POST',
                                        data:{
                                            //������̃e�[�u������
                                            shimei: name_mei,
                                            furigana: name_kana,
                                            tel: tel1,
                                            sankaryo: sankaryo1,
                                            shutoku_naiyo: shutoku_naiyo1,
                                            payeasy_mei: payeasy_mei,
                                            payeasy_kana: payeasy_kana,
                                            keiri1: keiri1,
                                            keiri2: keiri2,
                                            keiri3: keiri3,
                                        }
                                    })

                                    // Ajax���N�G�X�g����������������
                                    .done( (data) => {

                                    })

                                    // Ajax���N�G�X�g�����s����������
                                    .fail( (data) => {

                                    })

                                    // Ajax���N�G�X�g�������E���s�ǂ���ł�����
                                    .always( (data) => {
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
                            

            // /**********************
            // *CM�R���g���[�������擾
            // ***********************/
            // $.ajax({
            //     url:  '../../classes/getCmControl.php',
            // })
        
            // // Ajax���N�G�X�g����������������
            // .done( (rtn) => {
            
            //     // rtn = 0 �̏ꍇ�́A�Y���Ȃ�
            //     if (rtn == 0) {
                    
            //         $('.error_ul').html('�V�X�e���G���[���������܂����B');
            //         return false;
                
            //     // rtn = 0 �ȊO�̏ꍇ�́A�������s
            //     } else {
            //         //�Ԃ��Ă���CM�R���g���[�������Z�b�g
            //         getCmControl = JSON.parse(rtn);
            //         console.log(getCmControl);
            //     }
            // })
            
            // // Ajax���N�G�X�g�����s����������
            // .fail( (rtn) => {
                
            //     $('.error_ul').html('�V�X�e���G���[���������܂����B');
            //     return false;
            // })

            // // Ajax���N�G�X�g�������E���s�ǂ���ł�����
            // .always( (data) => {
            // });


            // /******************
            // *CEU�N�C�Y�����擾
            // *******************/
            // $.ajax({
            //     url:  '../../classes/getQuiz.php',
            //     type: 'POST',
            //         data:{
            //             //ceu_id���Z�b�g
            //             ceu_id : $("#ceu_id1").val(),
            //         }
            // })
        
            // // Ajax���N�G�X�g����������������
            // .done( (rtn) => {
            
            //     // rtn = 0 �̏ꍇ�́A�Y���Ȃ�
            //     if (rtn == 0) {
                    
            //         $('.error_ul').html('�V�X�e���G���[���������܂����B');
            //         return false;
                
            //     // rtn = 0 �ȊO�̏ꍇ�́A�������s
            //     } else {
            //         //�Ԃ��Ă���CM�R���g���[�������Z�b�g
            //         getQuiz = JSON.parse(rtn);
            //         console.log(getQuiz);
            //     }
            // })
            
            // // Ajax���N�G�X�g�����s����������
            // .fail( (rtn) => {
                
            //     $('.error_ul').html('�V�X�e���G���[���������܂����B');
            //     return false;
            // })

            // // Ajax���N�G�X�g�������E���s�ǂ���ł�����
            // .always( (data) => {
            // });

        //     /***********************
        //     *CEUCEU�N�C�Y���������擾
        //     ************************/
        // $.ajax({
        //     url:  '../../classes/getQuizAnswer.php',
        //     type: 'POST',
        //         data:{
        //             //ceu_id���Z�b�g
        //             ceu_id : $("#ceu_id1").val(),
        //         }
        //     })
        
        //     // Ajax���N�G�X�g����������������
        //     .done( (rtn) => {
            
        //         // rtn = 0 �̏ꍇ�́A�Y���Ȃ�
        //         if (rtn == 0) {
                    
        //             $('.error_ul').html('�V�X�e���G���[���������܂����B');
        //             return false;
                
        //         // rtn = 0 �ȊO�̏ꍇ�́A�������s
        //         } else {
        //             //�Ԃ��Ă���CM�R���g���[�������Z�b�g
        //             getQuizAnswer = JSON.parse(rtn);
        //             console.log(getQuizAnswer);
        //         }
        //     })
            
        //     // Ajax���N�G�X�g�����s����������
        //     .fail( (rtn) => {
                
        //         $('.error_ul').html('�V�X�e���G���[���������܂����B');
        //         return false;
        //     })

        //     // Ajax���N�G�X�g�������E���s�ǂ���ł�����
        //     .always( (data) => {
        //     });
        });
    });
})(jQuery);