var app = {
	keys : {
		ESC: 27
	},
	// CSS support test: http://javascript.nwbox.com/CSSSupport/
	CSS : (function(global) {
	
		var sheet, style,
		doc = global.document,
		root = doc.documentElement,
		head = root.getElementsByTagName('head')[0] || root,
		impl = doc.implementation || { hasFeature: function() { return false; } },
		style = doc.createElement("style");
		
		style.type = 'text/css';
	
		head.insertBefore(style, head.firstChild);
		sheet = style.sheet || style.styleSheet;
		
		var toCamelCase = function(p) {
			if (p == 'float') {
				return 'styleFloat' in root.style ? 'styleFloat' :
					'cssFloat' in root.style ? 'cssFloat' : p;
			}
			return p.replace(/-([a-z])/g,
				function(m, c) {
					return c.toUpperCase();
				}
			);
		};
	
		return {
	
			supportAtRule: impl.hasFeature('CSS2', '') ?
				function(rule) {
					if (!(sheet && rule)) return false;
					var result = false;
					try {
						sheet.insertRule(rule, 0);
						result = !(/unknown/i).test(sheet.cssRules[0].cssText);
						sheet.deleteRule(sheet.cssRules.length - 1);
					} catch(e) { }
					return result;
				} :
				function(rule) {
					if (!(sheet && rule)) return false;
					sheet.cssText = rule;
					return sheet.cssText.length !== 0 &&
						!(/unknown/i).test(sheet.cssText) &&
						sheet.cssText.replace(/\r+|\n+/g, '').
							indexOf(rule.split(' ')[0]) === 0;
				},
	
			supportMediaQuery: impl.hasFeature('CSS2', '') ?
				function(media) {
					if (!(sheet && media)) return false;
					var result = false;
					try {
						sheet.insertRule(media, 0);
						result = !(/unknown/i).test(sheet.cssRules[0].cssText);
						sheet.deleteRule(sheet.cssRules.length - 1);
					} catch(e) { }
					return result;
				} :
				function(media) {
					if (!(sheet && media)) return false;
					sheet.cssText = media;
					return sheet.cssText.length !== 0 &&
						!(/unknown/i).test(sheet.cssText) &&
						sheet.cssText.replace(/\r+|\n+/g, '').
							indexOf(media.split(' ')[0]) === 0;
				},
	
			supportSelector: impl.hasFeature('CSS2', '') ?
				function(selector) {
					if (!(sheet && selector)) return false;
					try {
						sheet.insertRule(selector + '{ }', 0);
						sheet.deleteRule(sheet.cssRules.length - 1);
					} catch(e) { return false; }
					return true;
				} :
				function(selector) {
					if (!(sheet && selector)) return false;
					sheet.cssText = selector + ' { }';
					return sheet.cssText.length !== 0 &&
						!(/unknown/i).test(sheet.cssText) &&
						sheet.cssText.indexOf(selector) === 0;
				},
	
			supportProperty: impl.hasFeature('CSS2', '') ?
				function(property, value) {
					if (!property) return false;
					var result = false, prop = toCamelCase(property);
					if (!value && prop in root.style) {
						return typeof root.style[prop] == 'string';
					} else {
						if (!(sheet)) return false;
						try {
							sheet.insertRule('WRONG { ' + property + ': auto; }', 0);
							result = sheet.cssRules[0].cssText.
								match(/{\s*(.*)\s*}/)[1].length !== 0;
							sheet.deleteRule(sheet.cssRules.length - 1);
						} catch(e) { }
					}
					return result;
				} :
				function(property, value) {
					if (!(property && sheet)) return false;
					var name = toCamelCase(property);
					if (value) {
						sheet.addRule('div', property + ': ' + value + ';');
						return sheet.cssText.indexOf(property.toUpperCase()) > - 1;
	                }
					return name in root.style &&
						typeof root.style[name] == 'string' ||
						typeof root.style[name] == 'number';
				}
		};
	})(this),
	supportPlaceholder: function() {
	  var i = document.createElement('input');
	  return 'placeholder' in i;
	}(),
	
	// Analytics tracking helpers
	trackPageview: function(url) {		
		if(!!(_gaq && _gaq.push)) {
			var url = url || window.location.pathname;
			_gaq.push(['_trackPageview', url]);
		}
		
		return this;
	},
	trackEvent: function(action, label) {
		if(!!(_gaq && _gaq.push)) {
			var category = window.location.pathname;
			_gaq.push(['_trackEvent', category, action, label]);
		}
		
		return this;
	}
};

// just to make things a little more readable
jQuery.fn.isPresent = function() {
  return this.length > 0;
};

// from http://api.jquery.com/jQuery.getScript/
jQuery.cachedScript = function(url, options) {

  // allow user to set any option except for dataType, cache, and url
  options = $.extend(options || {}, {
    dataType: "script",
    cache: true,
    url: url
  });

  // Use $.ajax() since it is more flexible than $.getScript
  // Return the jqXHR object so we can chain callbacks
  return jQuery.ajax(options);
};

