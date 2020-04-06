<?php

namespace Was;

$dir = glob('../../printReceipt/Receipt/*');
foreach ($dir as $file){
    //ファイルを削除する
    unlink($file);
}

die();
