var PageSize = {};

PageSize.min_size = -1;

if($(window).width() < PageSize.windowHeight){
	if(PageSize.windowHeight == -1){
			windowHeight = $(window).height();
			windowWidth = $(window).width();
	}
}

PageSize.oriHeight =1008;
PageSize.oriWidth = 640;
PageSize.windowHeight = $(window).height();
PageSize.windowWidth = $(window).width();

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
	}
}*/

$(document).ready(function(){
	$(".fullScreen").each(function(){
		PageSize.SetSizeFullScreen($("#"+$(this).attr("id")),0,0,PageSize.oriWidth,PageSize.oriHeight);
	});
});

$(window).resize(function() {
	$(".fullScreen").each(function(){
		PageSize.SetSizeFullScreen($("#"+$(this).attr("id")),0,0,PageSize.oriWidth,PageSize.oriHeight);
	});
	if(typeof window.InitSize == 'function') {
		InitSize();
	};
});
