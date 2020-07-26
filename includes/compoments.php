<?php
function messageAlter($text){
    $html = "<div class='mb-2' style='color: red;'><span>*</span>$text</div>";
    echo $html;
}