/*
		* jQuery easing functions (for this demo)
		*/
		jQuery.extend( jQuery.easing,{
			def: 'easeOutQuad',
			swing: function (x, t, b, c, d) {
				//alert(jQuery.easing.default);
				return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
			},
			easeInQuad: function (x, t, b, c, d) {
				return c*(t/=d)*t + b;
			},
			easeOutQuad: function (x, t, b, c, d) {
				return -c *(t/=d)*(t-2) + b;
			},
			easeInOutQuad: function (x, t, b, c, d) {
				if ((t/=d/2) < 1) return c/2*t*t + b;
				return -c/2 * ((--t)*(t-2) - 1) + b;
			},
			easeOutElastic: function (x, t, b, c, d) {
				var s=1.70158;var p=0;var a=c;
				if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
				if (a < Math.abs(c)) { a=c; var s=p/4; }
				else var s = p/(2*Math.PI) * Math.asin (c/a);
				return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
			},
			easeInOutElastic: function (x, t, b, c, d) {
				var s=1.70158;var p=0;var a=c;
				if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
				if (a < Math.abs(c)) { a=c; var s=p/4; }
				else var s = p/(2*Math.PI) * Math.asin (c/a);
				if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
				return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
			},
			easeInBack: function (x, t, b, c, d, s) {
				if (s == undefined) s = 1.70158;
				return c*(t/=d)*t*((s+1)*t - s) + b;
			},
			easeOutBack: function (x, t, b, c, d, s) {
				if (s == undefined) s = 1.70158;
				return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
			},
			easeInOutBack: function (x, t, b, c, d, s) {
				if (s == undefined) s = 1.70158; 
				if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
				return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
			}
		});
		
		// init the pluging and bind it to the #menu element
		$('.menu').stickyfloat();
		$('.menu2').stickyfloat('update',{ duration:0 });
		
		/* binds for this demo only
		------------------------------------------------------*/
		$('.menu').on('click', 'button', function(){
			var elem = $(this).parents('.menu');
			elem.stickyfloat('update', { easing:this.innerHTML });
		});
		
		$('.menu input').on('change', function(){
			var elem = $(this).parents('.menu'),
				prop = this.className,
				value = this.value,
				options = {};

			if( (value|0) === parseInt(value) ) // if number, normalize
				value = value|0;

			options[prop] = value;
			elem.stickyfloat('update', options);
		});
		
		// after page refresh, make sure the values are returned to their defaults
		$('.menu :text').each(function(){
			$(this).val(this.defaultValue);
		});
		
		$('.menu :checkbox').on('change', function(){
			var elem = $(this).parents('.menu'),
				prop = this.className,
				options = {};

			options[prop] = this.checked ? true : false;
			elem.stickyfloat('update', options);
		});

		$('.menu .cssTransition:checkbox').on('change', function(){
			var elem = $(this).parents('.menu'),
				val = this.checked ? 0 : elem.find('.duration').val();
			
			elem.toggleClass('transition200');
			elem.stickyfloat('update',{cssTransition: this.checked});
		});
		
		$('.menu :checkbox').each(function(){
			$(this).prop('checked', this.defaultChecked);
		});