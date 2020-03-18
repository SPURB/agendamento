<?php

interface Restrict{
    
    function getRestrictProps();
    function checkRestrictKey($key, $obj);
    
}



?>