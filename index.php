<?php
define('_MI_SOPHOSFLASH_FULL_DISPLAY_MAX', 75);
include '../../mainfile.php';
$xoopsOption['template_main'] = 'sophosFlash.html';
include XOOPS_ROOT_PATH.'/header.php';
include_once XOOPS_ROOT_PATH.'/modules/sophosFlash/class/sfup.php';

// use the Xoops database class to get the current connection to the db

$db =&Database::getInstance();

// query the sophosFlash table and check if last retrieval > 8 hours ago
$sql="SELECT * from ".$db->prefix("sophosflash");
$result = $db->query($sql);
if($db->getRowsNum($result)!=0){
    $sql="Select unix_timestamp(max(retrieved)) as ls, unix_timestamp() as nw From ".
$db->prefix("sophosflash")." group by retrieved";
    $result = $db->query($sql);
    $res = $db->fetcharray($result);
    $ret=$res['nw']-$res['ls'];
}else{
    $ret=99999;
}

if($ret>=28800){
    $getit = new sfclass();
    $getit->update();
}

// This is the full page list so query all up to_MI_SOPHOSFLASH_FULL_DISPLAY_MAX and display
$db =&Database::getInstance();
$sql="Select * from ".$db->prefix("sophosflash")." order by name";
$result = $db->query($sql);
$table="<div style=\"text-align:center;\"><table style=\"background-color:#cccccc; border:1px; padding 1 1 1 1;width:70%;\">";
$table.="<tr>
<td><b>Name</b></td><td><b>Type</b></td><td><b>Report Date</b></td>
</tr>";
while($row=$db->fetcharray($result)){
    $table.="<tr style=\"background-color:#ffffcc\">
    <td><a href=\"".$row['link']."\" target=\"_blank\">".$row['name'].
    "</a></td><td>".$row['type']."</td><td>".$row['repdate']."</td></tr>";
}
$table.="</table></div>";
$xoopsTpl->assign('virusList', $table);

// Include the page footer
require(XOOPS_ROOT_PATH.'/footer.php');
?>
