(function($){
    $(document).ready(function(){
    
        /*************
        * 初期画面表示
        **************/
       
       $('.content').hide();

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

            } else {
                console.log(1111);

                //※正常にCEUクイズ情報を取得できた時の処理
                getCeuQuizSetsumon = JSON.parse(rtn);
                console.log(getCeuQuizSetsumon);
                $(".h2_text").text(getCeuQuizSetsumon[0]["shutoku_naiyo"]);
                
                // 配列getCeuQuizSetsumonを順に処理
                var i = 1;
                $.each(getCeuQuizSetsumon,function(index, elem) {
                    
                    // 設問が見つからなかったところで出力停止
                    if (elem.setsumon == "") { return false; }
                    console.log(elem.setsumon);
                    
                    var test = '<div class="content">' 
                                + '<p class="dai dai_' + [i] + '"></p>'
                                + '<p class="no no_' + [i] + '"></p>'
                                + '<ul>' 
                                + '<li><input id="q' + [i] + '_1" type="radio" name="' + [i] + '_1" value=""><label class="radio' + [i] + '_1" for="q' + [i] + '_1"></label><br></li>'
                                + '<li><input id="q' + [i] + '_2" type="radio" name="' + [i] + '_1" value=""><label class="radio' + [i] + '_2" for="q' + [i] + '_2"></label><br></li>'
                                + '<li><input id="q' + [i] + '_3" type="radio" name="' + [i] + '_1" value=""><label class="radio' + [i] + '_3" for="q' + [i] + '_3"></label><br></li>'
                                + '<li><input id="q' + [i] + '_4" type="radio" name="' + [i] + '_1" value="1"><label class="radio' + [i] + '_4" for="q' + [i] + '_4"></label><br></li>'
                                + '</ul>'
                                + '<ul class="error_ul' + [i] + '">'
                                + '<li class="error" id="err_question"></li>'
                                + '</ul>'
                                + '</div>'
                        $(".p_content").append(test);

                    // 設問をセット
                    $(".dai_" + [i] + "").append(elem.setsumon)
                    .appendTo('#result');

                    // 番号をセット
                    if (elem.sentakushi_a !== "") {
                        $(".no_" + [i] + "").append("No." + elem.setsumon_no);
                    }

                    //選択肢Aセット
                    if (elem.sentakushi_a !== "") {
                        $("label.radio" + [i] + "_1").text(elem.sentakushi_a);
                    }  else {
                        $("label.radio" + [i] + "_1").hide();
                    }

                    //選択肢Bセット
                    if (elem.sentakushi_b !== "") {
                        $("label.radio" + [i] + "_2").text(elem.sentakushi_b);
                    }  else {
                        $("label.radio" + [i] + "_2").hide();
                    }
                    
                    //選択肢Cセット
                    if (elem.sentakushi_c !== "") {
                        $("label.radio" + [i] + "_3").text(elem.sentakushi_c);
                    }  else {
                        $("label.radio" + [i] + "_3").hide();
                    }

                    //選択肢Dセット
                    if (elem.sentakushi_d !== "") {
                        $("label.radio" + [i] + "_4").text(elem.sentakushi_d);
                    } else {
                        $("label.radio" + [i] + "_4").hide();
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
        
        /*************************
        *CEUクイズ一覧へボタン押下時
        **************************/
        $(".back").click(function() {
            location.href = "../../ceuQuizlist/";
        });

        /***************
        *次へボタン押下時
        ****************/
        $("#next_button").click(function() {
            for (var i=1; i<50; i++) {
                var wk_err_msg = "";
                //if文で3の時の条件分岐を指定
                if ($("label.radio" + [i] + "_1").text() == "") {
                  //が出たらbreakで中止
                  break;
                }

                if (!$("input:radio[name='" + [i] + "_4']:checked").val()) {
                    //チェックされていない場合
                    wk_err_msg == "";
                    wk_err_msg = "エラーテスト表示";
                    $(".error_ul" + [i] + "").html(wk_err_msg);  
                }

             
              }
        });

    });
})(jQuery);