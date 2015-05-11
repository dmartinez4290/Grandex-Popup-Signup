jQuery(document).ready(function($){  
    
    var cookieVal = $.cookie("cookieValue"); 
    var cookieValue = parseInt(cookieVal,10);

    if (cookieVal > 0) {
        	cookieVal++;
        	cookieValue++;
       		$.cookie("cookieValue", cookieValue, { expires: 7 , path: '/' }); 
       		console.log(cookieVal);		
    }

    if(cookieVal==3){
    	$.magnificPopup.open({
    		items:{
    			src:'#test-popup',
    			type:'inline'
    		}
    	});
    }

    if( cookieVal === undefined ) { 
        $.cookie( 'cookieValue', '1',  { expires: 7, path: '/' } ); 
        cookieVal = 1;  
		console.log(cookieVal);
    }

    $('#formsubmit').click(function(){
    	cookieVal = 4;
    	cookieValue=4;
       	$.cookie("cookieValue", cookieValue, { expires: 7 , path: '/' }); 
    	console.log(cookieVal);
	    var dataString = $("input#emailfield").val();
	    
	    $.magnificPopup.close();
        //var urlfield =  '<?= admin_url( 'admin-ajax.php' ) ?>';

	    $.ajax({

	        type: "post",
	        dataType: "json",
	        data : {action: "mailchimp_int", emailfield : dataString },
	        url: update.ajaxurl,
	        success: function(data)
	        {   

	        }
	    });
    });

});