(function(){
	
	$(window).bind('popstate', function(evt) {
		var originalEvent = evt.originalEvent;
		if(originalEvent && originalEvent.state && originalEvent.state.pjax) {
			app.trackPageview().trackEvent('pjax', 'pop');
			
			$('pre').addClass('prettyprint');
			prettyPrint();
		}
	});
	
	/* pjax inline loading */
	var $pjaxWrapper = $('.pjax-wrapper');
	if($pjaxWrapper.isPresent()) {
		
		var $previousAndNext = $('.single a[rel=prev], .single a[rel=next]'),
			doPjaxTransition = 'onwebkittransitionend' in window; /* only webkit for now */
	
		/*$previousAndNext.pjax('.pjax-wrapper', {
			timeout: 5000,
			error: function() {
				$pjaxWrapper.trigger('pjax:error');
			}
		});*/
	
		$pjaxWrapper.on('click', '.single a[rel=prev], .single a[rel=next]', function(evt) {
			var $el = $(this),
				transitionDfd = $.Deferred(),
				pjaxDfd = $.Deferred();
				
			evt.preventDefault();

			// finish transitioning, only webkit for now
			// Firefox didn't transition 'left'
			// Opera transitioned, but didn't bring next/previous article in from opposite side
		
			if (doPjaxTransition) {
			
				if($el.is('[rel=prev]')) {
					$pjaxWrapper.addClass('goto-previous');
				} else {
					$pjaxWrapper.addClass('goto-next');			
				}
			
				$pjaxWrapper.bind('webkitTransitionEnd', function() {
					transitionDfd.resolve();
				});
			} else {
				$pjaxWrapper.css('visibility','hidden');
				transitionDfd.resolve();
			}
			
			$.when(transitionDfd).then(function() {
				$.pjax({
				  url: $el.attr('href'),
				  container: $pjaxWrapper,
					timeout: 5000,
					error: function() {
						$pjaxWrapper.trigger('pjax:error');
					}
				})
			});
	
			// finish loading content
			$pjaxWrapper.bind('pjax:end', function() {
				pjaxDfd.resolve();
				app.trackEvent('pjax', 'loaded');
			});
		
			// error loading
			$pjaxWrapper.bind('pjax:error', function() {
				pjaxDfd.reject();
				app.trackEvent('pjax', 'error');
			});
	
			$.when(pjaxDfd, transitionDfd).then(bringNew, bringBack);
	
			function bringNew() {
				cleanUp();
				
				$('pre').addClass('prettyprint');
				prettyPrint();
				
				if (doPjaxTransition) {
					$pjaxWrapper.addClass('switch');
					setTimeout(function() {
						$pjaxWrapper.removeClass('switch goto-previous goto-next');
					}, 100);
				} else {
					$pjaxWrapper.css('visibility','visible');
				}
			}
		
			// pjax error, load new URL as normal
			function bringBack() {
				cleanUp();
				window.location = $el.attr('href');
				//$pjaxWrapper.removeClass('switch goto-previous goto-next');
			}
			
			function cleanUp() {
				$pjaxWrapper.unbind('pjax:error pjax:end');
			}
			
		});
	}
	
	/* Code highlighting */
	$('pre').addClass('prettyprint');
	$.cachedScript('/js/prettify.js', 
		{success: function() {
			prettyPrint();
		}
	});
	
	/* Check for nth-of-type */
	var articleBreak = 4;
	if(!app.CSS.supportSelector(':nth-of-type('+articleBreak+'n+1)')) {
		(function(articles) {
			if(articles.length > articleBreak) {
				articles.each(function(i) {
					if(i % articleBreak == 0) {
						$(this).css('clear','left');
					}
				});
			}	
		}($('.listing article')));	
	}
	
	/* Comment box modal */
	(function($body) {
		$body.on('click', 'a.respond', function(evt) {
			var $respond = $('#respond');
			evt.preventDefault();
			
			if(!app.supportPlaceholder) {
				$respond.addClass('no-placeholder');
			}
			
			$respond.addClass('intermediate');
			setTimeout(function() {
				$respond.addClass('active');
			}, 50);
			
			$respond.find('input.text').first().focus();
			$respond.find('a.close').click(function(evt) {
				evt.preventDefault();
				close();
			});
			
			$respond.find('form').submit(function(evt) {
				close();
			});
			
			$body.keyup(function(evt) {
				if(evt.keyCode === app.keys.ESC) {
					close();
				}
			});
			
			function close() {
				$respond.addClass('minimise')
				$respond.removeClass('active');
				setTimeout(function() {
					$respond.removeClass('intermediate minimise');
				}, 550);
				$body.unbind('keyup');
				$respond.find('a.close').unbind('click');
			}
			
		});
		
	}($('body')));
})();