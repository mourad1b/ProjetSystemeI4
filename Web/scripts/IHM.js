var IHM = (function() {

	var _blinkVisibleTime = 2000;
	var _blinkHiddenTime = 500;
	
	function _init() {
		 bootbox.setDefaults({locale: "fr"});
		
		// Creation auto de tooltip sur certain elements
		$('.isRefresh')
			.addClass('hasTooltip')
			.attr('title', 'Rafraichir la liste')
			.attr('data-placement', 'left');
		
		// Initialiser les tooltips
        $('body').tooltip({
            selector : ".hasTooltip"
        });
        
        // Initialiser les popovers
        $('body').popover({
            selector : ".hasPopover",
            trigger : "hover",
            html : true
        });
        
        // conserver la class "modal-open" quand il y en a plusieurs d'ouverte
    	$(document).on('hidden.bs.modal', '.modal', function () {
    		if($('.modal:visible').length != 0) {
    			$('body').addClass('modal-open');
    		}
    	});         
        
        //
       // _getFlashMessage();
	};
	
	function _getFlashMessage() {
		var url = gecko.urlJson + "/paramsjson/";
		
    	Ajax.now({
            url : url + "flashmessage"
        })
        .done(function(data) {
        	var displayMessage = false;
        	var messageText = '';
        	var messageClass = 'danger';
        	
        	for(var i=0;i<data.length;i++) {
        		switch(data[i]['name']) {
					case 'ALERTE.DATEFIN':
						var dateFin = new Date(data[i]['value']);
						dateFin.setHours(23);
						dateFin.setMinutes(59);
						
						var today = new Date();
						
						if(dateFin > today) {
							displayMessage = true;
						}
						
						break;
					case 'ALERTE.LEVEL':
						messageClass = data[i]['value'];
						
						break;
					case 'ALERTE.MESSAGE':
						messageText = data[i]['value'];
						
						if(messageText == '') {
							displayMessage = false;
						}
						
						break;
        		}
        	}
        	
        	if(displayMessage) {
        		$('#flashMessage').hide().removeClass('hidden').addClass('alert-' + messageClass).html(messageText).slideDown();
        	}
        });
	}
	
	function _blinkStart() {
		//$('#flashMessage')
		_blinkShow();
	};

	function _blinkShow() {
		$('#flashMessage').css("opacity", 1);
		setTimeout(_blinkHide, _blinkVisibleTime);
	}
	
	function _blinkHide() {
		$('#flashMessage').css("opacity", 0);
		setTimeout(_blinkShow, _blinkHiddenTime);
	}
	
	function _confirm(message, callback, callbackParams) {
		bootbox.confirm(
            {             
                message: message,
                callback: function(result) {        
                    if(result) {
                    	callback.apply(this, callbackParams);
                    }
                    
                    return true;
                },
                buttons: {
                    "cancel":{
                        label:"Non",
                        className: "btn btn-default"
                    },
                    "confirm":{
                        label:"Continuer",
                        className: "btn btn-primary"
                    }
                }
            }
        );  
	}; 
	
    return {

    	blinkStart: _blinkStart,
    	confirm: _confirm,
        init : _init,

        // Affiche l'overlay de chargement
        displayLoader : function() {
            $('#loader').removeClass('loaderHidden').addClass('loaderVisible');
        },

        // Masque l'overlay de chargement
        removeLoader : function() {
            $('#loader').removeClass('loaderVisible').addClass('loaderHidden');
        },

        // Active ou pas le bouton "valider" lors de l'edition
        validateModal : function() {
        	
        	var mustBeDisabled = false;

            $('.modalRequired').each(function( index ) {
            	val = $( this ).val();
            	
            	$(this).parent().removeClass('has-warning').removeClass('has-feedback').find('.glyphicon').hide();
            	
            	if (val == null || val.length == 0) {
            	    $(this).parent().addClass('has-warning').addClass('has-feedback').find('.glyphicon').show();
            		mustBeDisabled = true;
            	}
            });
            
            if (mustBeDisabled) {
            	$('.modal-footer .buttonValide').attr('disabled', 'disabled');
            }
            else{
            	$('.modal-footer .buttonValide').removeAttr('disabled');
            }
            
            return mustBeDisabled;
        },        

        //
        popup : function(url, title, w, h) {
        	var ie = isIE();
        	if (ie && ie < 9) {
        		title = title.replace(" ", "_"); ;
        	}
            // Fixes dual-screen position
            var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
            var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

            width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
            height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

            var left = ((width / 2) - (w / 2)) + dualScreenLeft;
            var top = ((height / 2) - (h / 2)) + dualScreenTop;
            var newWindow = window.open(url, 'test', 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
            //var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
            // Puts focus on the newWindow
            if (window.focus) {
                newWindow.focus();
            }
        }
    };

})();

$(document).ready(IHM.init);
