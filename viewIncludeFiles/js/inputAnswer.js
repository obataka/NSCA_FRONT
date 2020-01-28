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

                //※正常にCEUクイズ情報を取得できた時の処理
                getCeuQuizSetsumon = JSON.parse(rtn);
                console.log(getCeuQuizSetsumon);
                $(".h2_text").text(getCeuQuizSetsumon[0]["shutoku_naiyo"]);
                
                // 配列getCeuQuizSetsumonを順に処理
                var i = 1;
                $.each(getCeuQuizSetsumon,function(index, elem) {
                    
                    // 設問が見つからなかったところで出力停止
                    if (elem.setsumon == "") {
                        return false;
                    }

                    //選択したラジオボタンの値をセットする為、動的にhiddenのinputタグを作成
                    var input1 = $('<input>').attr({
                        type: 'hidden',
                        class: 'q1_' + [i] + '',
                        id: 'sel_q' + [i] + '_1',
                        name: 'sel_q[' + [i] + ']',
                        value: ''
                    });
                    $('form').prepend(input1);

                    //動的に<div>を作成
                    var div = '<div class="content">' 
                             + '<p class="dai dai_' + [i] + '"></p>'
                             + '<p class="no no_' + [i] + '"></p>'
                             + '<ul>' 
                             + '<li><input id="q' + [i] + '_1" class="q1_' + [i] + '" type="radio" name="q_[' + [i] + ']" value="1"><label class="radio' + [i] + '_1" for="q' + [i] + '_1"></label><br></li>'
                             + '<li><input id="q' + [i] + '_2" class="q1_' + [i] + '" type="radio" name="q_[' + [i] + ']" value="2"><label class="radio' + [i] + '_2" for="q' + [i] + '_2"></label><br></li>'
                             + '<li><input id="q' + [i] + '_3" class="q1_' + [i] + '" type="radio" name="q_[' + [i] + ']" value="3"><label class="radio' + [i] + '_3" for="q' + [i] + '_3"></label><br></li>'
                             + '<li><input id="q' + [i] + '_4" class="q1_' + [i] + '" type="radio" name="q_[' + [i] + ']" value="4"><label class="radio' + [i] + '_4" for="q' + [i] + '_4"></label><br></li>'
                             + '</ul>'
                             + '<ul class="error_ul' + [i] + '">'
                             + '<li class="error" id="err_question"></li>'
                             + '</ul>'
                             + '</div>'

                    //<div>を作成
                    $(".p_content").append(div);

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

                    /**********************************
                    * 選択済みのラジオボタンの初期表示処理
                    ***********************************/
                    var sel_radio = $('#q_' + [i] + '').val();
                    if (sel_radio != "") {
                        $('input:radio[name="q_[' + [i] + ']"]').val([sel_radio]);
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



        //ラジオボタンが押されたらチェックされた値とテキストをhidden項目にセットする
        $(".p_content").on('change', "input[type='radio']", function () {
            var sel_id = "";
            var sel_class = "";
            var sel_label_txt = "";

            sel_class = $(this).attr('class');
            sel_id = $(this).attr('id');

            sel_label_txt =  $('label[for="' + sel_id + '"]').text();


            $("input[type='hidden'][class='" + sel_class + "']").val(sel_label_txt);
            
        });




        /*************************
        *CEUクイズ一覧へボタン押下時
        **************************/
        $(".back").click(function() {
            
            //クイズ回答確認画面に遷移する
            location.href = "../../ceuQuizlist/";
        });


    
        /***************
        *次へボタン押下時
        ****************/
        $("#next_button").click(function() {
            for (var i=1; i<10; i++) {

                //初期化
                var wk_err_msg = "";
                $(".error_ul" + [i] + "").html("");

                //if文でtextが空白の時の条件分岐を指定
                if ($("label.radio" + [i] + "_1").text() == "") {

                  //labelのtextが空白ならbreakで中止
                  break;
                }
                
                //ラジオボタンが空白の場合
                if (!$("input:radio[name='q_[" + [i] + "]']:checked").val()) {

                    //ラジオボタンがチェックされていない場合
                    wk_err_msg == "";
                    wk_err_msg = "入力に誤りがあります。<br>" + [i] + "問目の解答を選択してください。";
                    $(".error_ul" + [i] + "").html(wk_err_msg);  
                    return false;

                //ラジオボタンがチェックされていたら、チェックされている値をhidden項目にセット
                 } else {

                    var sel_q1_1 = "";
        
                    sel_q1_1 = $('[name="q_[' + [i] + ']"]:checked').attr('id');
                    sel_q1_1 = $('label[for="' + sel_q1_1 + '"]').text();
                    $('#sel_q' + [i] + '_1').val(sel_q1_1);

                    
                }          
            }

            //エラーがなく、hidden項目に値をセットしたらCEUクイズ回答確認画面に画面遷移
            url = '../confirmAnswer/';
            $('form').attr('action', url);
            $('form').submit();

        });
    });
})(jQuery);