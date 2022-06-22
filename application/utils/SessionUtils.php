<?php
if(!isset($_SESSION)) {
    session_start();
}

function flash($name = '', $val = '') {
    if(!empty($name)) {
        if(!empty($val)) {
            $_SESSION[$name] = $val;
        } else if(empty($val) && !empty($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }
}