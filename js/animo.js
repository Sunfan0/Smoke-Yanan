;(function ( $, window, document, undefined ) {

  /**
   * animo is a powerful little tool that makes managing CSS animations extremely easy. Stack animations, set callbacks, make magic.
   * Modern browsers and almost all mobile browsers support CSS animations (http://caniuse.com/css-animation).
   *
   * @author Daniel Raftery : twitter/ThrivingKings
   * @version 1.0.3
  */
  function animo( element, options, callback, other_cb ) {
    
    // 默认的配置
    var defaults = {
    	duration: 1,
    	animation: null,
    	iterate: 1,
    	delay: 0,
    	timing: "linear",
    	keep: false
    };

    // 浏览器前缀的CSS
    this.prefixes = ["", "-moz-", "-o-animation-", "-webkit-"];

    // 缓存的元素
    this.element = $(element);

    this.bare = element;

    // 用于堆积动画
    this.queue = [];

    // Hacky
    this.listening = false;

    // 判断callback是否是一个函数，是：返回callback ；否：返回other_cb
    var cb = (typeof callback == "function" ? callback : other_cb);

    // 元素所对应的动画样式
    switch(options) {
      case "blur":

      	defaults = {
      		amount: 3,
      		duration: 0.5,
      		focusAfter: null
      	};
		// extend(result,item1,item2…..) 将所有的参数项都合并result中，并返回result
      	this.options = $.extend( defaults, callback );

  	    this._blur(cb);

        break;

      case "focus":

  	  	this._focus();

        break;

      case "rotate":

        defaults = {
          degrees: 15,
          duration: 0.5
        };

        this.options = $.extend( defaults, callback );

        this._rotate(cb);

        break;

      case "cleanse":

        this.cleanse();

        break;

      default:

	    this.options = $.extend( defaults, options );

	    this.init(cb);
  	
      break;
    }
  }

  // 对animo类的prototype对象进行修改 (prototype表示类的属性集合)
  animo.prototype = {

	// init: function(callback){}--javascript中定义伪类的方法,init是类方法 
	// init可以当作是该插件中的一个属性，这个属性值是一个方法，该方法需要传入1个参数：callback，
    init: function(callback) {
      
      var $me = this;

      //是否为堆叠动画--判断$me.options.animation对象值是否为object Array内置类型
      if(Object.prototype.toString.call( $me.options.animation ) === '[object Array]') {
		// merge(first,second) 第二个数组合并到第一个
      	$.merge($me.queue, $me.options.animation);
      } else {
	      $me.queue.push($me.options.animation);
	    }

	    $me.cleanse();

	    $me.animate(callback);
      
    },

    animate: function(callback) {

		this.element.addClass('animated');

		this.element.addClass(this.queue[0]);

		this.element.data("animo", this.queue[0]);

		var ai = this.prefixes.length;

      // 为每个属性添加添加值
      while(ai--) {

      	this.element.css(this.prefixes[ai]+"animation-duration", this.options.duration+"s");
        
      	this.element.css(this.prefixes[ai]+"animation-delay", this.options.delay+"s");

      	this.element.css(this.prefixes[ai]+"animation-iteration-count", this.options.iterate);

      	this.element.css(this.prefixes[ai]+"animation-timing-function", this.options.timing);
		
      }

		var $me = this, _cb = callback;

		if($me.queue.length>1) {
			_cb = null;
      }

      // Listen for the end of the animation
      this._end("AnimationEnd", function() {

        // If there are more, clean it up and move on 
        if($me.element.hasClass($me.queue[0])) {

          if(!$me.options.keep) {
            $me.cleanse();
          }

          $me.queue.shift();

          if($me.queue.length) {

            $me.animate(callback);
          }
        }
      }, _cb);
    },

    cleanse: function() {

    	this.element.removeClass('animated');

  		this.element.removeClass(this.queue[0]);

      this.element.removeClass(this.element.data("animo"));

  		var ai = this.prefixes.length;

  		while(ai--) {

      	this.element.css(this.prefixes[ai]+"animation-duration", "");
        
      	this.element.css(this.prefixes[ai]+"animation-delay", "");

      	this.element.css(this.prefixes[ai]+"animation-iteration-count", "");

      	this.element.css(this.prefixes[ai]+"animation-timing-function", "");

        this.element.css(this.prefixes[ai]+"transition", "");

        this.element.css(this.prefixes[ai]+"transform", "");

        this.element.css(this.prefixes[ai]+"filter", "");

      }
    },

    _blur: function(callback) {

      if(this.element.is("img")) {

      	var svg_id = "svg_" + (((1 + Math.random()) * 0x1000000) | 0).toString(16).substring(1);
      	var filter_id = "filter_" + (((1 + Math.random()) * 0x1000000) | 0).toString(16).substring(1);

      	$('body').append('<svg version="1.1" xmlns="http://www.w3.org/2000/svg" id="'+svg_id+'" style="height:0;position:absolute;top:-1000px;"><filter id="'+filter_id+'"><feGaussianBlur stdDeviation="'+this.options.amount+'" /></filter></svg>');

      	var ai = this.prefixes.length;

    		while(ai--) {

        	this.element.css(this.prefixes[ai]+"filter", "blur("+this.options.amount+"px)");

        	this.element.css(this.prefixes[ai]+"transition", this.options.duration+"s all linear");

        }

        this.element.css("filter", "url(#"+filter_id+")");

        this.element.data("svgid", svg_id);
      
      } else {

        var color = this.element.css('color');

        var ai = this.prefixes.length;

        // Add the options for each prefix
        while(ai--) {

          this.element.css(this.prefixes[ai]+"transition", "all "+this.options.duration+"s linear");

        }

        this.element.css("text-shadow", "0 0 "+this.options.amount+"px "+color);
        this.element.css("color", "transparent");
      }

      this._end("TransitionEnd", null, callback);

      var $me = this;

      if(this.options.focusAfter) {

        var focus_wait = window.setTimeout(function() {

          $me._focus();

          focus_wait = window.clearTimeout(focus_wait);

        }, (this.options.focusAfter*1000));
      }

    },

    _focus: function() {

    	var ai = this.prefixes.length;

      if(this.element.is("img")) {

    		while(ai--) {

        	this.element.css(this.prefixes[ai]+"filter", "");

        	this.element.css(this.prefixes[ai]+"transition", "");

        }

        var $svg = $('#'+this.element.data('svgid'));

        $svg.remove();
      } else {

        while(ai--) {

          this.element.css(this.prefixes[ai]+"transition", "");

        }

        this.element.css("text-shadow", "");
        this.element.css("color", "");
      }
    },

    _rotate: function(callback) {

      var ai = this.prefixes.length;

      // Add the options for each prefix 为每个前缀添加options
      while(ai--) {

        this.element.css(this.prefixes[ai]+"transition", "all "+this.options.duration+"s linear");

        this.element.css(this.prefixes[ai]+"transform", "rotate("+this.options.degrees+"deg)");

      }

      this._end("TransitionEnd", null, callback);

    },

    _end: function(type, todo, callback) {

      var $me = this;

      var binding = type.toLowerCase()+" webkit"+type+" o"+type+" MS"+type;

      this.element.bind(binding, function() {
        
        $me.element.unbind(binding);

        if(typeof todo == "function") {

          todo();
        }

        if(typeof callback == "function") {

          callback($me);
        }
      });
      
    }
  };
	
	// jQuery为开发插件提拱了两个方法，分别是： 
	// jQuery.extend(object);为扩展jQuery类本身.为类添加新的方法。 
	// jQuery.fn.extend(object);给jQuery对象添加方法。
	
	// $.fn.animo()是对jquery扩展了一个animo方法
  $.fn.animo = function ( options, callback, other_cb ) {
  
    // each() 方法规定为每个匹配元素规定运行的函数
    return this.each(function() {
			
			new animo( this, options, callback, other_cb );

		});

  };

})( jQuery, window, document );
