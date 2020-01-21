(function ($) {
    $(document).ready(function () {

        //会員情報取得処理
        jQuery.ajax({
            url: '../../classes/getTbkaiinJoho.php',
        }).done((rtn) => {
            getTbkaiinJoho = JSON.parse(rtn);

            //取得した会員情報データを表示する
            $("#kaiin_no").text(getTbkaiinJoho["kaiin_no"]);
            $("#shimei").text(getTbkaiinJoho["shimei_sei"] + " " + getTbkaiinJoho["shimei_mei"]);
            $("#furigana").text(getTbkaiinJoho["furigana_sei"] + " " + getTbkaiinJoho["furigana_mei"]);
            $("#firstlast").text(getTbkaiinJoho["last"] + " " + getTbkaiinJoho["first"]);
            $("#tel").text(getTbkaiinJoho["tel"]);
            $("#address").text(getTbkaiinJoho["yubin_no"] + getTbkaiinJoho["kemmei"] + getTbkaiinJoho["jusho_1"] + getTbkaiinJoho["jusho_2"]);
            $("#pc_address").text(getTbkaiinJoho["email_1"]);

            if (getTbkaiinJoho["cpraed_hoji_kbn"] != "") {
                $("input[name='shikaku']").prop("checked", true);
            }
            var shikaku_yuko_val = getTbkaiinJoho["cpraed_ninteibi"].split("/");
            var yuko_kigen_val = getTbkaiinJoho["cpraed_yuko_kigembi"].split("/");
            $("#shikaku_yuko").val(shikaku_yuko_val[0]);
            $("#shikaku_yuko_month").val(shikaku_yuko_val[1]);
            $("#shikaku_yuko_day").val(shikaku_yuko_val[2]);
            $("#yuko_kigen").val(yuko_kigen_val[0]);
            $("#yuko_kigen_month").val(yuko_kigen_val[1]);
            $("#yuko_kigen_day").val(yuko_kigen_val[2]);
        }).fail ((rtn) =>{
            return false;
        });

        /*********************************
         * //職業取得
         *********************************/
        jQuery.ajax({
            url: '../../classes/getMeishoList.php',
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {
                    //※正常に職業情報を取得できた時の処理を書く場所
                    getMeishoList = JSON.parse(rtn);
                    $.each(getMeishoList, function (i, value) {
                        $('#job').append('<div><input id="job_' + value[0] + '" type="checkbox" name="job" value="' + value[0] + '"><label class="checkbox" for="job_' + value[0] + '">' + value[1] + '</label></div>');
                    });
                }
            }
        }).fail((rtn) => {
            return false;
        });

        $("#changeMember").click(function () {
            location.href = "../changeMember/";
        });

        $("#return_button").click(function () {
            url = '../selectCSCSCPT/';
            $('form').attr('action', url);
            $('form').submit();
        });

    });
})(jQuery);