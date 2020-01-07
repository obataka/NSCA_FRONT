(function ($) {
    $(document).ready(function () {
        //会員情報取得
        jQuery.ajax({
            url: '../../classes/getTbkaiinJoho.php',
            success: function (rtn) {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {
                    //※正常に情報を取得できた時、変数に入れる
                    getTbkaiinJoho = JSON.parse(rtn);
                    console.log(getTbkaiinJoho);
                    $kaiin_no = getTbkaiinJoho[0];
                    $shimei = getTbkaiinJoho[7] + getTbkaiinJoho[8];
                    $furigana = getTbkaiinJoho[10] + getTbkaiinJoho[11];
                    $first = getTbkaiinJoho[43];
                    $last = getTbkaiinJoho[44];
                    $seinengappi = getTbkaiinJoho[13];
                    $seibetsu_kbn = getTbkaiinJoho[14];
                    $yubin_no = getTbkaiinJoho[15];
                    $ken_no = getTbkaiinJoho[16];
                    $chiiki_id = getTbkaiinJoho[17];
                    $kemmei = getTbkaiinJoho[18];
                    $jusho_1 = getTbkaiinJoho[19];
                    $jusho_2 = getTbkaiinJoho[20];
                    $kana_jusho_1 = getTbkaiinJoho[21];
                    $kana_jusho_2 = getTbkaiinJoho[22];
                    $tel = getTbkaiinJoho[23];
                    $fax = getTbkaiinJoho[24];
                    $keitai_denwa = getTbkaiinJoho[25];
                    $keitai_denwa_shurui = getTbkaiinJoho[26];
                    $email = getTbkaiinJoho[27];
                    $keitai_email = getTbkaiinJoho[28];
                    $url = getTbkaiinJoho[29];
                    $shokugyo_kbn_1 = getTbkaiinJoho[31];
                    $shokugyo_kbn_2 = getTbkaiinJoho[32];
                    $shokugyo_kbn_3 = getTbkaiinJoho[33];
                    $kimmusakimei = getTbkaiinJoho[34];
                    $kimmusaki_yubin_no = getTbkaiinJoho[36];
                    $kimmusaki_ken_no = getTbkaiinJoho[37];
                    $kimmusaki_kemmei = getTbkaiinJoho[38];
                    $kimmusaki_jusho_1 = getTbkaiinJoho[39];
                    $kimmusaki_jusho_2 = getTbkaiinJoho[40];
                    $kimmusaki_tel = getTbkaiinJoho[41];
                    $kimmusaki_fax = getTbkaiinJoho[42];
                    $gakuseisho_filemei_1 = getTbkaiinJoho[53];
                    $gakuseisho_filemei_2 = getTbkaiinJoho[54];
                    $yoyaku_kaiin_sbt = getTbkaiinJoho[98];
                    $merumaga_haishin_pc_email = getTbkaiinJoho[88];
                    $merumaga_haishin_keitai_email = getTbkaiinJoho[89];
                    $renraku_hoho_yuso = getTbkaiinJoho[86];
                    $renraku_hoho_denshi_email = getTbkaiinJoho[87];
                    $merumaga_haishin_smartphone = getTbkaiinJoho[118];
                    $yubin_haitatsusaki_kbn = getTbkaiinJoho[119];
                    $website_keisai_kbn = getTbkaiinJoho[122];
                    $daisansha_questionnaire_kbn = getTbkaiinJoho[120];
                }
            },
            fail: function (rtn) {
                return false;
            },
            error: function (rtn) {
                return false;
            }
        });

        //会員選択データ取得
        jQuery.ajax({
            url: '../../classes/getTbkaiinSentaku.php',
            success: function (rtn) {
                getTbkaiinSentaku = JSON.parse(rtn);
                console.log(getTbkaiinSentaku);
                $meisho_cd_shikaku = "";
                $shikaku_sonota = "";
                $meisho_cd_chiiki = "";
                $meisho_cd_bunya = "";
                $bunya_sonota = "";
                //※正常に情報を取得できた時、変数に入れる
                if (getTbkaiinSentaku != "") {
                    $.each(getTbkaiinSentaku, function (index, value) {
                        if (value[0] == 22) {
                            //NSCA以外の認定資格
                            $meisho_cd_shikaku = $meisho_cd_shikaku + value[1] + ", ";
                            if (value[1] == 99) {
                                $shikaku_sonota = value[2];
                            }

                        } else if (value[0] == 32) {
                            //興味のある地域
                            $meisho_cd_chiiki = $meisho_cd_chiiki + value[1] + ", ";

                        } else if (value[0] == 24) {
                            //興味のある分野   
                            $meisho_cd_bunya = $meisho_cd_bunya + value[1] + ", ";
                            if (value[1] == 99) {
                                $bunya_sonota = value[2];
                            }
                        } 
                    });
                }
            },
            fail: function (rtn) {
                return false;
            },
            error: function (rtn) {
                return false;
            }
        });

        /*************************************************
        * 内容を修正するボタン押下時に値を保持して画面遷移する
        **************************************************/
        $("#return_button").click(function () {
            url = '../changeMember/';
            $('form').attr('action', url);
            $('form').submit();
        });

        /******************************************
        * 次へボタン押下時にDBの値を更新して登録修正完了画面に遷移する。
        * 英文オプションが有りの場合、支払方法選択画面に遷移する。
        *******************************************/
        $("#next_button").click(function () {
            console.log(123);
            //旧区分更新処理
            jQuery.ajax({
                url: '../../classes/updateTb_kaiin_my_page_koshin_rireki2.php',
                type: 'POST',
                data:
                {
                    kaiin_no: $kaiin_no,
                    shimei: $shimei,
                    furigana: $furigana,
                    first: $first,
                    last: $last,
                    seinengappi: $seinengappi,
                    seibetsu_kbn: $seibetsu_kbn,
                    yubin_no: $yubin_no,
                    ken_no: $ken_no,
                    chiiki_id: $chiiki_id,
                    kemmei: $kemmei,
                    jusho_1: $jusho_1,
                    jusho_2: $jusho_2,
                    kana_jusho_1: $kana_jusho_1,
                    kana_jusho_2: $kana_jusho_2,
                    tel: $tel,
                    fax: $fax,
                    keitai_denwa: $keitai_denwa,
                    keitai_denwa_shurui: $keitai_denwa_shurui,
                    email: $email,
                    keitai_email: $keitai_email,
                    merumaga_haishin_pc_email: $merumaga_haishin_pc_email,
                    merumaga_haishin_keitai_email: $merumaga_haishin_keitai_email,
                    renraku_hoho_yuso: $renraku_hoho_yuso,
                    renraku_hoho_denshi_email: $renraku_hoho_denshi_email,
                    shokugyo_kbn_1: $shokugyo_kbn_1,
                    shokugyo_kbn_2: $shokugyo_kbn_2,
                    shokugyo_kbn_3: $shokugyo_kbn_3,
                    kimmusakimei: $kimmusakimei,
                    kimmusaki_yubin_no: $kimmusaki_yubin_no,
                    kimmusaki_ken_no: $kimmusaki_ken_no,
                    kimmusaki_kemmei: $kimmusaki_kemmei,
                    kimmusaki_jusho_1: $kimmusaki_jusho_1,
                    kimmusaki_jusho_2: $kimmusaki_jusho_2,
                    kimmusaki_tel: $kimmusaki_tel,
                    kimmusaki_fax: $kimmusaki_fax,
                    gakuseisho_filemei_1: $gakuseisho_filemei_1,
                    gakuseisho_filemei_2: $gakuseisho_filemei_2,
                    yoyaku_kaiin_sbt: $yoyaku_kaiin_sbt,
                    merumaga_haishin_smartphone: $merumaga_haishin_smartphone,
                    yubin_haitatsusaki_kbn: $yubin_haitatsusaki_kbn,
                    website_keisai_kbn: $website_keisai_kbn,
                    daisansha_questionnaire_kbn: $daisansha_questionnaire_kbn,
                    meisho_cd_shikaku: $meisho_cd_shikaku,
                    shikaku_sonota: $shikaku_sonota,
                    meisho_cd_chiiki: $meisho_cd_chiiki,
                    meisho_cd_bunya: $meisho_cd_bunya,
                    bunya_sonota: $bunya_sonota,
                },
                success: function (rtn) {
                    // rtn = 0 の場合は、該当なし

                    if (rtn == 0) {
                        console.log(010101);
                        return false;
                    } else {

                    }
                },
                fail: function (rtn) {
                    console.log(1313131313);

                    return false;
                },
                error: function (rtn) {
                    console.log(090909090909);

                    return false;
                }
            });

            jQuery.ajax({
                url: '../../classes/changeMemberPost.php',
                type: 'POST',
                data:
                {
                    //会員情報のテーブル項目
                    shimei_sei: $("#name_sei").val(),
                    shimei_mei: $("#name_mei").val(),
                    furigana_sei: $("#name_sei_kana").val(),
                    furigana_mei: $("#name_mei_kana").val(),
                    seinengappi: $("#year").val() + $("#month").val() + $("#day").val(),
                    seibetsu_kbn: $("#wk_sel_gender").val(),
                    yubin_no: $("#yubin_nb_1").val() + $("#yubin_nb_2").val(),
                    ken_no: $("#sel_math").val(),
                    kemmei: $("#kenmei").val(),
                    jusho_1: $("#address_shiku").val(),
                    jusho_2: $("#address_tatemono").val(),
                    kana_jusho_1: $("#address_yomi_shiku").val(),
                    kana_jusho_2: $("#address_yomi_tatemono").val(),
                    tel: $("#tel").val(),
                    fax: $("#fax").val(),
                    keitai_no: $("#keitai_tel").val(),
                    keitai_denwa_shurui: $keitai_denwa_shurui,
                    email_1: $("#mail_address_1").val(),
                    email_2: $("#mail_address_2").val(),
                    url_1: $("#url").val(),
                    shokugyo_kbn_1: $("#sel_shoku_1").val(),
                    shokugyo_kbn_2: $("#sel_shoku_2").val(),
                    shokugyo_kbn_3: $("#sel_shoku_3").val(),
                    kimmusakimei: $("#office_name").val(),
                    kimmusaki_yubin_no: $("#office_yubin_nb_1").val() + $("#office_yubin_nb_2").val(),
                    kimmusaki_ken_no: $("#sel_office_math").val(),
                    kimmusaki_kemmei: $("#office_kenmei").val(),
                    kimmusaki_jusho_1: $("#office_shiku").val(),
                    kimmusaki_jusho_2: $("#office_tatemono").val(),
                    kimmusaki_tel: $("#office_tel").val(),
                    kimmusaki_fax: $("#office_fax").val(),
                    gakuseisho_filemei_1: $gakuseisho_filemei_1,
                    gakuseisho_filemei_2: $gakuseisho_filemei_2,
                    yoyaku_kaiin_sbt: $yoyaku_kaiin_sbt,
                    $merumaga_haishin_smartphone: $merumaga_haishin_smartphone,
                    nagareyama_shimin: $("#sel_nagareyama").val(),
                    first: $("#name_first").val(),
                    last: $("#name_last").val(),
                    chiiki_id: $("#sel_chiiki").val(),
                    sel_office_chiiki: $("#sel_office_chiiki").val(),

                    //会員その他テーブルの項目
                    mail: $("#wk_sel_mail").val(),
                    merumaga: $("#wk_sel_merumaga").val(),
                    hoho: $("#wk_sel_hoho").val(),
                    yubin: $("#wk_sel_yubin").val(),
                    web: $("#wk_sel_web").val(),
                    qa: $("#wk_sel_qa").val(),

                    //会員ジャーナルテーブルの項目
                    eibun_option_kbn: $("#wk_sel_option").val(),

                    //会員選択テーブルの項目
                    meisho_cd_shikaku: $("#wk_sel_shikaku").val(),
                    meisho_cd_chiiki: $("#wk_sel_k_chiiki").val(),
                    meisho_cd_bunya: $("#wk_sel_bunya").val(),
                    biko_bunya: $("#sel_bunya_sonota").val(),
                    biko_shikaku: $("#sel_shikaku_sonota").val(),
                },

                success: function (rtn) {
                    console.log(1);
                    // rtn = 0 の場合は、該当なし
                    if (rtn == 0) {
                        return false;
                    } else {
                        // 登録成功の場合、登録情報修正完了画面に遷移する。 
                        if ($("#mail").val() == 1) {
                            console.log(12345678);
                            jQuery.ajax({
                                url: '../../classes/registCompleteMail.php',
                                type: 'POST',
                                data:
                                {
                                    //メールアドレス
                                    email_1: $("#mail_address_1").val(),
                                },
                                success: function (rtn) {
                                    //英文オプションが有りの場合、支払方法選択画面に遷移する。
                                    if ($("#wk_sel_option").val() == "") {
                                        location.href = '../changeComplete/';
                                    } else {
                                        location.href = '../paymentSelect/';
                                    }


                                },
                                fail: function (rtn) {
                                    return false;
                                },
                                error: function (rtn) {
                                    return false;
                                }
                            });
                        } else if ($("#mail").val() == 2) {
                            console.log(1234567890000);
                            jQuery.ajax({
                                url: '../../classes/registCompleteMail.php',
                                type: 'POST',
                                data:
                                {
                                    //メールアドレス
                                    email_2: $("#mail_address_2").val(),
                                },
                                success: function (rtn) {
                                    //英文オプションが有りの場合、支払方法選択画面に遷移する。
                                    if ($("#wk_sel_option").val() == "") {
                                        location.href = '../changeComplete/';
                                    } else {
                                        location.href = '../paymentSelect/';
                                    }
                                },
                                fail: function (rtn) {
                                    return false;
                                },
                                error: function (rtn) {
                                    return false;
                                }
                            });
                        }
                    }
                },
                fail: function (rtn) {
                    console.log(0);
                    return false;
                },
                error: function (rtn) {
                    console.log(000);
                    return false;
                }
            });

            //修正後の会員情報を登録
            jQuery.ajax({
                url: '../../classes/updateTb_kaiin_my_page_koshin_rirekiNew2.php',
                type: 'POST',
                data:
                {
                    kaiin_no: $kaiin_no,
                    shimei: $("#name_sei").val() + $("#name_mei").val(),
                    furigana: $("#name_sei_kana").val() + $("#name_mei_kana").val(),
                    seinengappi: $("#year").val() + $("#month").val() + $("#day").val(),
                    seibetsu_kbn: $("#wk_sel_gender").val(),
                    yubin_no: $("#yubin_nb_1").val() + $("#yubin_nb_2").val(),
                    ken_no: $("#sel_math").val(),
                    chiiki_id: $("#sel_chiiki").val(),
                    kemmei: $("#kenmei").val(),
                    jusho_1: $("#address_shiku").val(),
                    jusho_2: $("#address_tatemono").val(),
                    kana_jusho_1: $("#address_yomi_shiku").val(),
                    kana_jusho_2: $("#address_yomi_tatemono").val(),
                    tel: $("#tel").val(),
                    fax: $("#fax").val(),
                    keitai_denwa: $("#keitai_tel").val(),
                    email: $("#mail_address_1").val(),
                    keitai_email: $("#mail_address_2").val(),
                    merumaga: $("#merumaga").val(),
                    hoho: $("#hoho").val(),
                    mail: $("#mail").val(),
                    url_1: $("#url").val(),
                    shokugyo_kbn_1: $("#sel_shoku_1").val(),
                    shokugyo_kbn_2: $("#sel_shoku_2").val(),
                    shokugyo_kbn_3: $("#sel_shoku_3").val(),
                    kimmusakimei: $("#office_name").val(),
                    kimmusaki_yubin_no: $("#office_yubin_nb_1").val() + $("#office_yubin_nb_2").val(),
                    kimmusaki_ken_no: $("#sel_office_math").val(),
                    kimmusaki_kemmei: $("#office_kenmei").val(),
                    kimmusaki_jusho_1: $("#office_shiku").val(),
                    kimmusaki_jusho_2: $("#office_tatemono").val(),
                    kimmusaki_tel: $("#office_tel").val(),
                    kimmusaki_fax: $("#office_fax").val(),
                    nagareyama_shimin: $("#sel_nagareyama").val(),
                    first: $("#name_first").val(),
                    last: $("#name_last").val(),
                    chiiki_id: $("#sel_chiiki").val(),
                    sel_office_chiiki: $("#sel_office_chiiki").val(),

                    //会員その他テーブルの項目
                    mail: $("#wk_sel_mail").val(),
                    merumaga: $("#wk_sel_merumaga").val(),
                    hoho: $("#wk_sel_hoho").val(),
                    yubin: $("#wk_sel_yubin").val(),
                    web: $("#wk_sel_web").val(),
                    qa: $("#wk_sel_qa").val(),

                    //会員ジャーナルテーブルの項目
                    eibun_option_kbn: $("#wk_sel_option").val(),

                    //会員選択テーブルの項目
                    meisho_cd_shikaku: $("#wk_sel_shikaku").val(),
                    meisho_cd_chiiki: $("#wk_sel_k_chiiki").val(),
                    meisho_cd_bunya: $("#wk_sel_bunya").val(),
                    biko_bunya: $("#sel_bunya_sonota").val(),
                    biko_shikaku: $("#sel_shikaku_sonota").val(),
                },
                success: function (rtn) {
                    // rtn = 0 の場合は、該当なし
                    console.log(50);
                    if (rtn == 0) {
                        console.log(000);
                        return false;
                    } else {
                        console.log(1111111111111111111111111);
                        //エラーがない場合完了画面に画面遷移
                        if ($("#wk_sel_option").val() == "") {
                            location.href = '../changeComplete/';
                        } else {
                            location.href = '../paymentSelect/';
                        }
                    }
                },
                fail: function (rtn) {
                    console.log(1313131313);

                    return false;
                },
                error: function (rtn) {
                    console.log(090909090909);

                    return false;
                }

            });
        });

    });

})(jQuery);