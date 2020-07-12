<?php

function b_virus_flash_show(){
     include_once XOOPS_ROOT_PATH.'/modules/sophosFlash/class/sfup.php';
     error_reporting (E_ALL);

     // use the Xoops database class to get the current connection to the db

     $db =&Database::getInstance();

     // query the sophosFlash table and check if last retrieval > 8 hours ago
     $sql="SELECT * from ".$db->prefix("sophosflash");
     $result = $db->query($sql);
     if($db->getRowsNum($result)!=0){
         $sql="Select unix_timestamp(max(retrieved)) as ls, unix_timestamp() as nw
         From ".$db->prefix("sophosflash")." group by retrieved";
         $result = $db->query($sql);
         $res = $db->fetcharray($result);
         $ret =$res['nw']-$res['ls'];
     }else{
         $ret=99999;
     }
     
     if($ret>=28800){
          $getit = new sfclass();
          $getit->update();
     }

     // This is the block page list top ten
     $db =&Database::getInstance();
     $sql="Select * from ".$db->prefix("sophosflash")." order by repdatestamp desc LIMIT 10";
     $result = $db->query($sql);
     $block=array();
     while($row=$db->fetcharray($result)){
          $alert['link']=$row['link'];
          $alert['name']=$row['name'];
          $alert['repdate']=$row['repdate'];
          $block['alert'][]=$alert;
     }
     return $block;
}
?>
