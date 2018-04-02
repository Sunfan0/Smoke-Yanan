<?php
	include "paras.php";
	$mode = Get("mode");
	
	$userId = Get("userid");
	$token = Get("token");
	if($userId!=""){
		$userinfo = DBGetDataRowByField("userinfo" ,'id', $userId);
		if(!isset($_SESSION["stropenid"])){//session中是否存在数据
			$_SESSION["stropenid"]=$userinfo["openid"];
		}
		$checktoken = md5(substr($_SESSION["stropenid"], 0, 10).$userId);
		if($checktoken!=$token){
			die("-8");
		} 
	}
	
	

	$giftRates = array(//设置百分比
		"2016-08-19 00:00:00" => 100,
		"2016-08-20 00:00:00" => 80,
		"2016-08-21 00:00:00" => 60,
		"2016-08-22 00:00:00" => 50,
		"2016-08-23 00:00:00" => 50,
	);
	switch($mode){
		case "Action":
			$action = Get("action");
			$page = Get("page");
			$currenturl = GetRefferPage();
			$openid = Get("openid");
			$memo = Get("memo");
			$visitid = Get("visitid");
			if($action == ""){
				echo "para error";
				die();
			}
			ActionHistory($page , $currenturl , $action , $memo , $visitid , $openid);
			break;
			
		case "SubmitInfo"://抽中实物奖，提交信息
	//-7防止恶意更改提交数据，1更新成功，-1更新失败
			$name = Get("name");
			$mobile = Get("mobile");
			$address = Get("address");
			
			if($userinfo['mobile']!=""){
				die('-7');
			}
			
			if($userinfo["giftid"] == 0){
				die("-6");
			}
			
			DBBeginTrans();
			if(!DBUpdateField("userinfo" , $userId , array("username","mobile","address") ,array($name,$mobile,$address)))
				AjaxRollBack("-5");
			if(!DBUpdateField("giftdetail",$userinfo["giftid"],array("gotternickname","gottername","gottermobile","gotteraddress"),array($userinfo["nickname"],$name,$mobile,$address)))
				AjaxRollBack("-4");
			
			DBCommitTrans();
			echo "1";
			
			/*$r = DBUpdateField("userinfo" , $userId , array("username","mobile","address") ,array($name,$mobile,$address));
			if($r > 0){
				echo 1;//更新成功
			} else {
				echo -1;//更新失败
			}*/
			break;
		case "GetGift":
//返回值为-1时，出现更新失败，-6时，当天3次机会已经用完，没有抽中实物奖，（-9虚拟参与奖，10ipad,20延安1935,30延安红韵，）
			//echo 1;
			if($userinfo['mobile']!=""&&$userinfo["gifttype"]==1){
				die("-5");//已经抽奖成功，提交信息
			}
			
			if($userinfo["giftlevel"] != 0&&$userinfo["giftlevel"] != -9&&$userinfo['mobile']==""){//抽中实物奖，没填信息
				echo $userinfo["giftlevel"];//已经抽中实物奖的
				die();
			}
			
			$countinfo = DBGetDataRowByField("getcount" ,array("userid","gotdate"), array($userId,date('Y-m-d')));
			if($countinfo==null){
				$r=DBInsertTableField("getcount",array("userid","gotdate"),array($userId,date('Y-m-d')));
				if($r<=0){
					die("-1");
				}
			}
			
			$strSql = " Select gotcount from getcount where gotdate = date_format(now(),'%Y-%m-%d') and userid=$userId  ";//判断当天已抽奖数
			$gotcount = DBGetDataRow($strSql);
			if($gotcount["gotcount"]>=3){
				die("-6");//当天抽奖次数已经用完，提示明天再抽
			}
			
			$targetTime =  date("Y-m-d 00:00:00" , time() + 86400);
			$strSql = "Select giftlevel , giftcount as total , gotcount as got , giftcount - gotcount as count from giftcount where gifttime = '$targetTime' ";
			$giftLevels = DBGetDataRows($strSql);
			/////
			if($giftLevels == null){
				die("-1");//不在活动范围日期之内
			}
			$giftCount = 0;
			for($i=0;$i<count($giftLevels);$i++){
				$giftCount += $giftLevels[$i]["count"];
			}
			DBBeginTrans();
			if($giftCount == 0){//当天实物奖品已经抽完
				if(!DBUpdateField("userinfo" , $userId , array("giftlevel","gottime","giftid","gotgift","gifttype") ,array(-9,$DB_FUNCTIONS["now"],-99,1,-1)))
					AjaxRollBack();
				$r=DBInsertTableField("giftaction",array("userid","giftid","giftlevel","gottime"),array($userId,-99,-9,$DB_FUNCTIONS["now"]));
				if($r<=0)
					AjaxRollBack();
				if(!DBExecute(" UPDATE getcount SET gotcount=gotcount+1 WHERE userid=$userId and gotdate = date_format(now(),'%Y-%m-%d')"))
					AjaxRollBack();
				DBCommitTrans();
				die("-9");//虚拟参与奖
			}

			$rnd = mt_rand(0 , 100);
			if($rnd > $giftRates[$targetTime]){
				if(!DBUpdateField("userinfo" , $userId , array("giftlevel","gottime","giftid","gotgift","gifttype") ,array(-9,$DB_FUNCTIONS["now"],-99,1,-1)))
					AjaxRollBack();
				$r=DBInsertTableField("giftaction",array("userid","giftid","giftlevel","gottime"),array($userId,-99,-9,$DB_FUNCTIONS["now"]));
				if($r<=0)
					AjaxRollBack();
				if(!DBExecute(" UPDATE getcount SET gotcount=gotcount+1 WHERE userid=$userId and gotdate = date_format(now(),'%Y-%m-%d') "))
					AjaxRollBack();
				DBCommitTrans();
				die("-9");//虚拟参与奖
			}

			$gotGiftLevel = 0;
			for($i=0;$i<count($giftLevels);$i++){
				$rnd = mt_rand(0 , $giftCount);
				if($rnd <= $giftLevels[$i]["count"]){//在奖品总数范围之内
					$gotGiftLevel = $giftLevels[$i]["giftlevel"];
					break;
				}
				$giftCount = $giftCount - $giftLevels[$i]["count"];
			}

			if($gotGiftLevel == 0){
				if(!DBUpdateField("userinfo" , $userId , array("giftlevel","gottime","giftid","gotgift","gifttype") ,array(-9,$DB_FUNCTIONS["now"],-99,1,-1)))
					AjaxRollBack();
				$r=DBInsertTableField("giftaction",array("userid","giftid","giftlevel","gottime"),array($userId,-99,-9,$DB_FUNCTIONS["now"]));
				if($r<=0)
					AjaxRollBack();
				if(!DBExecute(" UPDATE getcount SET gotcount=gotcount+1 WHERE userid=$userId and gotdate = date_format(now(),'%Y-%m-%d')"))
					AjaxRollBack();
				DBCommitTrans();
				
				die("-9");//虚拟参与奖
			}

			//DBBeginTrans();
			$giftInfo = DBGetDataRowByFieldForUpdate("giftdetail",array("giftlevel","hasgot","gifttime"),array($gotGiftLevel,0,$targetTime));
			
			if($giftInfo == null){
				if(!DBUpdateField("userinfo" , $userId , array("giftlevel","gottime","giftid","gotgift","gifttype") ,array(-9,$DB_FUNCTIONS["now"],-99,1,-1)))
					AjaxRollBack();
				$r=DBInsertTableField("giftaction",array("userid","giftid","giftlevel","gottime"),array($userId,-99,-9,$DB_FUNCTIONS["now"]));
				if($r<=0)
					AjaxRollBack();
				if(!DBExecute(" UPDATE getcount SET gotcount=gotcount+1 WHERE userid=$userId and gotdate = date_format(now(),'%Y-%m-%d') "))
					AjaxRollBack();
				DBCommitTrans();
				
				die("-9");//虚拟参与奖
			}
			
			if(!DBUpdateField("userinfo" , $userId , array("giftlevel","gottime","giftid","gotgift","gifttype") ,array($gotGiftLevel,$DB_FUNCTIONS["now"],$giftInfo["id"],1,1)))
				AjaxRollBack();
			if(!DBUpdateField("giftdetail" , $giftInfo["id"] , array("hasgot","gotterid","gottime") ,array(1,$userId,$DB_FUNCTIONS["now"])))
				AjaxRollBack();
			$strSql = " Update giftcount Set gotcount = gotcount + 1 Where gifttime = '$targetTime' and giftlevel = $gotGiftLevel ";
			if(!DBExecute($strSql))
				AjaxRollBack();
				
			//插入抽奖行为
			$r=DBInsertTableField("giftaction",array("userid","giftid","giftlevel","gottime"),array($userId,$giftInfo["id"],$giftInfo["giftlevel"],$DB_FUNCTIONS["now"]));	
			if($r<=0)
				AjaxRollBack();	
			if(!DBExecute(" UPDATE getcount SET gotcount=gotcount+1 WHERE userid=$userId and gotdate = date_format(now(),'%Y-%m-%d')"))
				AjaxRollBack();	
				
			DBCommitTrans();
			echo $giftInfo["giftlevel"];
			
			die();
			break;
	}
?>