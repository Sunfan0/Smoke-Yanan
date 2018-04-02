<?php
	include "paras.php";
	
	if(!defined("ONLINE_TIME"))
		define("ONLINE_TIME","2016-08-08");
	if(!defined("PASSWORD"))
		define("PASSWORD","yanansmoke");
	
	$mode = Get("mode");
	$loginpassword = Get("loginpassword");
	if($loginpassword!=md5(PASSWORD)){
		die();
	}

	$config = array();
	$c = array();
	$c["name"] = "DaysVisitLine";
	$c["mode"] = "DaysVisitLine";
	$c["title"] = "分日访问状况";
	$c["chart"] = "line";
	array_push($config,$c);
	
	$c = array();
	$c["name"] = "HoursVisitLine";
	$c["mode"] = "HoursVisitLine";
	$c["title"] = "分时访问状况";
	$c["chart"] = "line";
	array_push($config,$c);
	
	$c = array();
	$c["name"] = "DaysUserJoinLine";
	$c["mode"] = "DaysUserJoinLine";
	$c["title"] = "分日用户加入（初次访问）";
	$c["chart"] = "line";
	array_push($config,$c);
	
	$c = array();
	$c["name"] = "HoursUserJoinLine";
	$c["mode"] = "HoursUserJoinLine";
	$c["title"] = "分时用户加入（初次访问）";
	$c["chart"] = "line";
	array_push($config,$c);
	
	
	$c = array();
	$c["name"] = "DaysShareLine";
	$c["mode"] = "DaysShareLine";
	$c["title"] = "分日用户分享";
	$c["chart"] = "line";
	array_push($config,$c);
	
	$c = array();
	$c["name"] = "HoursShareLine";
	$c["mode"] = "HoursShareLine";
	$c["title"] = "分时用户分享";
	$c["chart"] = "line";
	array_push($config,$c);
	
	
	$c = array();
	$c["name"] = "FromUrlPie";
	$c["mode"] = "FromUrlPie";
	$c["title"] = "用户访问来源";
	$c["chart"] = "bar";
	array_push($config,$c);
		
	$c = array();
	$c["name"] = "ShareTargetPie";
	$c["mode"] = "ShareTargetPie";
	$c["title"] = "用户分享行为";
	$c["chart"] = "bar";
	array_push($config,$c);
	
	$c = array();
	$c["name"] = "DaysGotLine";
	$c["mode"] = "DaysGotLine";
	$c["title"] = "分日中实物奖人数";
	$c["chart"] = "line";
	array_push($config,$c);
	
	$c = array();
	$c["name"] = "HoursGotLine";
	$c["mode"] = "HoursGotLine";
	$c["title"] = "分时中实物奖人数";
	$c["chart"] = "line";
	array_push($config,$c);
	
	$c = array();
	$c["name"] = "DaysNoGotLine";
	$c["mode"] = "DaysNoGotLine";
	$c["title"] = "分日中虚拟参与奖人数";
	$c["chart"] = "line";
	array_push($config,$c);
	
	$c = array();
	$c["name"] = "HoursNoGotLine";
	$c["mode"] = "HoursNoGotLine";
	$c["title"] = "分时中虚拟参与奖人数";
	$c["chart"] = "line";
	array_push($config,$c);
	
	
	switch($mode){
		case "Login"://登录
			echo 1;
			break;
		case "GetConfig":
			echo json_encode($config);
			break;
		case 'DaysVisitLine'://分日，折线图//visithistory
			$strSql= " select date_format(visittime,'%Y-%m-%d') as title,count(*) as value from visithistory ";
			$strSql.= " where  visittime >= '".ONLINE_TIME."' ";
			$strSql.= " group by date_format(visittime,'%Y-%m-%d') order by date_format(visittime,'%Y-%m-%d') asc ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillDate($result);
			}
			echo json_encode($result);
			break;
		case 'HoursVisitLine'://分时，折线图//visithistory
			$strSql= " select date_format(visittime,'%H') as title,count(*) as value from visithistory  ";
			$strSql.= " where visittime >= '".ONLINE_TIME."' ";
			$strSql.= " group by date_format(visittime,'%H') order by date_format(visittime,'%H') asc ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillHour($result);
			}
			echo json_encode($result);
			break;
		case 'DaysUserJoinLine'://分日，折线图//userinfo
			$strSql= " select date_format(createtime,'%Y-%m-%d') as title,count(*) as value from userinfo ";
			$strSql.= " where  createtime >= '".ONLINE_TIME."' ";
			$strSql.= " group by date_format(createtime,'%Y-%m-%d') order by date_format(createtime,'%Y-%m-%d') asc ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillDate($result);
			}
			echo json_encode($result);
			break;
		case 'HoursUserJoinLine'://分时，折线图//userinfo
			$strSql= " select date_format(createtime,'%H') as title,count(*) as value from userinfo  ";
			$strSql.= " where createtime >= '".ONLINE_TIME."' ";
			$strSql.= " group by date_format(createtime,'%H') order by date_format(createtime,'%H') asc ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillHour($result);
			}
			echo json_encode($result);
			break;
		case 'DaysShareLine'://分日，折线图//分享
			$strSql= " select date_format(visittime,'%Y-%m-%d') as title,count(*) as value from actionhistory ";
			$strSql.= " where  visittime >= '".ONLINE_TIME."' ";
			$strSql.= " group by date_format(visittime,'%Y-%m-%d') order by date_format(visittime,'%Y-%m-%d') asc ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillDate($result);
			}
			echo json_encode($result);
			break;
		case 'HoursShareLine'://分时，折线图//分享
			$strSql= " select date_format(visittime,'%H') as title,count(*) as value from actionhistory  ";
			$strSql.= " where visittime >= '".ONLINE_TIME."' ";
			$strSql.= " group by date_format(visittime,'%H') order by date_format(visittime,'%H') asc ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillHour($result);
			}
			echo json_encode($result);
			break;	
		case 'FromUrlPie'://进入来源
			$strSql= " select visiturl as title,count(*) as value from visithistory ";
			$strSql.= " where  visittime >= '".ONLINE_TIME."' ";
			$strSql.= " group by visiturl ";
			$result = DBGetDataRowsSimple($strSql);
			echo json_encode($result);
			break;
		case 'ShareTargetPie'://分享途径
			$strSql= " select action as title ,count(*) as value from actionhistory ";
			$strSql.= " where  visittime >= '".ONLINE_TIME."' ";
			$strSql.= " group by action ";
			$result = DBGetDataRowsSimple($strSql);
			echo json_encode($result);
			break;
			
		case 'DaysGotLine'://分日中奖人数(实物奖)
			$strSql= " select date_format(gottime,'%Y-%m-%d') as title,count(*) as value from userinfo ";
			$strSql.= " where  gottime >= '".ONLINE_TIME."' and gifttype=1 ";
			$strSql.= " group by date_format(gottime,'%Y-%m-%d') ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillDate($result);
			}
			echo json_encode($result);
			break;
		case 'HoursGotLine'://分时中奖人数(实物奖)
			$strSql= " select date_format(gottime,'%H') as title,count(*) as value from userinfo ";
			$strSql.= " where  gottime >= '".ONLINE_TIME."' and gifttype=1 ";
			$strSql.= " group by date_format(gottime,'%H') ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillHour($result);
			}
			echo json_encode($result);
			break;
		case 'DaysNoGotLine'://分日中奖人数(非实物奖)
			$strSql= " select date_format(gottime,'%Y-%m-%d') as title,count(*) as value from userinfo ";
			$strSql.= " where  gottime >= '".ONLINE_TIME."' and gifttype=-1 ";
			$strSql.= " group by date_format(gottime,'%Y-%m-%d') ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillDate($result);
			}
			echo json_encode($result);
			break;
		case 'HoursNoGotLine'://分时中奖人数(非实物奖)
			$strSql= " select date_format(gottime,'%H') as title,count(*) as value from userinfo ";
			$strSql.= " where  gottime >= '".ONLINE_TIME."' and gifttype=-1 ";
			$strSql.= " group by date_format(gottime,'%H') ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillHour($result);
			}
			echo json_encode($result);
			break;
		

		case 'ShowGiftData':
			//(日期，预计实物奖总数，已领取实物奖总数，剩余实物奖品总数，虚拟领取总数)
			$strSql = " select date_format(g.gifttime,'%Y-%m-%d') as timer,sum(g.giftcount) as plancount,sum(g.gotcount) as gotcount,sum(g.giftcount) - sum(g.gotcount) as overcount,u.cnt as falsecount,u1.cnt as msgcount from giftcount g ";
			$strSql.= " left join (select date_format(gottime,'%Y-%m-%d') as gottimer, count(*) as cnt from userinfo where gifttype=-1) u on date_format(g.gifttime,'%Y-%m-%d') = date_format(u.gottimer,'%Y-%m-%d') ";
			$strSql.= " left join (select date_format(gottime,'%Y-%m-%d') as gottimer, count(*) as cnt from userinfo where mobile!='' and gifttype=1) u1 on date_format(g.gifttime,'%Y-%m-%d') = date_format(u1.gottimer,'%Y-%m-%d') ";
			$strSql.= " group by date_format(g.gifttime,'%Y-%m-%d') ";
		//echo $strSql;
		//die();
			$result = DBGetDataRowsSimple($strSql);
			echo json_encode($result);
			break;
		
		case 'ShowDetailGiftData':
			$strSql= " select giftlevel,giftname,date_format(gifttime,'%Y-%m-%d') as gifttime,giftcount,gotcount,giftcount - gotcount as count from giftcount ";
			$results = DBGetDataRows($strSql);	
			echo json_encode($results);			
			break;
		
	}
	
	function FillHour($arr){//填充小时
		for($i=0;$i<24;$i++){
			$h = str_pad($i,2,'0',STR_PAD_LEFT);
			$found = false;
			for($j=0;$j<count($arr);$j++){
				if($arr[$j]["title"] == $h){
					$found = true;
				}
			}
			
			if(!$found){
				$a = array();
				$a["title"] = $h;
				$a["value"] = 0;
				array_push($arr,$a);
			}
		}
		
		$title = array();
		$value = array();
		// 取得列的列表 
		foreach ($arr as $key => $row){ 
			$title[$key]  = $row['title'] . "点"; 
			$value[$key] = $row['value']; 
		} 
		array_multisort($title, SORT_ASC, $value, SORT_ASC, $arr); //返回一个升序排列的数组
		return $arr;
	}
	function FillDate($arr){//填充日期
		$days=prDates('2016-08-08',date('Y-m-d'));
		for($i=0;$i<count($days);$i++){
			$d = str_pad($days[$i],2,'0',STR_PAD_LEFT);
			$found = false;
			for($j=0;$j<count($arr);$j++){
				if($arr[$j]["title"] == $d){
					$found = true;
				}
			}
			
			if(!$found){
				$a = array();
				$a["title"] = $d;
				$a["value"] = 0;
				array_push($arr,$a);
			}
		}
		
		$title = array();
		$value = array();
		// 取得列的列表 
		foreach ($arr as $key => $row){ 
			$title[$key]  = $row['title'] . "点"; 
			$value[$key] = $row['value']; 
		} 
		array_multisort($title, SORT_ASC, $value, SORT_ASC, $arr); 
		return $arr;
	}
	function prDates($start,$end){ // 两个日期之间的所有日期 
		$p=array();
		$dt_start = strtotime($start);//转为日期格式  
		$dt_end = strtotime($end);  
		while ($dt_start<=$dt_end){  
			//echo date('Y-m-d',$dt_start).",";  
			array_push($p,date('Y-m-d',$dt_start));
			$dt_start = strtotime('+1 day',$dt_start); 
			
		} 
		return $p;
	}  
	
	
?>