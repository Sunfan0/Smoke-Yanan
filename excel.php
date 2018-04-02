<?php
	include "paras.php";

	function export_csv($filename,$data) { 
		//header("Content-type:text/csv; charset=gb2312"); 
		header("Content-type:text/csv"); 
		header("Content-Disposition:attachment;filename=".$filename); 
		header('Cache-Control:must-revalidate,post-check=0,pre-check=0'); 
		header('Expires:0'); 
		header('Pragma:public'); 
		echo $data; 
		die();
	}
	
	$loginPassword = Get("loginpassword");
	if($loginPassword != md5('yanansmoke'))
		die();

	//$strSql = "Select id ,openid, username , mobile , address , gottime From userinfo where mobile <> '' order by id  ";
	$strSql = "Select u.id ,u.openid,u.nickname, u.username , u.mobile , u.address , u.gottime,ifnull(d.giftname,'京东到家APP八元现金券') as giftname  From userinfo u ";
	$strSql.= "left join giftdetail d on u.giftid =d.id ";
	$strSql.= "where u.gifttype<>0  order by u.id  ";
	$mobiles = DBGetDataRows($strSql);
	
	$strCSV = "id , openid,nickname,username , mobile , address , gottime,giftname \n";
	for($i=0;$i<count($mobiles);$i++){
		$strCSV .= $mobiles[$i]["id"];
		$strCSV .= "," . $mobiles[$i]["openid"];
		$strCSV .= "," . $mobiles[$i]["nickname"];
		$strCSV .= "," . $mobiles[$i]["username"];
		$strCSV .= "," . $mobiles[$i]["mobile"];
		$strCSV .= "," . $mobiles[$i]["address"];
		$strCSV .= "," . $mobiles[$i]["gottime"];
		$strCSV .= "," . $mobiles[$i]["giftname"];
		$strCSV .= "\n";
	}
	
	//export_csv("data.csv",iconv('utf-8', 'gb2312' , $strCSV));
	export_csv("data.csv", "\xEF\xBB\xBF".$strCSV);
?>