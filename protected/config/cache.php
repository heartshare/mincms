<?php

$arr['cache']=array(
    'class'=>'system.caching.CFileCache',
     
);
/**
'class'=>'system.caching.CMemCache',
'servers'=>array(
    array('host'=>'server1', 'port'=>11211, 'weight'=>60),
    array('host'=>'server2', 'port'=>11211, 'weight'=>40),
),
*/
return $arr;