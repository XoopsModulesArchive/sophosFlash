<?php
#################################################
#   Xoops Module -- sophosFlash v1.0            #
#   Copyright 2004 By Gregory Gray              #
#   greg@getnetez.com                           #
#   Released under the GPL as included.         #
#   If the GPL was not included and you want    #
#   a copy you can download it seperately at    #
#   www.getnetez.com/licenses/gpl.html          #
#   The short version : This is free, do what   #
#   you want with it, but don't blame me if     #
#   something bad/weird happens that you don't  #
#   like. You are welcome to email me and I     #
#   will help you as much as I can if I have    #
#   the time. Also, don't claim that I didn't   #
#   write this and someone else (you) did.      #
#                                               #
#   This modules accesses the Sophos virus      #
#   alerts xml service to aquire news on a      #
#   daily basis, please consider going to       #
#   sophos.com and registering for the service  #
#   as a thank you to them.                     #
#################################################


$modversion['name'] = _MI_SOPHOSFLASH_NAME;
$modversion['version'] = 1.00;
$modversion['description'] = _MI_SOPHOSFLASH_DESC;
$modversion['author'] = 'Usulix<br />( http://www.getnetez.com/ )<br />usulix@yahoo.com';
$modversion['credits'] = 'Thanks to Sophos.com for the XML formatted virus newsflash';
$modversion['help'] = 'help.html';
$modversion['license'] = 'GPL see LICENSE';
$modversion['official'] = 0;
$modversion['image'] = 'images/sophosFlash_slogo.png';
$modversion['dirname'] = 'sophosFlash';

// Sql
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = "sophosFlash";

// Admin
$modversion['hasAdmin'] = 0;
$modversion['adminmenu'] = '';

// Menu
$modversion['hasMain'] = 1;

// Templates
$modversion['templates'][1]['file'] = 'sophosFlash.html';
$modversion['templates'][1]['description'] = 'View all virus alerts';

// Blocks
$modversion['blocks'][1]['file'] = "sophosflashblock.php";
$modversion['blocks'][1]['name'] = _MI_SOPHOSFLASH_BNAME1;
$modversion['blocks'][1]['description'] = _MI_SOPHOSFLASH_DESCRIP;
$modversion['blocks'][1]['show_func'] = "b_virus_flash_show";
$modversion['blocks'][1]['template'] = 'sophosflashblock.html';
?>
