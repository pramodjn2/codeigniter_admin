// JavaScript Document
var jobj = '';
var f_id = '';
var formId = '';
/* to save and validate the from using ajax submit
message class
message
message dynamic id base message show
message fade out
from reset
page reload 
page redirect
model close
after page redirect message
hide div
show div
*/

var message = '';  //message
var message_class = '';//message class
var message_div_id = 'message'; //message dynamic id base message show
var message_fade_out = 0;  //message fade out
var redirect_message = 0;  //after page redirect message
var form_reset = 0;  //from reset
var model_id = '';  //model close
var hide_div = '';  //hide div
var show_div = '';  //show div
var form_id = ''; //from id
var url_full = 0; //full url not inclide in base url
var tab_id = ''; //tab id


function ajaxSaveForm(fid,message_id){
	
	if(typeof message_id  === 'undefined' || !message_id){
		message_id = message_div_id;
	};
	
  message_div_id = message_id;
  formId = fid;

  var loader = jQuery('<div></div>').css({
    position: "relative",
    top: "1em",
    left: "25em"
  }).appendTo("body").hide();

  jQuery().ajaxStart(function() {
    jQuery('#'+message_div_id).html('<div class="sucMsg">Please wait while loading content <img src="' + base_url + 'assets/images/loading.gif" border="0" /></div>').show();
   jQuery(':submit').prop('disabled', true);

  }).ajaxStop(function() {
      loader.hide();
  }).ajaxError(function(a, b, e) {
    throw e;
  });


  var v = jQuery("#"+formId).validate({
    submitHandler: function(form) {
      jQuery(form).ajaxSubmit({
        success: showResponseFunction
      });

      jQuery('#'+message_div_id).html(' ');
      jQuery('#'+message_div_id).html('<div><img src="' + base_url + 'assets/images/loading-small.gif" border="0" /><br/>Please wait while loading content.</div>').show();
     // jQuery('input[type="submit"]').prop('disabled', true);
	 jQuery(':submit').prop('disabled', true);
      return false;
    }
  });

  //To reset the form
  jQuery("#reset").click(function() {
    v.resetForm();
  });
}


function showResponseFunction(responseText, statusText, xhr, $form){
	//alert(responseText+'---'+statusText+'---'+xhr+'---'+$form);
	//console.log(responseText);
  jQuery('#'+message_div_id).html(' '); 
  jQuery(':submit').prop('disabled', false);
  jobj = eval(responseText);

  if(jobj[0].message) {
       message = jobj[0].message;
    }
	
	if(jobj[0].redirect_message) {
       redirect_message = jobj[0].redirect_message;
    }
	if(jobj[0].url_full) {
       url_full = jobj[0].url_full;
    }
	
	
  if(jobj[0].redirect) {
	    if(parseFloat(redirect_message) == 1){
			if(parseFloat(url_full) == 1){
				jQuery(location).attr('href', jobj[0].redirect +'/?msg='+message);
			 }else{
				jQuery(location).attr('href', base_url + jobj[0].redirect +'/?msg='+message);
			 }
		}else{
			if(parseFloat(url_full) == 1){
				jQuery(location).attr('href', jobj[0].redirect);	
			}else{
				jQuery(location).attr('href', base_url + jobj[0].redirect);	
			}
		}
  }else{
    
	if(jobj[0].message_div_id) {
       message_div_id = jobj[0].message_div_id;
    }
	
	if (jobj[0].message_class) {
      message_class = jobj[0].message_class;
    }
	
	if(jobj[0].message_fade_out) {
       message_fade_out = jobj[0].message_fade_out;
    }
	
	if(jobj[0].show_div) {
       show_div = jobj[0].show_div;
    }
	
	if(jobj[0].hide_div) {
       hide_div = jobj[0].hide_div;
    }
	
	if (jobj[0].model_id) {
      model_id = jobj[0].model_id;
    }
    if (jobj[0].form_reset) {
      form_reset = jobj[0].form_reset;
    }
	
	if (jobj[0].form_id) {
      form_id = jobj[0].form_id;
    }
	
	if (jobj[0].tab_id) {
      tab_id = jobj[0].tab_id;
    }
	
   showMessageFunction(message, message_div_id, message_class, message_fade_out, show_div, hide_div, model_id, form_id, form_reset,tab_id);

  }

}


function showMessageFunction(message, message_div_id, message_class, message_fade_out, show_div, hide_div, model_id,  form_id, form_reset, tab_id){
	//console.log('--'+message_div_id);

  var msg_show = '<div class="'+message_class+'"><a href="" data-dismiss="alert" class="close">X</a>&nbsp;&nbsp;&nbsp;&nbsp;' +message+ '</div>';
 
 // console.log('msg_show');
  //console.log(msg_show); 
  //return false;
  
  // alert(hide_div +'---------'+show_div);
 // jQuery('#'+hide_div).hide();
  //jQuery('#'+show_div).show();
  
  jQuery('#'+message_div_id).html('');
  jQuery('#'+message_div_id).html(msg_show);
  
   if(parseFloat(message_fade_out) == 1){
	  message_fadeout(message_div_id);
	}
  
  if (parseFloat(form_reset) == 1) {
      resetQue(form_id);
  }
  if (model_id != '') {
	  modelClose(model_id);
	 // setTimeout("modelClose(model_id);",100);
  }
  
  if (tab_id != '') {
      tabChange(tab_id);
  }

}

var message_fadeout = function(id) {
  if(typeof id === 'undefined' || !id){
		return false;
  };
  jQuery('#'+id).fadeOut(2500);
}

var resetQue = function(formId) {
  if(typeof formId === 'undefined' || !formId){
		return false;
  };
  jQuery('#'+formId).get(0).reset();
}

var modelClose = function(model_id) {
  if(typeof model_id === 'undefined' || !model_id){
		return false;
	};
  jQuery('#'+model_id).modal('hide');
}

var tabChange = function(tab_id){
	if(typeof tab_id === 'undefined' || !tab_id){
		return false;
	};
	//jQuery("#"+tab_id).trigger( "click" );
	jQuery("#"+tab_id).modal( "show" );
}