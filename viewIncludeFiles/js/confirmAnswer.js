(function($){
    $(document).ready(function(){

        /******************************************************
        *取得した設問数分だけ<div>を作成し、選択した文字列を表示する
        *******************************************************/
        $.ajax({
            url:  '../../classes/getCeuQuizSetsumon.php',
            type: 'POST',
            data:
            {
                //ceu_idセット
                ceu_id: $("#ceu_id1").val(),
            }
        })
        
        // Ajaxリクエストが成功した時発動
        .done( (rtn) => {
            
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;

            // rtn = 1 の場合は、該当あり
            } else {

                //※正常にCEUクイズ情報を取得できた時の処理
                getCeuQuizSetsumon = JSON.parse(rtn);
                $(".h2_text").text(getCeuQuizSetsumon[0]["shutoku_naiyo"]);
                
                // 配列getCeuQuizSetsumonを順に処理
                var i = 1;
                $.each(getCeuQuizSetsumon,function(index, elem) {
                    
                    // 設問が見つからなかったところで出力停止
                    if (elem.setsumon == "") {
                        return false;
                    }

                    //動的に<div>を作成
                    var div = '<div class="content">' 
                             + '<p class="dai dai_' + [i] + '"></p>'
                             + '<p class="no no_' + [i] + '"></p>'
                             + '<p class="kai kai_' + [i] + '"></p>'
                             + '</div>'

                    //<div>を作成
                    $(".p_section").append(div);

                    // 設問をセット
                    $(".dai_" + [i] + "").append(elem.setsumon)
                    .appendTo('#result');

                    // 番号をセット
                    if (elem.sentakushi_a !== "") {
                        $(".no_" + [i] + "").append("No." + elem.setsumon_no);
                    }

                    //選択肢の文字列を表示する
                    if ($('#sel_q' + [i] + '')) {
                        var sel_q = $('#sel_q' + [i] + '').val();
                        $('.kai_' + [i] + '').html(sel_q);
                    }

                    //ループでidとnameとclassのiを+1する
                    i = i + 1;
                });               
            }
        })

        // Ajaxリクエストが失敗した時発動
        .fail( (rtn) => {
            $('.error_ul').html('システムエラーが発生しました。');
            return false;
        })

        // Ajaxリクエストが成功・失敗どちらでも発動
        .always( (data) => {
        });

        /************************
        *回答を修正するボタン押下時
        *************************/
       $(".back").click(function() {
            
        url = '../inputAnswer/';
            $('form').attr('action', url);
            $('form').submit();

        });

        /************************
        *決済方法選択へボタン押下時
        *************************/
        $("#next_button").click(function() {

            /*************
            *会員情報を取得
            **************/
            $.ajax({
                url:  '../../classes/setKaiinDataToSess.php',
                type: 'POST',
				data:{

				    //ceu_idをセット
                    ceu_id : $("#ceu_id1").val(),
                    ques_num : $("#ques_num").val(),
				}    
            })

            // Ajaxリクエストが成功した時発動
            .done( (rtn) => {
                    
                    //正常の場合、決済画面に画面遷移する
                    url = '../paymentSelectNoLogin/';
                    $('form').attr('action', url);
                    $('form').submit();
            })
           
            // Ajaxリクエストが失敗した時発動
            .fail( (rtn) => {
               $('.error_ul').html('システムエラーが発生しました。');
               return false;
            })

            // Ajaxリクエストが成功・失敗どちらでも発動
            .always( (data) => {
            });
                            

            // /**********************
            // *CMコントロール情報を取得
            // ***********************/
            // $.ajax({
            //     url:  '../../classes/getCmControl.php',
            // })
        
            // // Ajaxリクエストが成功した時発動
            // .done( (rtn) => {
            
            //     // rtn = 0 の場合は、該当なし
            //     if (rtn == 0) {
                    
            //         $('.error_ul').html('システムエラーが発生しました。');
            //         return false;
                
            //     // rtn = 0 以外の場合は、処理続行
            //     } else {
            //         //返ってきたCMコントロール情報をセット
            //         getCmControl = JSON.parse(rtn);
            //         console.log(getCmControl);
            //     }
            // })
            
            // // Ajaxリクエストが失敗した時発動
            // .fail( (rtn) => {
                
            //     $('.error_ul').html('システムエラーが発生しました。');
            //     return false;
            // })

            // // Ajaxリクエストが成功・失敗どちらでも発動
            // .always( (data) => {
            // });


            // /******************
            // *CEUクイズ情報を取得
            // *******************/
            // $.ajax({
            //     url:  '../../classes/getQuiz.php',
            //     type: 'POST',
            //         data:{
            //             //ceu_idをセット
            //             ceu_id : $("#ceu_id1").val(),
            //         }
            // })
        
            // // Ajaxリクエストが成功した時発動
            // .done( (rtn) => {
            
            //     // rtn = 0 の場合は、該当なし
            //     if (rtn == 0) {
                    
            //         $('.error_ul').html('システムエラーが発生しました。');
            //         return false;
                
            //     // rtn = 0 以外の場合は、処理続行
            //     } else {
            //         //返ってきたCMコントロール情報をセット
            //         getQuiz = JSON.parse(rtn);
            //         console.log(getQuiz);
            //     }
            // })
            
            // // Ajaxリクエストが失敗した時発動
            // .fail( (rtn) => {
                
            //     $('.error_ul').html('システムエラーが発生しました。');
            //     return false;
            // })

            // // Ajaxリクエストが成功・失敗どちらでも発動
            // .always( (data) => {
            // });

        //     /***********************
        //     *CEUCEUクイズ正答率を取得
        //     ************************/
        // $.ajax({
        //     url:  '../../classes/getQuizAnswer.php',
        //     type: 'POST',
        //         data:{
        //             //ceu_idをセット
        //             ceu_id : $("#ceu_id1").val(),
        //         }
        //     })
        
        //     // Ajaxリクエストが成功した時発動
        //     .done( (rtn) => {
            
        //         // rtn = 0 の場合は、該当なし
        //         if (rtn == 0) {
                    
        //             $('.error_ul').html('システムエラーが発生しました。');
        //             return false;
                
        //         // rtn = 0 以外の場合は、処理続行
        //         } else {
        //             //返ってきたCMコントロール情報をセット
        //             getQuizAnswer = JSON.parse(rtn);
        //             console.log(getQuizAnswer);
        //         }
        //     })
            
        //     // Ajaxリクエストが失敗した時発動
        //     .fail( (rtn) => {
                
        //         $('.error_ul').html('システムエラーが発生しました。');
        //         return false;
        //     })

        //     // Ajaxリクエストが成功・失敗どちらでも発動
        //     .always( (data) => {
        //     });
        });
    });
})(jQuery);