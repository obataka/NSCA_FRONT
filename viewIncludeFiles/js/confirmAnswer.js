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

    });
})(jQuery);