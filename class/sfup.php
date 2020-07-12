<?php
#################################################
# sophosFlash_updater                           #
# checks for last retrieval date time           #
# and if that was more than 8 hours ago         #
# cURLs a new XML document from Sophos          #
# and parses it into the database               #
#                                               #
#                                               #
#                                               #
#################################################


class sfclass
{
  function update(){
    //cURL the latest XML
    //$url="http://localhost/tenalerts.xml";
    $url="http://www.sophos.com/virusinfo/infofeed/tenalerts.xml";
    $ch=curl_init();
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt ($ch, CURLOPT_TRANFERTEXT, 1);
    $Xres = curl_exec ($ch);
    if(strlen($Xres)>0){
        $file = XOOPS_ROOT_PATH.'/class/database/'.XOOPS_DB_TYPE.'database.php';
		require_once $file;
	$class = 'Xoops'.ucfirst(XOOPS_DB_TYPE).'DatabaseSafe';
	$SUdb =& new $class();
	$SUdb->setLogger(XoopsLogger::instance());
	$SUdb->setPrefix(XOOPS_DB_PREFIX);
	if (!$SUdb->connect()) {
	     trigger_error("Unable to connect to database", E_USER_ERROR);
	}
        $p = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($p,$Xres,$vals,$tags);
        xml_parser_free($p);
        $newalert=array();
        $newlink=array();
        foreach($vals as $row){
            if($row['tag']=='TITLE'){
                array_push($newalert,$row['value']);
            }
            if($row['tag']=='LINK'){
                array_push($newlink,$row['value']);
            }
        }
        for($x=1;$x<=10;$x++){
            $nm=explode("/",$newalert[$x]);
            $tem=explode(" ",$nm[0]);
            $repdate=$tem[0]." ".$tem[1]." ".date("y");
            $repdatestamp=strtotime($repdate);
            $typ=$tem[2];
            $sql="INSERT INTO ".$SUdb->prefix("sophosflash")."
                    values(\"".$newalert[$x]."\",\"".$typ."\",\"".
                    $repdate."\",\"".$repdatestamp."\",\"".$nm[1]."\",\"".$newlink[$x]."\",now())";
            $result = $SUdb->query($sql);
        }
    }
  }
}
?>

