<?php
    function lang ($phrase){
        
        static $lang = array(
           'CATEGORIES'    =>'categories',
           'ITEMS'         =>'items',
           'MEMBERS'       =>'members',
           'COMMENTS'      => 'Comments',
           'STATISTICS'    =>'statistics',
           'LOGS'          =>'logs'
            
        );
        return $lang[$phrase];
    }
?>