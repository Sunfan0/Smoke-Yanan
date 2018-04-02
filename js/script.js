var MessageSettings = {};
MessageSettings.ContainerTop = 400;
MessageSettings.ContainerLeft = 150;
MessageSettings.ContainerWidth = 340;
MessageSettings.ContainerHeight = 208;

function MessageFix(t){
	CheckMessageContainer();
	$("#messageText").html(t);
	$("#divMessage").removeClass("hidden");
	$("#divMessage").unbind("click");
}

function Message(t){
	CheckMessageContainer();
	$("#messageText").html(t);
	$("#divMessage").removeClass("hidden");
}

function MessageHide(){
	CheckMessageContainer();
	$("#divMessage").addClass("hidden");
}

function CheckMessageContainer(){
	if($("#divMessage").length != 0)
		return;
	
	strHtml  = '		<div id="divMessage" class="hidden image0" style="z-index:250;">' + "\n";
	strHtml += '			<div id="messageContainer" class="float" style="background:rgba(255,255,255,0.8);border-radius:15px;">' + "\n";
	strHtml += '				<table width="80%" height="100%" align="center" valign="middle"><tr>' + "\n";
	strHtml += '					<td id="messageText" align="center" valign="middle" style="color:black;"></td>' + "\n";
	strHtml += '				</tr></table>' + "\n";
	strHtml += '			</div>' + "\n";
	strHtml += '		</div>' + "\n";

	$(document.body).append(strHtml);

	PageSize.SetSizeFullScreen($("#divMessage"),0,0,PageSize.oriWidth,PageSize.oriHeight);
	PageSize.SetSizeFullScreen($("#messageContainer"),MessageSettings.ContainerTop,MessageSettings.ContainerLeft,MessageSettings.ContainerWidth,MessageSettings.ContainerHeight);
	
	$("#divMessage").click(function(){
		$("#divMessage").addClass("hidden");
	});
}

function Wait(){
	CheckWaitContainer();
	$("#divWait").removeClass("hidden");
}
function WaitFinish(){
	$("#divWait").addClass("hidden");
}

function CheckWaitContainer(){
	if($("#divWait").length != 0)
		return;
	
	strHtml  = '		<div id="divWait" class="hidden float" style="z-index:200;background:rgba(0,0,0,0.8)">' + "\n";
	strHtml += '			<img id="imgWait" class="float" src="image/load.gif">' + "\n";
	strHtml += '		</div>' + "\n";
	
	$(document.body).append(strHtml);

	PageSize.SetSizeFullScreen($("#divWait"),0,0,PageSize.oriWidth,PageSize.oriHeight);
	PageSize.SetSizeFullScreen($("#imgWait"),450,280,64,64);
}

$(document).ajaxStart(function(){
	Wait();
});
$(document).ajaxComplete(function(){
	WaitFinish();
});


var PageSize = {};

PageSize.windowHeight = -1;
PageSize.windowWidth = -1;
PageSize.min_size = -1;

PageSize.oriHeight = 1134;
PageSize.oriWidth = 720;


PageSize.SetSizeZoom = function(obj,top,left,width,height){
	if(top == null){
		obj.css("display","none");
		return;
	}

	obj.top = top / PageSize.oriHeight * PageSize.windowHeight;
	obj.left = left / PageSize.oriWidth * PageSize.windowWidth;
	
	if(height != null){
		obj.width = width / PageSize.oriWidth * PageSize.windowWidth;
		obj.height = height / PageSize.oriHeight * PageSize.windowHeight;
	}
	if(height == null && width !=null){
		obj.width = width / PageSize.oriWidth * min_size;
		obj.height = width / PageSize.oriWidth * min_size;
	}
		
	obj.css("top" , top * PageSize.windowWidth / PageSize.oriWidth);
	obj.css("left" , left * PageSize.windowWidth / PageSize.oriWidth);
	obj.css("width" , width * PageSize.windowWidth / PageSize.oriWidth);
	obj.css("height" , height * PageSize.windowWidth / PageSize.oriWidth);
}

PageSize.SetSizeFullScreen = function(obj,top,left,width,height){
	if(top == null){
		obj.css("display","none");
		return;
	}

	obj.top = top / PageSize.oriHeight * PageSize.windowHeight;
	obj.left = left / PageSize.oriWidth * PageSize.windowWidth;
	
	if(height != null){
		obj.width = width / PageSize.oriWidth * PageSize.windowWidth;
		obj.height = height / PageSize.oriHeight * PageSize.windowHeight;
	}
	if(height == null && width !=null){
		obj.width = width / PageSize.oriWidth * min_size;
		obj.height = width / PageSize.oriWidth * min_size;
	}
		
	obj.css("top" , top * PageSize.windowHeight / PageSize.oriHeight);
	obj.css("left" , left * PageSize.windowWidth / PageSize.oriWidth);
	obj.css("width" , width * PageSize.windowWidth / PageSize.oriWidth);
	obj.css("height" , height * PageSize.windowHeight / PageSize.oriHeight);
}

PageSize.OffsetTopFullScreen = function(top){
	return top * PageSize.windowHeight / PageSize.oriHeight;
}
PageSize.OffsetLeftFullScreen = function(left){
	return left * PageSize.windowWidth / PageSize.oriWidth;
}
PageSize.OffsetwidthFullScreen = function(width){
	return width * PageSize.windowWidth / PageSize.oriWidth;
}
PageSize.OffsetheightFullScreen = function(height){
	return height * PageSize.windowWidth / PageSize.oriHeight;
}

/*window.onresize = function(){
	if($(window).width() < PageSize.windowHeight)
	{
		if(PageSize.windowHeight == -1)
		{
			PageSize.windowHeight = $(window).height();
			PageSize.windowWidth = $(window).width();
		}
	}生活和生活上计算机很多很多都都很少见呼呼呼的睡大觉，茫茫露露的一天其实挺愉快的，干完该干事情，
}*/


PageSize.oriHeight =1008;
PageSize.oriWidth = 640;
PageSize.windowHeight = $(window).height();
PageSize.windowWidth = $(window).width();