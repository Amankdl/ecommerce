<?php

function get_safe_senatize_value($str){
    if($str != null){
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
}
?>