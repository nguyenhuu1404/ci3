Function.prototype.pzkImpl = function(props) {
	this.prototype = $.extend(this.prototype || {}, props);
	return this;
};

Function.prototype.pzkExt = function(props) {
	var that = this;
	var func = function() {
		that.apply(this, arguments);
	};
	func.prototype = $.extend({}, this.prototype || {}, props);
	return func;
};

pzk = {
	page : 'index',
	elements : {},
	onloads: {},
	beforeloads: {},
	onload: function(elementId, callback) {
		if(typeof this.onloads[elementId] === 'undefined') {
			this.onloads[elementId] = [];
		}
		this.onloads[elementId].push(callback);
	},
	beforeload: function(elementId, callback) {
		if(typeof this.beforeloads[elementId] === 'undefined') {
			this.beforeloads[elementId] = [];
		}
		this.beforeloads[elementId].push(callback);
	},
	runOnload: function() {
		for(var elementId in this.onloads) {
			var elem = pzk.elements[elementId];
			var onloads = this.onloads[elementId];
			for(var i = 0; i < onloads.length; i++) {
				var callback = onloads[i];
				callback.call(elem);
			}
		}
	},
	load : function(urls, callback, nocache) {
		var loaded = false;
		if (typeof urls == 'string') {
			urls = [ urls ];
		}
		if (typeof nocache == 'undefined')
			nocache = false; // default don't refresh
		$.when($.each(urls, function(i, url) {
			if (nocache)
				url += '?_ts=' + new Date().getTime(); // refresh?
			if (pzk._urls.indexOf(url) == -1) {
				$.ajax({
					url: 		url, 
					async: 		false,
					success: 	function(resp) {
						if (pzk.ext(url) == 'css') {
							$('<link>', {
								rel : 'stylesheet',
								type : 'text/css',
								'href' : url
							}).appendTo('head');
						} else if (pzk.ext(url) == 'js') {
							/*
							$('<script>', {
								type : 'text/javascript',
								'src' : url
							}).appendTo('head');*/
							//eval(resp);
							if(callback)
								callback();
						} else if(pzk.ext(url) == 'json') {
							var json = null;
							eval('json = ' + resp + ';');
							callback(json);
						}
						pzk._urls.push(url);
					}
				});
			}
		})).then(function() {
			
			if (0 && typeof callback == 'function')
				callback();
		});
	},
	ext : function(url) {
		var re = /(?:\.([^.]+))?$/;
		return re.exec(url)[1];
	},
	_urls : [],
	set: function(key, val) {
		window.localStorage.setItem(key, JSON.stringify(val));
		return val;
	},
	get: function(key) {
		var val = null;
		if(null !== (val = window.localStorage.getItem(key))) {
			return JSON.parse(val);
		}
		return null;
	},
	del: function(key) {
		return window.localStorage.delItem(key);
	},
	tmpl: function(selector, template, url, params) {
		$(selector).template(template, url, params);
	},
	alert: function(title, message) {
		var modal = this.getModal();
		modal.find('.modal-title').text(title);
		modal.find('.modal-body').html(message);
		modal.modal('show');
	},
	modal: false,
	getModal: function() {
		if(!this.modal) {
			this.modal = $('<div class="modal fade" tabindex="-1" role="dialog">\
  <div class="modal-dialog" role="document">\
    <div class="modal-content">\
      <div class="modal-header hidden">\
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
        <h4 class="modal-title">Th�ng b�o</h4>\
      </div>\
      <div class="modal-body text-center color1-bold">\
        <p>One fine body&hellip;</p>\
      </div>\
      <div class="modal-footer">\
        <button type="button" class="btn btn-danger" data-dismiss="modal">��ng</button>\
      </div>\
    </div>\
  </div>\
</div>');
			$('body').append(this.modal);
		}
		return this.modal;
	},
	lib: function(lib) {
		pzk.load('/assets/lib/huunv/lib/' + lib + '.js');
	}
};
pzk.lib('string');
pzk.lib('array');
pzk.lib('form');
pzk.lib('browser');
pzk.lib('datetime');
