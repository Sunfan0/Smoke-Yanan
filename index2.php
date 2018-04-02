<?php
	include "paras.php";
	$openid = Get("wang");
	$userInfo=null;
	
	if($openid == ""){
		$arrInfo = InitCustInfoV3();
		$openid = $arrInfo["openid"];
		$nickname=$arrInfo["nickname"];
		$headimgurl=$arrInfo["headimgurl"];
	} else {
		$userInfo = DBGetDataRowByField("userinfo" , "openid" , $openid);
		$nickname = $userInfo["nickname"];
		$headimgurl = $userInfo["imgurl"];
	}
	$_SESSION["stropenid"]=$openid;
	
	if($userInfo==null){//没有进行数据查找
		$userInfo = DBGetDataRowByField("userinfo" , "openid" , $openid);
	}
	
	if($userInfo==null){//若没有查找到数据
		$userId = DBInsertTableField("userinfo",array("openid","nickname","imgurl"), array($openid,$nickname,$headimgurl));
	}else{
		$userId=$userInfo["id"];
	}
	
	//$visitid = InitVisitidV3();
	$visitid = -1;
	VisitHistoryV3($openid , $visitid , "index.php");//在visithistory表中插入访问数据

	$stropenid = substr($openid, 0, 10);
	$token = md5($stropenid.$userId);
	$imgPath = "http://wwwcloud.wsestar.com/test/smoke-yanan/image/";  
	$imgPath = "image/";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>延安1935真红烟</title>
		<link rel="stylesheet" href="style/style.common.css" charset="utf8" />
		<link rel="stylesheet" href="style/style.css" charset="utf8" />
	</head>
	<body>
		<div id="maincontainer" class="float hidden fullScreen" style="overflow:hidden;">  
			<div  class="float fullScreen hidden" id="pageLoad">
				<img crossorigin="anonymous"   id="loadBg" data-src="<?=$imgPath?>loadBg.jpg" class="float fullScreen" >
				<img crossorigin="anonymous"   id="loadCar" data-src="<?=$imgPath?>loadCar.png" class="float carShake" >
				<img crossorigin="anonymous"   id="loadSmoke" data-src="<?=$imgPath?>loadSmoke.png" class="float carShake" >
				<img crossorigin="anonymous"   id="loadWheel1" data-src="<?=$imgPath?>loadWheel1.png" class="float wheelTurn" >
				<img crossorigin="anonymous"   id="loadWheel2" data-src="<?=$imgPath?>loadWheel2.png" class="float wheelTurn" >
				<img crossorigin="anonymous"   id="loadLine" data-src="<?=$imgPath?>loadLine.png" class="float" >
				<img crossorigin="anonymous"   id="loadText" data-src="<?=$imgPath?>loadText.png" class="float" >
				<img crossorigin="anonymous"   id="loadFoot" data-src="<?=$imgPath?>loadFoot.png" class="float" >
			</div>
			<div  class="float fullScreen hidden" id="pageStart">
				<img crossorigin="anonymous"   id="startBg" data-src="<?=$imgPath?>startBg.jpg" class="float fullScreen" >
				<img crossorigin="anonymous"   id="startScreen" data-src="<?=$imgPath?>readyScreen.png" class="float" >
				<img crossorigin="anonymous"   id="startLight" data-src="<?=$imgPath?>startLight.png" class="float hidden" >
				<img crossorigin="anonymous"   id="startLight1" data-src="<?=$imgPath?>startLight1.png" class="float hidden" >
				<img crossorigin="anonymous"   id="startPeoples" data-src="<?=$imgPath?>startPeoples.png" class="float" >
				<img crossorigin="anonymous"   id="startShelf" data-src="<?=$imgPath?>startShelf.png" class="float" >
				<img crossorigin="anonymous"   id="startPlayer1" data-src="<?=$imgPath?>startPlayer1.png" class="float hidden" >
				<img crossorigin="anonymous"   id="startPlayer2" data-src="<?=$imgPath?>startPlayer2.png" class="float hidden" >
				<img crossorigin="anonymous"   id="startArm1" data-src="<?=$imgPath?>startArm1.png" class="float" >
				<img crossorigin="anonymous"   id="startArm2" data-src="<?=$imgPath?>startArm2.png" class="float hidden" >
				<img crossorigin="anonymous"   id="startBoy" data-src="<?=$imgPath?>startBoy.png" class="float" >
				<img crossorigin="anonymous"   id="startGirl" data-src="<?=$imgPath?>startGirl.png" class="float" >
				<img crossorigin="anonymous"   id="startRely" data-src="<?=$imgPath?>startRely.png" class="float hidden" >
				<img crossorigin="anonymous"   id="startOldman1" data-src="<?=$imgPath?>startOldman1.png" class="float" >
				<img crossorigin="anonymous"   id="startOldman2" data-src="<?=$imgPath?>startOldman2.png" class="float hidden" >
				<img crossorigin="anonymous"   id="startOldman3" data-src="<?=$imgPath?>startOldman3.png" class="float hidden" >
				<img crossorigin="anonymous"   id="startHand1" data-src="<?=$imgPath?>startHand1.png" class="float" >
				<img crossorigin="anonymous"   id="startHand2" data-src="<?=$imgPath?>startHand2.png" class="float hidden" >
				<img crossorigin="anonymous"   id="startArrow" data-src="<?=$imgPath?>endArrow.png" class="float hidden arrowShade" >
			</div>
			<div id="pageImg" class="float video">
				<img crossorigin="anonymous"   data-src="<?=$imgPath?>imgSand1-col4.jpg" class="float hidden" >
				<img crossorigin="anonymous"   data-src="<?=$imgPath?>imgSand2-col4.jpg" class="float hidden" >
				<img crossorigin="anonymous"   data-src="<?=$imgPath?>imgSand3-col4.jpg" class="float hidden" >
				<img crossorigin="anonymous"   data-src="<?=$imgPath?>imgSand4-col4.jpg" class="float hidden" >
				<img crossorigin="anonymous"   data-src="<?=$imgPath?>imgSand5-col4.jpg" class="float hidden" >
				<img crossorigin="anonymous"   data-src="<?=$imgPath?>imgSand6-col4.jpg" class="float hidden" >
				<img crossorigin="anonymous"   data-src="<?=$imgPath?>imgSand7-col4.jpg" class="float hidden" >
				<img crossorigin="anonymous"   data-src="<?=$imgPath?>imgSand8-col4.jpg" class="float hidden" >
				<img crossorigin="anonymous"   data-src="<?=$imgPath?>imgSand9-col4.jpg" class="float hidden" >
				<audio loop id="wholeAudio" src="a.mp3"></audio>
				<audio id="imgAudio" src="audio.mp3"></audio>
			</div>
			<div  class="float fullScreen hidden" id="pageEnd">
				<img crossorigin="anonymous"   id="endBg" data-src="<?=$imgPath?>startBg.jpg" class="float fullScreen" >
				<img crossorigin="anonymous"   id="endGas" data-src="<?=$imgPath?>endGas.png" class="float" style="opacity:0">
				<img crossorigin="anonymous"   id="endRope1" data-src="<?=$imgPath?>endRope1.png" class="float" >
				<img crossorigin="anonymous"   id="endRope2" data-src="<?=$imgPath?>endRope2.png" class="float hidden" >
				<img crossorigin="anonymous"   id="endThread" data-src="<?=$imgPath?>endThread.png" class="float hidden" >
				<img crossorigin="anonymous"   id="endSmoke" data-src="<?=$imgPath?>endSmoke.png" class="float hidden" >
				<img crossorigin="anonymous"   id="endSmoke1" data-src="<?=$imgPath?>endSmoke1.png" class="float hidden">
				<img crossorigin="anonymous"   id="endArm" data-src="<?=$imgPath?>endArm.png" class="float hidden" >
				<img crossorigin="anonymous"   id="endPeople" data-src="<?=$imgPath?>endPeople.png" class="float hidden" >
			</div>
			
			<img crossorigin="anonymous"   id="readyPeople1" data-src="<?=$imgPath?>readyPeople1.png" class="float hidden" >
			<img crossorigin="anonymous"   id="readyPeople2" data-src="<?=$imgPath?>readyPeople2.png" class="float hidden" >
			<img crossorigin="anonymous"   id="readyPeople3" data-src="<?=$imgPath?>readyPeople3.png" class="float hidden" >
			<img crossorigin="anonymous"   id="readyPeople0" data-src="<?=$imgPath?>readyPeople4.png" class="float hidden" >
			
			<div  class="float fullScreen hidden" id="pageInfo">
				<img crossorigin="anonymous"   id="infoBg" data-src="<?=$imgPath?>infoBg.jpg" class="float fullScreen" >
				<img crossorigin="anonymous"   id="infoStar" data-src="<?=$imgPath?>infoStar.png" class="float hidden" >
				<img crossorigin="anonymous"   id="infoLine1" data-src="<?=$imgPath?>infoLine1.png" class="float hidden" >
				<img crossorigin="anonymous"   id="infoLine2" data-src="<?=$imgPath?>infoLine2.png" class="float hidden" >
				<img crossorigin="anonymous"   id="infoTitle1" data-src="<?=$imgPath?>infoTitle1.png" class="float hidden" >
				<img crossorigin="anonymous"   id="infoTitle2" data-src="<?=$imgPath?>infoTitle2.png" class="float hidden" >
				<img crossorigin="anonymous"   id="infoSmoke2" data-src="<?=$imgPath?>infoSmoke2.png" class="float" >
				<img crossorigin="anonymous"   id="infoSmoke1" data-src="<?=$imgPath?>infoSmoke1.png" class="float" >
				<img crossorigin="anonymous"   id="infoBorder" data-src="<?=$imgPath?>infoBorder.png" class="float" >
				<img crossorigin="anonymous"   id="infoMark1" data-src="<?=$imgPath?>infoMark1.png" class="float" >
				<img crossorigin="anonymous"   id="infoMark2" data-src="<?=$imgPath?>infoMark2.png" class="float hidden" >
				<img crossorigin="anonymous"   id="infoMark3" data-src="<?=$imgPath?>infoMark3.png" class="float hidden" >
				<img crossorigin="anonymous"   id="infoSign1" data-src="<?=$imgPath?>infoSign.png" class="float hidden" >
				<img crossorigin="anonymous"   id="infoSign2" data-src="<?=$imgPath?>infoSign.png" class="float hidden" >
				<img crossorigin="anonymous"   id="infoSign3" data-src="<?=$imgPath?>infoSign.png" class="float hidden" >
				<img crossorigin="anonymous"   id="infoCircle1" data-src="<?=$imgPath?>infoCircle.png" class="float infoCircle hidden"  >
				<img crossorigin="anonymous"   id="infoCircle2" data-src="<?=$imgPath?>infoCircle.png" class="float infoCircle hidden" >
				<img crossorigin="anonymous"   id="infoCircle3" data-src="<?=$imgPath?>infoCircle.png" class="float infoCircle hidden" >
				<img crossorigin="anonymous"   id="infoText1" data-src="<?=$imgPath?>infoText1.png" class="float" >
				<img crossorigin="anonymous"   id="infoText2" data-src="<?=$imgPath?>infoText2.png" class="float hidden" >
				<img crossorigin="anonymous"   id="infoText3" data-src="<?=$imgPath?>infoText3.png" class="float hidden" >
				<img crossorigin="anonymous"   id="infoDrawbtn" data-src="<?=$imgPath?>infoDrawbtn.png" class="float" >
				<img crossorigin="anonymous"   id="infoRulebtn" data-src="<?=$imgPath?>infoRulebtn.png" class="float" >
			</div>
			<div  class="float fullScreen hidden" id="pageRule" style="background:rgba(255,255,255,0.7)">
				<img crossorigin="anonymous"   id="ruleBorder" data-src="<?=$imgPath?>ruleBorder.png" class="float" >
				<img crossorigin="anonymous"   id="ruleClose" data-src="<?=$imgPath?>ruleClose.png" class="float" >
			</div>
			<div  class="float fullScreen hidden" id="pageShake">
				<img crossorigin="anonymous"   id="shakeBg" data-src="<?=$imgPath?>shakeBg.jpg" class="float fullScreen" >
				<img crossorigin="anonymous"   id="shakeHand1" data-src="<?=$imgPath?>shakeHand1.png" class="float" >
				<img crossorigin="anonymous"   id="shakeHand2" data-src="<?=$imgPath?>shakeHand2.png" class="float hidden" >
				<img crossorigin="anonymous"   id="shakeHand3" data-src="<?=$imgPath?>shakeHand3.png" class="float hidden" >
				<img crossorigin="anonymous"   id="shakeCircle" data-src="<?=$imgPath?>shakeCircle.png" class="float" >
				<img crossorigin="anonymous"   id="shakeSign1" data-src="<?=$imgPath?>shakeSign1.png" class="float" >
				<img crossorigin="anonymous"   id="shakeSign2" data-src="<?=$imgPath?>shakeSign2.png" class="float" >
				<img crossorigin="anonymous"   id="shakeText" data-src="<?=$imgPath?>shakeText.png" class="float shake" >
			</div>
			<div  class="float fullScreen hidden" id="pagePrizereal" style="background:rgba(255,255,255,0.5)">
				<img crossorigin="anonymous"   id="realBorder" data-src="<?=$imgPath?>realBorder.png" class="float fullScreen" >
				<img crossorigin="anonymous"   id="realTitle" data-src="<?=$imgPath?>realTitle.png" class="float" >
				<img crossorigin="anonymous"   id="realText1" data-src="<?=$imgPath?>realText1.png" class="float hidden" >
				<img crossorigin="anonymous"   id="realText2" data-src="<?=$imgPath?>realText2.png" class="float hidden" >
				<img crossorigin="anonymous"   id="realText3" data-src="<?=$imgPath?>realText3.png" class="float hidden" >
				<img crossorigin="anonymous"   id="realForm" data-src="<?=$imgPath?>realForm.png" class="float" >
				<input id="realInput1" style="color:black;text-align:center;border-radius:30px;outline:none;background-color:transparent;" class="float">
				<input id="realInput2" type="number" inputmode="numeric" pattern="\d*" style="color:black;text-align:center;border-radius:30px;outline:none;background-color:transparent;" class="float">
				<input id="realInput3" style="color:black;text-align:center;border-radius:30px;outline:none;background-color:transparent;" class="float">
				<img crossorigin="anonymous"   id="realSubmit" data-src="<?=$imgPath?>realSubmit.png" class="float" >
				<img crossorigin="anonymous"   id="realFoot" data-src="<?=$imgPath?>realFoot.png" class="float" >
			</div>
			<div  class="float fullScreen hidden" id="pagePrizevirtual" style="background:rgba(255,255,255,0.5)">
				<img crossorigin="anonymous"   id="virtualBorder" data-src="<?=$imgPath?>realBorder.png" class="float fullScreen" >
				<img crossorigin="anonymous"   id="virtualTitle" data-src="<?=$imgPath?>realTitle.png" class="float" >
				<img crossorigin="anonymous"   id="virtualContent" data-src="<?=$imgPath?>virtualContent.png" class="float" >
				<img crossorigin="anonymous"   id="virtualAgainbtn" data-src="<?=$imgPath?>virtualAgainbtn.png" class="float" >
				<img crossorigin="anonymous"   id="virtualSharebtn" data-src="<?=$imgPath?>virtualSharebtn.png" class="float" >
			</div>
			<div  class="float fullScreen hidden" id="pageShare" style="background:#000;opacity:0.8;">
				<img crossorigin="anonymous"   id="shareText1" data-src="<?=$imgPath?>shareText1.png" class="float hidden" >
				<img crossorigin="anonymous"   id="shareText2" data-src="<?=$imgPath?>shareText2.png" class="float hidden" >
				<img crossorigin="anonymous"   id="shareSign" data-src="<?=$imgPath?>shareSign.png" class="float" >
			</div>
			<div  class="float fullScreen hidden" id="pageMessage" style="background:rgba(255,255,255,0.6)">
				<img crossorigin="anonymous"   id="messageBorder" data-src="<?=$imgPath?>messageBorder.png" class="float" >
				<img crossorigin="anonymous"   id="messageText1" data-src="<?=$imgPath?>messageText1.png" class="float hidden" >
				<img crossorigin="anonymous"   id="messageText2" data-src="<?=$imgPath?>messageText2.png" class="float hidden" >
				<img crossorigin="anonymous"   id="messageText3" data-src="<?=$imgPath?>messageText3.png" class="float hidden" >
				<img crossorigin="anonymous"   id="messagebtn" data-src="<?=$imgPath?>messagebtn.png" class="float" >
			</div>
		</div>
	</body>
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.common.js" ></script>
	<script  type="text/javascript" src="js/jquery.touchSwipe.min.js" ></script>
	<script  type="text/javascript" src="http://weixin.wsestar.com/common/script.js" ></script>
	<script type="text/javascript" src="canvid.js" ></script>
	<script type="text/javascript" src="webgl-2d.js" ></script>
	<script type="text/javascript">
		var Settings = {};
		Settings.FillInfo=false;
		Settings.BeginShake=false;
		
		var WXSettings = {};
		WXSettings.defaulttitle="延安1935 真红烟";
		WXSettings.defaultdesc="延安1935 真红烟，真有礼";
		WXSettings.link='<?php echo URL_BASE; ?>index.php';
		WXSettings.defaultimgUrl='<?php echo URL_BASE; ?>image/sharelogo.jpg';
		WXSettings.defaulttimeline="延安1935 真红烟，真有礼";
		
		var imgAudio=document.getElementById("imgAudio");
		var wholeAudio=document.getElementById("wholeAudio");
		var x=y=z=last_x=last_y=last_z=last_update=0;
		var SHAKE_THRESHOLD=1000;
		var canvidControl;
		
		PageSize.oriHeight = 1130;
		PageSize.oriWidth = 720;
		PageSize.windowHeight = $(window).height();
		PageSize.windowWidth = $(window).width();
	
		var visitid = "<?php echo $visitid; ?>";
		var openid = "<?php echo $openid; ?>";
		var userId = "<?php echo $userId; ?>";
		var token = "<?php echo $token; ?>";

		// $(document).ready(function(){
			// $.preAllLoadImg("white",function(){
				// $("#loading").addClass("hidden");
				// OnLoad();
			// });
		// });
		
		(function($){		//全部加载
			$.preloadWithLoadings = function(progress , callback){
				var imgNum = 0;
				var images = [];
				var totalImages = 0;
				var imgs = document.images;
				var index = 0;
// -----
				var loadingImg = new Array(); 
				var arr = new Array();   
				$('#pageLoad > ').each(function(i){
				   loadingImg[i] = this.id;
				});

				$("img").each(function(){
					if($(this).data("src")){				
						totalImages++;
						var img = new Image();
						img.crossOrigin = '';
						img.src = $(this).data("src");
						img.container = $(this).attr("id");
						$(img).bind("load",function(e){
							//if(e.type!='error'){
								$("#"+this.container).attr("src",this.src);
							//}
							index++;
							progress(index / totalImages * 100)
							// loadingImgFull(this.container);
							if(index == totalImages){
								callback();
							}
							$(this).unbind('load');
							// console.log(this.container + " , " + index + " , " + $("#"+this.container).css("top"));
							
// ----
							if(loadingImg.length==0){
								// console.log("loadingImg加载完");
								$("#pageLoad").show();
							}
							else{
								for(i=0;i<loadingImg.length;i++){
									if(this.container==loadingImg[i]){
										loadingImg.splice(i,1);
									}
								}
							}
							
						});
					}
				});
			}
		})(jQuery); 
		
		$(document).ready(function(){
			black();
			SetSizes();
			$.preloadWithLoadings(LoadingProgress , OnLoad);
		});

		function LoadingProgress(percent){
			//loadCar : 46,555
			//loadSmoke : 56 , 565
			//loadWheel1 : 63 , 572
			//loadWheel2 : 142 , 651
			// console.log(46 + (555 - 46) * percent / 100);
			$("#loadCar").css({left:OffsetLeftFullScreen(46 + (555 - 46) * percent / 100)},200,"linear");
			$("#loadSmoke").css({left:OffsetLeftFullScreen(56 + (565 - 56) * percent / 100)},200,"linear");
			$("#loadWheel1").css({left:OffsetLeftFullScreen(63 + (572 - 63) * percent / 100)},200,"linear");
			$("#loadWheel2").css({left:OffsetLeftFullScreen(142 + (651 - 142) * percent / 100)},200,"linear");
			if(percent == 100){
				$("#loadWheel1,#loadWheel2").removeClass("wheelTurn");
				$("#loadCar,#loadSmoke").removeClass("carShake");
				$("#pageLoad").hide();
				$("#pageStart").show();
				ShowPageStart("start");		//步行动画
				StartBeginAnimat();		//台下观众的动画
			}
		}
		
		//window.onload = OnLoad;
		
		function OnLoad(){	
			// black();
			// SetSizes();	
			// alert("测试期间抽奖结果无效");
			BindEvents();
			// ShowPageLoad();
			
			var ImgHeight = OffsetTopFullScreen(284);
			var ImgWidth = OffsetLeftFullScreen(601);
			
			canvidControl = canvid({
				selector : '.video',
				videos: {
					clip1: { src: '<?=$imgPath?>imgSand1-col4.jpg', frames: 175, cols: 4, loops: 1,fps:15, onEnd: function(){
						canvidControl.play('clip2');
					}},
					clip2: { src: '<?=$imgPath?>imgSand2-col4.jpg', frames: 175, cols: 4, loops: 1,fps:15, onEnd: function(){
						canvidControl.play('clip3');
					}},
					clip3: { src: '<?=$imgPath?>imgSand3-col4.jpg', frames: 175, cols: 4, loops: 1,fps:15, onEnd: function(){
						canvidControl.play('clip4');
					}},
					clip4: { src: '<?=$imgPath?>imgSand4-col4.jpg', frames: 175, cols: 4, loops: 1,fps:15, onEnd: function(){
						canvidControl.play('clip5');
					}},
					clip5: { src: '<?=$imgPath?>imgSand5-col4.jpg', frames: 175, cols: 4, loops: 1,fps:15, onEnd: function(){
						canvidControl.play('clip6');
					}},
					clip6: { src: '<?=$imgPath?>imgSand6-col4.jpg', frames: 175, cols: 4, loops: 1,fps:15, onEnd: function(){
						canvidControl.play('clip7');
					}},
					clip7: { src: '<?=$imgPath?>imgSand7-col4.jpg', frames: 175, cols: 4, loops: 1,fps:15, onEnd: function(){
						canvidControl.play('clip8');
					}},
					clip8: { src: '<?=$imgPath?>imgSand8-col4.jpg', frames: 175, cols: 4, loops: 1,fps:15, onEnd: function(){
						canvidControl.play('clip9');
					}},
					clip9: { src: '<?=$imgPath?>imgSand9-col4.jpg', frames: 101, cols: 4,loops: 1,fps:15, onEnd: function(){
						$("#pageImg").hide();
						$("#startLight1").hide();
						$("#startLight").hide();
						imgAudio.pause();
						ShowPageStart("end");		//步行动画
						setTimeout(function(){
							wholeAudio.play();
							$("#startPlayer1").hide();
							$("#startPlayer2").show();
						},400);
						setTimeout(function(){
							$("#startPlayer2").hide();
						},600);
					}}
				},
				width: ImgWidth,
				height: ImgHeight,
				loaded: function() {
					// canvidControl.play('clip1');
					$(".canvid").addClass("hidden");
				}
			});
		}
		function BindEvents(){
			$("#pageStart").swipe({
				swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
				},threshold:50
			});	
			$("#infoDrawbtn").click(function(){
				ShowNextPage("pageInfo","pageShake");
				ShowPageShake();
			});
			$("#infoRulebtn").click(function(){
				$("#pageRule").show();
			});
			$("#pageRule").click(function(){
				$("#pageRule").hide();
			});
			$("#realSubmit").click(function(){
				PrizeSubmitInfo();
			});
			$("#virtualAgainbtn").click(function(){
				$("#pagePrizevirtual").hide();
				$("#pageShake").show();
				Settings.BeginShake = false;
				ShowPageShake();
			});
			$("#virtualSharebtn").click(function(){
				$("#pagePrizevirtual,#shareText1").hide();
				$("#pageShare,#shareText2").show();
			});
			$("#messagebtn").click(function(){
				$("#pageMessage").hide();
				$("#pageShare").show();
				// if(Settings.FillInfo){		//提交信息
					// $("#shareText1").show();
				// }
				// else
					$("#shareText2").show();
			});
			$(".infoCircle").each(function(){
				$(this).click(function(){
					$('[id^="infoMark"]').hide();
					$('[id^="infoText"]').hide();
					$("#infoMark1").SetSizeFullScreen(822-67,188,234,73);	
					$("#infoMark2").SetSizeFullScreen(611-55-67,278,145,102+55);	
					$("#infoMark3").SetSizeFullScreen(742-67,277,145,59);	
					$("#infoText1").SetSizeFullScreen(698-67,435,167,163);	
					$("#infoText2").SetSizeFullScreen(705-67,434,170,97);	
					$("#infoText3").SetSizeFullScreen(694-67,440,156,178);		
					var id = $(this).attr("id").substr(10,1);
					$("#infoMark"+id).ShowText("lefttoright",300);
					setTimeout(function(){ 
						$("#infoText"+id).ShowText("lefttoright",500);
					},300)
				});
			});	
			
