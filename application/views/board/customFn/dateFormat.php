<?php
function dateFormat($date) {
    if(empty($date)) {
        return false;
    }

    date_default_timezone_set("Asia/Seoul");
    $target = date("Y.m.d", strtotime($date));    
    $today = date("Y.m.d");    

    if($target == $today) {
        $rs = date("H:i", strtotime($date));
    } else {
        $rs = $target;
    }

    return $rs;
}