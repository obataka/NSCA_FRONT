(function($){
    $(document).ready(function(){


        //取得した設問数分だけ<div>を作成する
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
                        id: 'sel_q' + [i] + '_1',
                        name: 'sel_q' + [i] + '_1',
                        value: '<?php echo $sel_q' + [i] + '_1; ?>'
                    });
                    $('form').prepend(input1);

                    //選択したラジオボタンのテキストをセットする為、動的にhiddenのinputタグを作成
                    var input2 = $('<input>').attr({
                        type: 'hidden',
                        id: 'val_q' + [i] + '_1',
                        name: 'val_q' + [i] + '_1',
                        value: '<?php echo $val_q' + [i] + '_1; ?>'
                    });
                    $('form').prepend(input2);

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

        // //var arr = [$("#sel_q1_1").val()];

         console.log($('#sel_q1_1').val()); 

        // var r = $('#sel_q1_1').val();
        // console.log(r[0]);
        

        // var t = $("#sel_q1_1:nth-child(0)").val();


        // //var r = $('#sel_q1_1').val([1]);
        

        // console.log(t);
        

        // // 配列membersを順に処理
        // $.each($("#sel_q1_1").val(),function(index, elem) {
        //     // 年齢が40以上のメンバーが見つかったところで出力停止
        //     if (elem >= 5) { return false; }
        //         // メンバー情報を「名前（年齢）」の形式でリストに整形
        //         $('.kai_1')
        //         .append(elem[1])
        //         .appendTo('#result');
        // });







    
    });
})(jQuery);