$("#shakeText").click(function(){
	clearInterval(Settings.setIntervalShake);
	setTimeout(function(){
		$("#shakeHand1").show();
		$("#shakeHand2").hide();
		$("#shakeHand3").hide();	
		ShakeGamePrize();				
	},1500);
});
		}
		function ShowPageLoad(){									//小车加载页面
			$("#loadCar").animate({left:OffsetLeftFullScreen(555)},1500,"linear");
			$("#loadSmoke").animate({left:OffsetLeftFullScreen(565)},1500,"linear");
			$("#loadWheel1").animate({left:OffsetLeftFullScreen(572)},1500,"linear");
			$("#loadWheel2").animate({left:OffsetLeftFullScreen(651)},1500,"linear");
			setTimeout(function(){ 
				$("#loadWheel1,#loadWheel2").removeClass("wheelTurn");
				$("#loadCar,#loadSmoke").removeClass("carShake");
			},1500)
			setTimeout(function(){
				$("#pageLoad").hide();
				$("#pageStart").show();
				ShowPageStart("start");		//步行动画
				StartBeginAnimat();		//台下观众的动画
			},1700)
		}
		function ShowPageStart(e){									//全部步行动画
			switch(e){
				case "start":
					var minValue=1;
					var maxValue=10;
					break;
				case "end":
					var minValue=10;
					var maxValue=19;
					break;
				case "all":
					var minValue=1;
					var maxValue=15;
					break;
			}
			for(i=minValue;i<=maxValue;i++){
				(function(i){
					var remainder = i%4;
					var whole = parseInt(i/4);
					var timer = i;
					if(e == "end")
						timer = timer - 8;
					setTimeout(function(){
						$("#readyPeople"+remainder).show();
						$('[id^="readyPeople"]').not("#readyPeople"+remainder).hide();
						if(remainder==1){
							$("#readyPeople1").SetSizeFullScreen(556+15,34+(170*whole),90,217);
							$("#readyPeople2").SetSizeFullScreen(550+15,108+(170*whole),34,146);
							$("#readyPeople3").SetSizeFullScreen(556+15,122+(170*whole),87,139);
							$("#readyPeople0").SetSizeFullScreen(550+15,196+(170*whole),60,148);
						}
						switch(e){
							case "start":
								if(i==maxValue){
									$('[id^="readyPeople"]').hide();
									$("#startPlayer2").show();
									setTimeout(function(){
										$("#startPlayer2").hide();
										$("#startPlayer1").show();
										$("#startLight1").show();
										StartPlayVideo();		//开始播放视频
									},500);
								}
								break;
							case "end":
								if(i==(maxValue-2)){
									clearInterval(Settings.setIntervalOldman);
									clearInterval(Settings.setIntervalRely);
									clearInterval(Settings.setIntervalArm);
									clearInterval(Settings.setIntervalHand);
									ShowPageEnd();
								}
								break;
							case "all":
								if(i==maxValue){
									$('[id^="readyPeople"]').hide();
									$("#endPeople").show();
									EndStartAnimat();
								}
								break;
						}	
					},300*timer);
				})(i);
			}
		}
		function StartBeginAnimat(){								//台下观众的动画
			Settings.setIntervalOldman = setInterval(function(){	//扇子
				setTimeout(function(){
					$("#startOldman1").show();
					$('[id^="startOldman"]').not("#startOldman1").hide();
				},0);
				setTimeout(function(){
					$("#startOldman2").show();
					$('[id^="startOldman"]').not("#startOldman2").hide();
				},500);
				setTimeout(function(){
					$("#startOldman3").show();
					$('[id^="startOldman"]').not("#startOldman3").hide();
				},1000);
				setTimeout(function(){
					$("#startOldman2").show();
					$('[id^="startOldman"]').not("#startOldman2").hide();
				},1500);
			},2000);
			Settings.setIntervalRely = setInterval(function(){		//男孩女孩
				setTimeout(function(){
					$("#startBoy").show();
					$("#startGirl").show();
					$("#startRely").hide();
				},0);
				setTimeout(function(){
					$("#startBoy").hide();
					$("#startGirl").hide();
					$("#startRely").show();
				},1000);
				setTimeout(function(){
					$("#startBoy").show();
					$("#startGirl").show();
					$("#startRely").hide();
				},2000);
			},3000);
			Settings.setIntervalArm = setInterval(function(){		//胳膊
				setTimeout(function(){
					$("#startArm1").show();
					$("#startArm2").hide();
				},0);
				setTimeout(function(){
					$("#startArm2").show();
					$("#startArm1").hide();
				},300);
				setTimeout(function(){
					$("#startArm1").show();
					$("#startArm2").hide();
				},800);
			},2000);
			Settings.setIntervalHand = setInterval(function(){		//手
				setTimeout(function(){
					$("#startHand1").show();
					$("#startHand2").hide();
				},0);
				setTimeout(function(){
					$("#startHand2").show();
					$("#startHand1").hide();
				},400);
				setTimeout(function(){
					$("#startHand1").show();
					$("#startHand2").hide();
				},800);
			},1600);
		}
		function StartPlayVideo(){									//开始播放视频
			wholeAudio.pause();
			imgAudio.play();
			setTimeout(function(){
				$("#startLight1").hide();
				$("#startLight").show();
			},500);
			$(".canvid").removeClass("hidden");
			canvidControl.play("clip1");
			setTimeout(function(){
				$("#startArrow").show();
				$("#pageStart").on('swipeLeft', function() {
					$("#pageImg").hide();
					$("#startLight1").hide();
					$("#startLight").hide();
					imgAudio.pause();
					canvidControl.destroy();	//停止视频和从DOM中移除当前canvid元帆布。
					ShowPageStart("end");		//步行动画
					setTimeout(function(){
						wholeAudio.play();
						$("#startPlayer1").hide();
						$("#startPlayer2").show();
					},400);
					setTimeout(function(){
						$("#startPlayer2").hide();
					},600);
				});
			},1000);
		}		
		function ShowPageEnd(){										//动画结束--小人离开
			ShowNextPage("pageStart","pageEnd");
			$("#readyPeople1").SetSizeFullScreen(556+15,34,90,217);
			$("#readyPeople2").SetSizeFullScreen(550+15,108,34,146);
			$("#readyPeople3").SetSizeFullScreen(556+15,122,87,139);
			$("#readyPeople0").SetSizeFullScreen(550+15,196,60,148);
			ShowPageStart("all");		//步行动画
		}
		function EndStartAnimat(){									//拉绳动画
			$("#endRope1").hide();
			$("#endRope2").show();
			$("#endThread").show();
			$("#endArm").show();
			$("#endRope2").css({height:OffsetTopFullScreen(605)}).animate({height:OffsetTopFullScreen(655)},200,"linear").animate({height:OffsetTopFullScreen(605)},200,"linear");
			$("#endThread").css({top:OffsetTopFullScreen(600)}).animate({top:OffsetTopFullScreen(650)},200,"linear").animate({top:OffsetTopFullScreen(600)},200,"linear");
			$("#endArm").addClass("armSwing");
			setTimeout(function(){
				$("#endRope1").show();
				$("#endRope2").hide();
				$("#endThread").hide();
				$("#endArm").hide();
				$("#endSmoke").addClass("slideInDown").show();
			},400)
			setTimeout(function(){
				$("#endSmoke").hide();
				$("#endSmoke1").show();
				var speedTime=80;
				var range=6;
				for(i=1;i<=6;i++){
					(function(i){
						if(i%5==1){
							setTimeout(function(){
								$("#endSmoke1").css({top:OffsetTopFullScreen(418),left:OffsetLeftFullScreen(214)});
							},speedTime*i);
						}
						else if(i%5==2){
							setTimeout(function(){
								$("#endSmoke1").css({top:OffsetTopFullScreen(418-range),left:OffsetLeftFullScreen(214+range)});
							},speedTime*i);
						}
						else if(i%5==3){
							setTimeout(function(){
								$("#endSmoke1").css({top:OffsetTopFullScreen(418+range),left:OffsetLeftFullScreen(214+range)});
							},speedTime*i);
						}
						else if(i%5==4){
							setTimeout(function(){
								$("#endSmoke1").css({top:OffsetTopFullScreen(418+range),left:OffsetLeftFullScreen(214-range)});
							},speedTime*i);
						}
						else{
							setTimeout(function(){
								$("#endSmoke1").css({top:OffsetTopFullScreen(418-10),left:OffsetLeftFullScreen(214-10)});
							},speedTime*i);
						}	
					})(i);
				}
			},700);
			// setTimeout(function(){
				// $("#endSmoke").hide();
				// $("#endSmoke1").show();
			// },1580)
			setTimeout(function(){
				ShowNextPage("pageEnd","pageInfo");
				ShowPageInfo();
			},2500)
		}
		function ShowPageInfo(){									//烟的介绍页面(加载摇一摇音乐)
			setTimeout(function(){
				$("#infoStar").show();
				$("#infoLine1").ShowText("righttoleft",3000);
				$("#infoLine2").ShowText("lefttoright",3000);
				$("#infoTitle1").ShowText("toptobottom",3000);
			},200)
			setTimeout(function(){
				$("#infoTitle2").addClass("bigToSmall").show();
			},600)
			setTimeout(function(){
				$("#infoSign1").addClass("signShade").show();
				$("#infoCircle1").addClass("circleBig").show();
			},400)
			setTimeout(function(){
				$("#infoSign2").addClass("signShade").show();
				$("#infoCircle2").addClass("circleBig").show();
			},600)
			setTimeout(function(){
				$("#infoSign3").addClass("signShade").show();
				$("#infoCircle3").addClass("circleBig").show();
			},800)
		}
		function ShowPageShake(){									//摇一摇页面	
			$("#shakeHand1").hide();
			// $("#shakeText").addClass("shake");
			ShakeHandAnimat();
			ShakeGameBegin();
			Settings.setIntervalShake=setInterval(function(){
				ShakeHandAnimat();
			},1000);
		}
		function ShakeHandAnimat(){									//摇一摇动画
			for(i=1;i<6;i++){
				(function(i){
					if(i%2!=0){
						setTimeout(function(){
							$("#shakeHand2").show();
							$("#shakeHand3").hide();
							$("#shakeSign1").addClass("swingRightPage").removeClass("swingLeftPage");
							$("#shakeSign2").addClass("swingLeftPage").removeClass("swingRightPage");
						},200*i);
					}
					else{
						setTimeout(function(){
							$("#shakeHand2").hide();
							$("#shakeHand3").show();
							$("#shakeSign1").addClass("swingLeftPage").removeClass("swingRightPage");
							$("#shakeSign2").addClass("swingRightPage").removeClass("swingLeftPage");
						},200*i);
					}
				})(i);
			}
		}
		function ShakeGameBegin(){									//可以摇一摇
			window.addEventListener('devicemotion', deviceMotionHandler, false);
		}
		function deviceMotionHandler(eventData){					//检测摇一摇
			if(Settings.BeginShake)
				return;
			var acceleration=eventData.accelerationIncludingGravity;//获取重力加速度；
			var curTime=new Date().getTime();//获取当前时间；
			var differentTime=curTime-last_update;
			
			if(differentTime>100){
				last_update=curTime;//记录上一次摇动的时间
				x=acceleration.x;
				y=acceleration.y;
				z=acceleration.z;
				var speed=Math.abs(x+y+z-last_x-last_y-last_z)/differentTime*7500;//计算临界值
				if(speed>SHAKE_THRESHOLD){			//开始摇动事件
					Settings.BeginShake = true;
					clearInterval(Settings.setIntervalShake);
					setTimeout(function(){
						$("#shakeHand1").show();
						$("#shakeHand2").hide();
						$("#shakeHand3").hide();
						ShakeGamePrize();				
					},1500);
				}
				last_x=x;
				last_y=y;
				last_z=z;
			}
			
		}
		function ShakeGamePrize(){									//摇一摇事件
			AjaxPostWait("ajax.php?mode=GetGift",{
					token:token,
					userid:userId
				},function(data){
				console.log(data);
				ShowPagePrize('-5');
				// alert("摇一摇");
			}, "json" );
		}
		function ShowPagePrize(e){									//奖品页面
			switch(e){
				case "10":				//10ipad
					$("#pagePrizereal,#realText1").show();
					$('[id^="realText"]').not("#realText1").hide();
					break;
				case "20":				//20延安1935
					$("#pagePrizereal,#realText2").show();
					$('[id^="realText"]').not("#realText2").hide();
					break;
				case "30":				//30延安红韵
					$("#pagePrizereal,#realText3").show();
					$('[id^="realText"]').not("#realText3").hide();
					break;
				case "-9":				//-9虚拟参与奖
					$("#pagePrizevirtual").show();
					break;
				case "-6":				//3次机会已经用完
						$("#messageBorder").SetSizeFullScreen(360,108,493,337);
						$("#pageMessage,#messageText3").show();
						// $("#messagebtn").hide();
						break;
				case "-5":				//已经抽奖成功，提交信息
						$("#pageMessage,#messageText1").show();
						break;
				default:
						Message("服务器忙，请稍候再试。");
						break;
			}
			
		}
		function PrizeSubmitInfo(){									//提交信息
			var name= $("#realInput1").val();
			var mobile= $("#realInput2").val();
			var address= $("#realInput3").val();
			if(name == ""){
				Message("姓名不能为空。");
				return false;
			}
			if(mobile == ""){
				Message("电话不能为空。");
				return false;
			}
			if(address == ""){
				Message("地址不能为空。");
				return false;
			}
			if(!(/^((\d{3,4}-)*\d{7,8}(-\d{3,4})*|(\+86|)1[3458]\d{9})$/.test(mobile))){ 
				Message("请填写正确的电话号码。");
				return false; 
			} 
			AjaxPostWait("ajax.php?mode=SubmitInfo",{
					token:token,
					userid:userId,
					name:name,
					mobile:mobile,
					address:address
				},function(data){
				// alert(data);
				if(data=="1"){
					Settings.FillInfo=true;
					$("#pagePrizereal").hide();
					$("#pageMessage,#messageText2").show();
				}
				else
					Message("服务器忙，请稍候再试。");
			}, "json" );
		}

		function SetSizes(){		
			$("#loadCar").SetSizeFullScreen(536,46,118,51);	
			$("#loadSmoke").SetSizeFullScreen(492,56,36,48);	
			$("#loadWheel1").SetSizeFullScreen(561,63,23,22);	
			$("#loadWheel2").SetSizeFullScreen(561,142,20,20);	
			$("#loadLine").SetSizeFullScreen(585,68,599,13);	
			$("#loadText").SetSizeFullScreen(616,285,159,21);	
			$("#loadFoot").SetSizeFullScreen(1074,222,289,16);	

			// $("#readyScreen").SetSizeFullScreen(136,0,721,544);		
			$("#readyPeople1").SetSizeFullScreen(556,34,90,217);
			$("#readyPeople2").SetSizeFullScreen(550,108,34,146);
			$("#readyPeople3").SetSizeFullScreen(556,122,87,139);
			$("#readyPeople0").SetSizeFullScreen(550,196,60,148);

			$("#startScreen").SetSizeFullScreen(136,0,721,544);	
			// $("#startLight").SetSizeFullScreen(231,80,577,451);	
			$("#startLight").SetSizeFullScreen(218,9,698,465);	
			// $("#startLight1").SetSizeFullScreen(231,80,577,451);	
			$("#startLight1").SetSizeFullScreen(218,9,698,465);	
			$("#startPeoples").SetSizeFullScreen(693,39,676,395);	
			$("#startShelf").SetSizeFullScreen(651,381,99,80);	
			$("#startPlayer1").SetSizeFullScreen(654,436,50,75);	
			$("#startPlayer2").SetSizeFullScreen(574,429,51,150);	
			$("#startArm1").SetSizeFullScreen(874,550,41,88);	
			$("#startArm2").SetSizeFullScreen(872,548,45,96);	
			$("#startBoy").SetSizeFullScreen(708,496,59,86);	
			$("#startGirl").SetSizeFullScreen(708,560,59,86);	
			$("#startRely").SetSizeFullScreen(704,496,122,89);	
			$("#startOldman1").SetSizeFullScreen(734,302,114,217);	
			$("#startOldman2").SetSizeFullScreen(734,302,130,217);	
			$("#startOldman3").SetSizeFullScreen(734,302,151,218);	
			$("#startHand1").SetSizeFullScreen(770,144,30,33);	
			$("#startHand2").SetSizeFullScreen(770,144,26,33);
			$("#startArrow").SetSizeFullScreen(504,636,47,47);
			
			// $("#pageImg").SetSizeFullScreen(260,106,516,265);
			$("#pageImg").SetSizeFullScreen(243,56,601,284);
			
			$("#endGas").SetSizeFullScreen(380,0,720,754);	
			$("#endRope1").SetSizeFullScreen(0,584,27,613);	
			$("#endRope2").SetSizeFullScreen(0,610,11,605);	
			$("#endThread").SetSizeFullScreen(600,608,13,30);	
			$("#endSmoke").SetSizeFullScreen(418,214,298,465);	
			$("#endSmoke1").SetSizeFullScreen(418,214,299,623);	
			// $("#endArrow").SetSizeFullScreen(504,636,47,47);	
			$("#endPeople").SetSizeFullScreen(585,615,64,148);	
			$("#endArm").SetSizeFullScreen(614,605,32,22);

			// $("#infoStar").SetSizeFullScreen(38,300,131,124);	
			$("#infoStar").SetSizeFullScreen(58,298,131,124);	
			// $("#infoLine1").SetSizeFullScreen(72,46,241,69);	
			$("#infoLine1").SetSizeFullScreen(87,46,241,69);	
			// $("#infoLine2").SetSizeFullScreen(72,441,243,68);	
			$("#infoLine2").SetSizeFullScreen(87,441,243,68);	
			// $("#infoHead").SetSizeFullScreen(192,132,461,129);	
			// $("#infoTitle1").SetSizeFullScreen(352,177,370,29);	
			$("#infoTitle1").SetSizeFullScreen(226,150,370,29);	
			// $("#infoTitle2").SetSizeFullScreen(393,176,359,87);	
			$("#infoTitle2").SetSizeFullScreen(274,147,359,87);	
			$("#infoSmoke1").SetSizeFullScreen(508-67,141,173,329);		
			$("#infoSmoke2").SetSizeFullScreen(693-67,28,466,300);	
			$("#infoBorder").SetSizeFullScreen(597-67,422,195,302);	
			$("#infoCircle1").SetSizeFullScreen(865-67,145,43,43);	
			$("#infoCircle2").SetSizeFullScreen(575-40-67,239,43,43);	
			$("#infoCircle3").SetSizeFullScreen(721-67,234,43,43);	
			$("#infoSign1").SetSizeFullScreen(872-67,153,28,28);		
			$("#infoSign2").SetSizeFullScreen(582-40-67,247,28,28);	
			$("#infoSign3").SetSizeFullScreen(728-67,242,28,28);	
			$("#infoMark1").SetSizeFullScreen(822-67,188,234,73);	
			$("#infoMark2").SetSizeFullScreen(611-55-67,278,145,102+55);	
			$("#infoMark3").SetSizeFullScreen(742-67,277,145,59);	
			$("#infoText1").SetSizeFullScreen(698-67,435,167,163);	
			$("#infoText2").SetSizeFullScreen(705-67,434,170,97);	
			$("#infoText3").SetSizeFullScreen(694-67,440,156,178);	
			$("#infoDrawbtn").SetSizeFullScreen(990-67,117,189,110);	
			$("#infoRulebtn").SetSizeFullScreen(986-67,424,194,112);
			
			// $("#ruleBorder").SetSizeFullScreen(358,116,480,379);	
			$("#ruleBorder").SetSizeFullScreen(79,75,571,979);	
			$("#ruleClose").SetSizeFullScreen(66,620,36,36);
			
			$("#shakeHand1").SetSizeFullScreen(450,262,186,294);
			$("#shakeHand2").SetSizeFullScreen(442,285,195,302);
			$("#shakeHand3").SetSizeFullScreen(456,210,222,293);
			$("#shakeCircle").SetSizeFullScreen(300,127,457,482);
			$("#shakeSign1").SetSizeFullScreen(424,252,53,56);	
			$("#shakeSign2").SetSizeFullScreen(542,432,48,59);
			$("#shakeText").SetSizeFullScreen(772,268,173,83);

			$("#realTitle").SetSizeFullScreen(272,282,146,44);	
			$("#realText1").SetSizeFullScreen(336,198,316,32);	
			$("#realText2").SetSizeFullScreen(339,170,390,31);	
			$("#realText3").SetSizeFullScreen(339,170,406,31);	
			$("#realForm").SetSizeFullScreen(394,201,314,237);	
			$("#realInput1").SetSizeFullScreen(417,298,193,41);	
			$("#realInput2").SetSizeFullScreen(498,298,193,41);	
			$("#realInput3").SetSizeFullScreen(574,298,193,41);	
			$("#realSubmit").SetSizeFullScreen(628,291,140,81);	
			$("#realFoot").SetSizeFullScreen(741,189,349,60);	
			// $("#realClose").SetSizeFullScreen(898,342,36,36);
			
			// $("#virtualTitle").SetSizeFullScreen(266,284,146,44);	
			$("#virtualTitle").SetSizeFullScreen(248,284,146,44);	
			$("#virtualContent").SetSizeFullScreen(174,110,497,688);	
			$("#virtualAgainbtn").SetSizeFullScreen(742,183,140,81);	
			$("#virtualSharebtn").SetSizeFullScreen(742,384,140,81);	
			
			$("#shareText1").SetSizeFullScreen(620,195,475,158);	
			$("#shareText2").SetSizeFullScreen(620,175,483,136);	
			$("#shareSign").SetSizeFullScreen(66,208,421,525);	

			$("#messageBorder").SetSizeFullScreen(438,168,388,265);		
			$("#messageText1").SetSizeFullScreen(504,210,309,39);	
			$("#messageText2").SetSizeFullScreen(513,246,237,34);	
			// $("#messageText3").SetSizeFullScreen(471,152,421,99);	
			$("#messageText3").SetSizeFullScreen(450,152,421,99);	
			$("#messagebtn").SetSizeFullScreen(555,267,191,110);	

			ShowPageRegist();
			
			
			//json = eval('(' + '<?php // echo GetWXConfigData(); ?>' + ')')
			json = eval('(' + '<?php echo GetWXConfigData_www_v2(); ?>' + ')')
//json.debug=true;
			wx.config(json);
			wx.error(function (res) {
				// alert(res.errMsg);
				// alert(res);
			});
			
			
		}
		function ShowPageRegist(lastpage){
			//$.post("ajax.php?mode=action&action=showpage2&page=action_index&openid=<?php //echo $openid; ?>");
			if(lastpage == null)
				lastpage = "";
			
			desc = Settings.defaultdesc;
			imgUrl = Settings.defaultimgUrl;
			BuildShareData();

			$("#maincontainer").removeClass("hidden")
		}
		
		function playAudio() {
			imgAudio.play();
			imgAudio.pause();
			wholeAudio.play();
		}
		function black(){
			playAudio();
			document.addEventListener("WeixinJSBridgeReady", function () {
				WeixinJSBridge.invoke('getNetworkType', {}, function (e) {
					network = e.err_msg.split(":")[1]; 
					playAudio();
				});
			}, false);
		}
   </script>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript">
	function BuildShareData(){
		if(!WXSettings)
			return;
		if(!visitid)
			visitid = -1;
		if(!openid)
			 openid = "";
	
		shareDataMessage = {
			title: WXSettings.defaulttitle,
			desc: WXSettings.defaultdesc,
			link: WXSettings.link,
			imgUrl: WXSettings.defaultimgUrl
		};
		shareDataTimeline = {
			title: WXSettings.defaulttimeline,
			desc: WXSettings.defaulttimeline,
			link: WXSettings.link,
			imgUrl: WXSettings.defaultimgUrl
		};
		wx.onMenuShareAppMessage({
			title: WXSettings.defaulttitle,
			desc: WXSettings.defaultdesc,
			link: WXSettings.link,
			imgUrl: WXSettings.defaultimgUrl,
			success: function () { 
				$.post("ajax.php?mode=Action&action=ShareAppMessage&page=Index&memo=Share&visitid=" + visitid + "&openid=" + openid +"&token="+token);
			}
			/* cancel: function () { 
				$.post("ajax.php?mode=Action&action=ShareAppMessage&page=Index&memo=Cancel&visitid=" + visitid + "&openid=" + openid +"&token="+token);
			} */
		});
		wx.onMenuShareTimeline({
			title: WXSettings.defaulttimeline,
			desc: WXSettings.defaulttimeline,
			link: WXSettings.link,
			imgUrl: WXSettings.defaultimgUrl,
			success: function () { 
				$.post("ajax.php?mode=Action&action=ShareTimeline&page=Index&memo=Share&visitid=" + visitid + "&openid=" + openid +"&token="+token);
			}
			/* cancel: function () { 
				$.post("ajax.php?mode=Action&action=ShareTimeline&page=Index&memo=Cancel&visitid=" + visitid + "&openid=" + openid +"&token="+token);
			} */
		});
		wx.onMenuShareQQ({
			title: WXSettings.defaulttitle,
			desc: WXSettings.defaultdesc,
			link: WXSettings.link,
			imgUrl: WXSettings.defaultimgUrl,
			success: function () { 
				$.post("ajax.php?mode=Action&action=ShareQQ&page=Index&memo=Share&visitid=" + visitid + "&openid=" + openid +"&token="+token);
			}
			/* cancel: function () { 
				$.post("ajax.php?mode=Action&action=ShareQQ&page=Index&memo=Cancel&visitid=" + visitid + "&openid=" + openid +"&token="+token);
			} */
		});
	}

	wx.ready(function () {
		BuildShareData();
		/* wx.hideMenuItems({
			menuList: [
				'menuItem:share:timeline' // 隐藏分享到朋友圈
			]
		}); */
	});
	</script>
</html>