var Ajax = (function() {

	var queue = [];
	var inProgress = false;
	var csrfHeader = '';
	var csrfToken = '';
	
	function _htmlentities(string)
	{
	    return $('<div />').text(string).html();
	}
	
	function _debug(method, message) {
	    if (typeof(console) != 'undefined') {
	        //console.log('AJAX', method,  message);
	    }
	}
	
	function _errorHandling(jqXHR, textStatus, errorThrown) {
		var textTitle = 'Erreur';
	    var traceid = '';
	    var debug = '';
	    var json = '';
	    var textStatus = '';
	    var errorThrown = '';
	    /*
	    switch(jqXHR.status) {
	        case 400:
	        case 401:
	        case 403:
	        case 404:
	        case 409:
	        case 418:
	        case 500:
	        case 503:*/
	            try {
	                json = $.parseJSON(jqXHR.responseText);
	                if (json.erreur) {
	                    if (json.erreur.title != undefined) {
	                        //gf_debug('ZACK/message=' + json.erreur.message);    
	                        textTitle = json.erreur.title;
	                    }
	                    
	                    if (json.erreur.message != undefined) {
	                        //gf_debug('ZACK/message=' + json.erreur.message);    
	                        textStatus = json.erreur.message;
	                        errorThrown = '';
	                    }
	                     
	                    if (json.erreur.detail != undefined) {
	                        //gf_debug('ZACK/detail=' + json.erreur.detail);    
	                        errorThrown = json.erreur.detail;
	                    }
	                     
	                    //if ((jqXHR.status >= 500) && (json.erreur.traceid != undefined)) {
	                        //gf_debug('ZACK/traceid=' + json.erreur.traceid);    
	                        traceid = json.erreur.traceid;
	                    //}
	                     
	                    if (json.erreur.debug != undefined) {
	                        //gf_debug('ZACK/debug=' + json.erreur.debug);    
	                        debug = json.erreur.debug;
	                    }
	                }
	            } catch (err) {
	                //
	            }
	    /*        
	            break;
	    }*/

	    bootbox.dialog({
	    	title: textTitle,
	    	message: '<div>'
	            + '<span class="gs_dlg_warn">' + _htmlentities(textStatus) + '</span>'
	            + (((errorThrown != '') && (errorThrown != textStatus))?'<hr /><span class="gs_dlg_warn">' + _htmlentities(errorThrown) + '</span>':'')
	            + (traceid != ''?'<br /><br />Id Trace : <span class="gs_dlg_warn">' + _htmlentities(traceid) + '</span>':'')
	            + (debug != ''?'<br /><br />Debug : <span class="gs_dlg_warn">' + _htmlentities(debug) + '</span>':'')
	            + '</div>',
	    	buttons: {
	    	    main: {
	    	        label: "Ok",
	    	        className: "btn-primary",
	    	        callback: function() {
	    	          //Example.show("Primary button");
	    	        }
	    	      }
	    	}
	    });
	}
	
	function _silent(ajaxQuery) {
		//_debug('_now()', ajaxQuery);
		return $.ajax(ajaxQuery);
	}	
	
	function _now(ajaxQuery) {
		if(ajaxQuery.csrf) {
			ajaxQuery['headers'] = ajaxQuery['headers'] || {};
			ajaxQuery['headers'][csrfHeader] = csrfToken;
		}

		//_debug('_now()', ajaxQuery);
		
		var a = $.ajax(ajaxQuery).done(_updateCsrfToken);
		
		if(!ajaxQuery.noFail) {
			a.fail(_errorHandling)
		}

		return a;
	}
	
	function _modal(ajaxQuery) {
		IHM.displayLoader();
		return _now(ajaxQuery).always(IHM.removeLoader);
	}
	
	function _later(ajaxQuery) {
		//_debug('_later()', ajaxQuery);
		queue.push(ajaxQuery)
		_next();
	}
	
	function _next() {
		if(queue.length == 0) {
			return;
		}
		
		if(inProgress) {
			return;
		}
		
		inProgress = true;
		
		var ajaxQuery = queue.shift();
		
		_now(ajaxQuery).always(_complete);
	}
	
	function _complete() {
		inProgress = false;
		_next();
	}
	
	function _updateCsrfToken(data, textStatus, jqXHR) {
		var newToken = jqXHR.getResponseHeader(csrfHeader);
		if(newToken !== null) {
			csrfToken = newToken;
		}
	}
	
    return {
    	later : _later,
    	now : _now,
    	modal : _modal,
    	silent : _silent,
    	setCsrfHeader : function(value){csrfHeader = value;},
    	setCsrfToken : function(value){csrfToken = value;}
    };

})();
