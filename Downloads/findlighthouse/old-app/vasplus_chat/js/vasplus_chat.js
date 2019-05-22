/********************************************************************************
* Gmail / Facebook Style Chat Application with jQuery and PHP
* Written by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: vasplusblog@gmail.com OR info@vasplus.info

*********************************Copyright Info***********************************
* This is a paid script and must not be sold by any client
* Please do not remove this copyright information from the top of this page
* All Copy Rights Reserved by Vasplus Programming Blog
***********************************************************************************/

// Variable declaration and assignment
var baseURL = 'http://v-yukti.com/usa-school/';
var vpb_c_boxes = new Array();
var vpb_c_users_d = new Array();
var vpb_min_max_box = new Array();
var vpb_original_title_message;
var vpb_timer;
var vpb_active_page;
var vpb_intervals = 15000;
var vpb_c_reader = 0;
var vpb_low_reader = 1000;
var vpb_high_reader = 33000;
var vpb_chat_header_notifications;
var vpb_reader_interval = vpb_low_reader; 
var vpb_esource_browser_supports = window.EventSource && typeof(EventSource)!=="undefined" ? true : false;
var vpb_promised = window.Promise && typeof(Promise)!=="undefined" ? window.Promise : '';
var vpb_cors_browser_supports = vpb_browser_supports_cors() ? true : false;
var browser_is_firefox = !(window.mozInnerScreenX == null) ? 'firefox' : 'nonfirefox';
var vpb_image_dir = '';
var vpb_smiley_dir = '';
function vasplus_special_text(ivtech) { var vpb_new_text = ivtech.replace(/\"/gi,"&quot;");vpb_new_text = vpb_new_text.replace(/\</gi,"&lt;");vpb_new_text = vpb_new_text.replace(/\>/gi,"&gt;");/*vpb_new_text = vpb_new_text.replace(/\ /gi,"&nbsp;");*/vpb_new_text = vpb_new_text.replace(/\¡/gi,"&iexcl;");vpb_new_text = vpb_new_text.replace(/\¢/gi,"&cent;");vpb_new_text = vpb_new_text.replace(/\£/gi,"&pound;");vpb_new_text = vpb_new_text.replace(/\¤/gi,"&curren;");vpb_new_text = vpb_new_text.replace(/\¥/gi,"&yen;");vpb_new_text = vpb_new_text.replace(/\¦/gi,"&brvbar;");vpb_new_text = vpb_new_text.replace(/\§/gi,"&sect;");vpb_new_text = vpb_new_text.replace(/\¨/gi,"&uml;");vpb_new_text = vpb_new_text.replace(/\©/gi,"&copy;");vpb_new_text = vpb_new_text.replace(/\ª/gi,"&ordf;");vpb_new_text = vpb_new_text.replace(/\«/gi,"&laquo;");vpb_new_text = vpb_new_text.replace(/\¬/gi,"&not;");vpb_new_text = vpb_new_text.replace(/\®/gi,"&reg;");vpb_new_text = vpb_new_text.replace(/\°/gi,"&deg;");vpb_new_text = vpb_new_text.replace(/\±/gi,"&plusmn;");vpb_new_text = vpb_new_text.replace(/\²/gi,"&sup2;");vpb_new_text = vpb_new_text.replace(/\³/gi,"&sup3;");vpb_new_text = vpb_new_text.replace(/\´/gi,"&acute;");vpb_new_text = vpb_new_text.replace(/\µ/gi,"&micro;");vpb_new_text = vpb_new_text.replace(/\¶/gi,"&para;");vpb_new_text = vpb_new_text.replace(/\·/gi,"&middot;");vpb_new_text = vpb_new_text.replace(/\¹/gi,"&sup1;");vpb_new_text = vpb_new_text.replace(/\º/gi,"&ordm;");vpb_new_text = vpb_new_text.replace(/\»/gi,"&raquo;");vpb_new_text = vpb_new_text.replace(/\¼/gi,"&frac14;");vpb_new_text = vpb_new_text.replace(/\½/gi,"&frac12;");vpb_new_text = vpb_new_text.replace(/\¾/gi,"&frac34;");vpb_new_text = vpb_new_text.replace(/\¿/gi,"&iquest;");vpb_new_text = vpb_new_text.replace(/\À/gi,"&Agrave;");vpb_new_text = vpb_new_text.replace(/\Á/gi,"&Aacute;");vpb_new_text = vpb_new_text.replace(/\Â/gi,"&Acirc;");vpb_new_text = vpb_new_text.replace(/\Ã/gi,"&Atilde;");vpb_new_text = vpb_new_text.replace(/\Ä/gi,"&Auml;");vpb_new_text = vpb_new_text.replace(/\Å/gi,"&Aring;");vpb_new_text = vpb_new_text.replace(/\Æ/gi,"&AElig;");vpb_new_text = vpb_new_text.replace(/\Ç/gi,"&Ccedil;");vpb_new_text = vpb_new_text.replace(/\È/gi,"&Egrave;");vpb_new_text = vpb_new_text.replace(/\É/gi,"&Eacute;");vpb_new_text = vpb_new_text.replace(/\Ê/gi,"&Ecirc;");vpb_new_text = vpb_new_text.replace(/\Ë/gi,"&Euml;");vpb_new_text = vpb_new_text.replace(/\Ì/gi,"&Igrave;");vpb_new_text = vpb_new_text.replace(/\Í/gi,"&Iacute;");vpb_new_text = vpb_new_text.replace(/\Î/gi,"&Icirc;");vpb_new_text = vpb_new_text.replace(/\Ï/gi,"&Iuml;");vpb_new_text = vpb_new_text.replace(/\Ð/gi,"&ETH;");vpb_new_text = vpb_new_text.replace(/\Ñ/gi,"&Ntilde;");vpb_new_text = vpb_new_text.replace(/\Ò/gi,"&Ograve;");vpb_new_text = vpb_new_text.replace(/\Ó/gi,"&Oacute;");vpb_new_text = vpb_new_text.replace(/\Ô/gi,"&Ocirc;");vpb_new_text = vpb_new_text.replace(/\Õ/gi,"&Otilde;");vpb_new_text = vpb_new_text.replace(/\Ö/gi,"&Ouml;");vpb_new_text = vpb_new_text.replace(/\×/gi,"&times;");vpb_new_text = vpb_new_text.replace(/\Ø/gi,"&Oslash;");vpb_new_text = vpb_new_text.replace(/\Ù/gi,"&Ugrave;");vpb_new_text = vpb_new_text.replace(/\Ú/gi,"&Uacute;");vpb_new_text = vpb_new_text.replace(/\Û/gi,"&Ucirc;");vpb_new_text = vpb_new_text.replace(/\Ü/gi,"&Uuml;");vpb_new_text = vpb_new_text.replace(/\Ý/gi,"&Yacute;");vpb_new_text = vpb_new_text.replace(/\Þ/gi,"&THORN;");vpb_new_text = vpb_new_text.replace(/\ß/gi,"&szlig;");vpb_new_text = vpb_new_text.replace(/\à/gi,"&agrave;");vpb_new_text = vpb_new_text.replace(/\á/gi,"&aacute;");vpb_new_text = vpb_new_text.replace(/\â/gi,"&acirc;");vpb_new_text = vpb_new_text.replace(/\ã/gi,"&atilde;");vpb_new_text = vpb_new_text.replace(/\ä/gi,"&auml;");vpb_new_text = vpb_new_text.replace(/\å/gi,"&aring;");vpb_new_text = vpb_new_text.replace(/\æ/gi,"&aelig;");vpb_new_text = vpb_new_text.replace(/\ç/gi,"&ccedil;");vpb_new_text = vpb_new_text.replace(/\è/gi,"&egrave;");vpb_new_text = vpb_new_text.replace(/\é/gi,"&eacute;");vpb_new_text = vpb_new_text.replace(/\ê/gi,"&ecirc;");vpb_new_text = vpb_new_text.replace(/\ë/gi,"&euml;");vpb_new_text = vpb_new_text.replace(/\ì/gi,"&igrave;");vpb_new_text = vpb_new_text.replace(/\í/gi,"&iacute;");vpb_new_text = vpb_new_text.replace(/\î/gi,"&icirc;");vpb_new_text = vpb_new_text.replace(/\ï/gi,"&iuml;");vpb_new_text = vpb_new_text.replace(/\ð/gi,"&eth;");vpb_new_text = vpb_new_text.replace(/\ñ/gi,"&ntilde;");vpb_new_text = vpb_new_text.replace(/\ò/gi,"&ograve;");vpb_new_text = vpb_new_text.replace(/\ó/gi,"&oacute;");vpb_new_text = vpb_new_text.replace(/\ô/gi,"&ocirc;");vpb_new_text = vpb_new_text.replace(/\õ/gi,"&otilde;");vpb_new_text = vpb_new_text.replace(/\ö/gi,"&ouml;");vpb_new_text = vpb_new_text.replace(/\÷/gi,"&divide;");vpb_new_text = vpb_new_text.replace(/\ø/gi,"&oslash;");vpb_new_text = vpb_new_text.replace(/\ù/gi,"&ugrave;");vpb_new_text = vpb_new_text.replace(/\ú/gi,"&uacute;");vpb_new_text = vpb_new_text.replace(/\û/gi,"&ucirc;");vpb_new_text = vpb_new_text.replace(/\ü/gi,"&uuml;");vpb_new_text = vpb_new_text.replace(/\ý/gi,"&yacute;");vpb_new_text = vpb_new_text.replace(/\þ/gi,"&thorn;");vpb_new_text = vpb_new_text.replace(/\ÿ/gi,"&yuml;");vpb_new_text = vpb_new_text.replace(/\€/gi,"&euro;");return vpb_new_text; } /* Show date and time sent */ function vpb_date_time_c(date) { var vpb_getHour, vpb_am_or_pm; var vpb_getMinutes = ('0' + date.getMinutes()).slice(-2); vpb_getHour = date.getHours(); if (vpb_getHour < 12) { vpb_am_or_pm = "am"; } else { vpb_am_or_pm = "pm"; } if (vpb_getHour === 0) { vpb_getHour = 12; } if (vpb_getHour < 10) { vpb_getHour = '0' + vpb_getHour; } if (vpb_getHour > 12) { vpb_getHour = vpb_getHour - 12; } return (date.getMonth() + 1) + "/" + date.getDate() + ', '+ vpb_getHour + ":" + vpb_getMinutes + "" + vpb_am_or_pm; /*date.getFullYear()*/ } var vpb_page_tracker_for_updates = (function(){ var vpb_state, vpb_events, vpb_key = { hidden: "visibilitychange", webkitHidden: "webkitvisibilitychange", mozHidden: "mozvisibilitychange", msHidden: "msvisibilitychange" }; for (vpb_state in vpb_key) { if (vpb_state in document) { vpb_events = vpb_key[vpb_state]; break; } } return function(new_event) { if (new_event) document.addEventListener(vpb_events, new_event); return !document[vpb_state]; } })(); vpb_page_tracker_for_updates(function(){ vpb_active_page = vpb_page_tracker_for_updates() ? 'active' : 'inactive'; }); vpb_active_page = vpb_page_tracker_for_updates() ? 'active' : 'inactive'; function vpb_browser_supports_cors() { if ('withCredentials' in new XMLHttpRequest()) { return true; } else if(typeof XDomainRequest !== "undefined"){ return true; } else { return false;	} } function vpb_chat_info_alert(message) { $.vpb_chat_info_alert_wrap({'vpb_confirmation_heading' : 'Information','vpb_confirmation_body'    : message,'vpb_proceed_button' : 'OK','vpb_cancel_button' : ''});};function vpb_chat_info_alert_seen() { $('#vpb_chat_confirmation_alert_box').fadeOut(function(){ $(this).remove(); }); }; function vpb_position_chat_box() { var vpb_position = 0; for (uname in vpb_c_boxes) { var to_username = vpb_c_boxes[uname]; if ($("#vpb_chat_box_"+to_username).css('display') != 'none') { if (vpb_position == 0) { $("#vpb_chat_box_"+to_username).css('right', '240px'); } else { var width = (vpb_position)*(260+7)+240; $("#vpb_chat_box_"+to_username).css('right', width+'px'); } vpb_position++; } } } function vpb_open_chat(from_username, to_username, to_fullname) { if(from_username == "" || to_username == "" || to_fullname == "") { $(".vpb_chat_box").css('display','none'); $(".vpb_chat_main_box_b_wrapper").css('display','none');$(".vpb_chat_main_box_b_wrapper").css('display','none');$(".vpb_chat_box").hide();$(".vpb_chat_main_box_wrapper").hide();$(".vpb_chat_main_box_b_wrapper").hide();return false;} else if(from_username == undefined || to_username == undefined || to_fullname == undefined) { vpb_chat_info_alert('Sorry, there was no proper data received to complete your request.<br>Please refresh this page and try again or contact us to report this issue should the problem persist.<br>Thank You!'); return false; } else if(vpb_c_boxes.length == 4 && $.inArray(to_username, vpb_c_boxes) == -1) { vpb_chat_info_alert('You have reached the maximum number of chat boxes allowed on each page.<br>To open more chat boxes, please close some of your chat boxes.<br>Thank You!'); return false; } else { if ($("#vpb_chat_box_"+to_username).length > 0) { if ($("#vpb_chat_box_"+to_username).css('display') == 'none') { var userData = {'page':'v_current_session_status', 'to_username':to_username}; $.post(baseURL+'vasplus_chat/vasplus_chat.php', userData,  function(dresponse) { var status_of_user_chating_with = dresponse.split(':'); var user_chating_with_identifier = status_of_user_chating_with[0]; var user_chating_with_status = status_of_user_chating_with[1]; $("#v_current_session_status_"+to_username).html(user_chating_with_status); $("#status_of_user_chating_with"+to_username).val(user_chating_with_identifier); }); $("#vpb_chat_box_"+to_username).css('display','block'); vpb_position_chat_box(); } $("#vpb_chat_message"+to_username).focus(); return false; } else { $("<div>").attr("id","vpb_chat_box_"+to_username).addClass("vpb_chat_box").html('<div class="vpb_smiley_box_wrapper" id="vpb_smiley_box_'+to_username+'"><div class="vpb_smiley_header_box"><down onclick="vpb_d_smiley_box(\''+to_username+'\');">x</down><div style="clear:both;"></div></div><div class="vpb_smiley_inner_box"><span class="a" title="Smile" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':)\');"></span><span class="b" title="Frown, Sad" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':(\');"></span><span class="c" title="Blushing angel" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':blushing-angel:\');"></span><span class="d" title="Cat face" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':cat-face:\');"></span><span class="e" title="Confused" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \'o.O\');"></span><span class="f" title="Cry" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':cry:\');"></span><span class="g" title="Laughing devil" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':laughing-devil:\');"></span><span class="h" title="Shocked and surprised" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':O\');"></span><span class="i" title="Glasses" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \'B)\');"></span><span class="j" title="Grin, Big Smile" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':D\');"></span><span class="k" title="Upset and angry" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':grumpy:\');"></span><span class="l" title="Heart" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':heart:\');"></span><span class="m" title="Kekeke happy" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \'^_^\');"></span><span class="n" title="Kiss" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':kiss:\');"></span><span class="o" title="Pacman" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':v\');"></span><span class="p" title="Penguin" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':penguin:\');"></span><span class="q" title="Unsure" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':unsure:\');"></span><span class="r" title="Cool" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \'B|\');"></span><span class="s" title="Annoyed, sighing or bored" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \'-_-\');"></span><span class="t" title="Love" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':lve:\');"></span><span class="u" title="Christopher Putnam" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':putnam:\');"></span><span class="zb" title="Shark" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \'(^^^)\');"></span><span class="v" title="Wink" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \';-)\');"></span><span class="w" title="No idea" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \'(off)\');"></span><span class="x" title="Got an idea" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \'(on)\');"></span><span class="y" title="Cup of tea" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \':tea-cup:\');"></span><span class="z" title="No, thumb down" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \'(n)\');"></span><span class="za" title="Yes, thumb up" onclick="vpb_add_chat_smiley_a(\''+to_username+'\', \'(y)\');"></span><div style="clear:both;"></div></div></div><div class="header" id="header_'+to_username+'"><span id="v_current_session_status_'+to_username+'"></span> '+to_fullname+' <div class="vpb_close_button" onclick="javascript:return vpb_end_user_chat_session(\''+from_username+'\',\''+to_username+'\',\''+to_fullname+'\');" title="Close tab">&nbsp;</div> <div class="vpb_min_button" id="vpb_min_chat_'+to_username+'" onclick="javascript:vpb_min_and_max_chat_box(\''+to_username+'\')" title="Minimize">&nbsp;</div><div class="vpb_max_button" id="vpb_max_chat_'+to_username+'" onclick="javascript:vpb_min_and_max_chat_box(\''+to_username+'\')" title="Maximize">&nbsp;</div> </div><div class="vpb_chat_bx_inner" id="vpb_chat_bx_inner_'+to_username+'"><input type="file" name="vpb_attached_photo" id="vpb_attached_photo_'+to_username+'" onchange="document.getElementById(\'vpb_photo_selected_'+to_username+'\').title = vpbbasenameonly(this.value);document.getElementById(\'vpb_send_file_'+to_username+'\').title = vpbbasenameonly(this.value);vpb_send_chat_file(\''+from_username+'\', \''+to_username+'\', \''+to_fullname+'\');" style="display:none;" /><div class="header_inner" id="header_inner'+to_username+'"><div class="header_inner_top"><span title="Send Files" class="vpb_send_file" id="vpb_send_file_'+to_username+'" onclick="document.getElementById(\'vpb_attached_photo_'+to_username+'\').click();"></span><span class="vpb_select_smiley" title="Choose a smiley" onclick="vpb_d_smiley_box(\''+to_username+'\');"></span><span class="save_conversation" title="Download Conversation" onclick="window.open(\''+baseURL+'vasplus_chat/vpb_chat_history_d_load.php?from_username='+from_username+'&to_username='+to_username+'\',\'_blank\');"></span><span class="clear_conversation" title="Clear Conversation" onclick="javascript:return vpb_clear_chat_box(\''+from_username+'\',\''+to_username+'\');"></span><div class="vclear"></div></div><div id="vpb_loading_wrap_'+to_username+'"></div></div><div class="vpb_chat_messages_wrapper" id="vpb_message_box_'+to_username+'"><div class="vpb_chat_messages" id="vpb_message_box'+to_username+'"></div><div align="left" class="typing_or_seen" id="seen_or_typing_'+to_username+'"></div><div align="left" class="vpb_been_disconnected_from_chat" align="center"></div></div><div class="user_info"><div class="vpb_chat_message_wrapper"><textarea class="vpb_chat_message" name="vpb_chat_message'+to_username+'" id="vpb_chat_message'+to_username+'" style="" onkeydown="javascript:return vpb_send_chat_message(event,this,\''+from_username+'\',\''+to_username+'\',\''+to_fullname+'\');" onkeyup="vpb_chat_textarea_expansion(this);"></textarea><span class="vpb_photo_selected" id="vpb_photo_selected_'+to_username+'" title="No file chosen" onclick="document.getElementById(\'vpb_attached_photo_'+to_username+'\').click();"></span><div class="vclear"></div></div></div></div><input type="hidden" id="status_of_user_chating_with'+to_username+'" value="" /><input type="hidden" id="user_is_typing'+to_username+'" value="" /><input type="hidden" id="user_has_seen_message'+to_username+'" value="" /><input type="hidden" id="last_chat_message_id_displayed'+to_username+'" value="" /><input type="hidden" id="last_chat_message_updated'+to_username+'" value="" /><input type="hidden" id="vpb_last_message_has_been_displayed'+to_username+'" value="" /><input type="hidden" id="vasplus_general_tracker'+to_username+'" value="" /><div id="vpb_from_and_to_last_message_data'+to_username+'" style="display:none;"></div><div id="vpb_from_and_to_last_message_updated_data'+to_username+'" style="display:none;"></div>').appendTo($( "body" )); $("#vpb_chat_box_"+to_username).css('bottom', '0px'); var vpb_c_box_length = 0; for (var x in vpb_c_boxes) { if ($("#vpb_chat_box_"+vpb_c_boxes[x]).css('display') != 'none') { vpb_c_box_length++; } } if (vpb_c_box_length == 0) { $("#vpb_chat_box_"+to_username).css('right', '240px'); } else { var width = (vpb_c_box_length)*(260+7)+240; $("#vpb_chat_box_"+to_username).css('right', width+'px'); } var v_data_found = 0; var vpb_chat_user_info = from_username+':'+to_username+':'+to_fullname; if( $.cookie('vpb_chat_users_array') == "" || $.cookie('vpb_chat_users_array') == null || $.cookie('vpb_chat_users_array') == undefined ) { vpb_c_boxes[vpb_c_boxes.length] = to_username; vpb_c_users_d[vpb_c_users_d.length] = vpb_chat_user_info; if( vpb_c_users_d == "" || vpb_c_users_d == null || vpb_c_users_d == undefined ) {} else { $.cookie('vpb_chat_users_array', vpb_c_users_d, { expires: 365, path: '/' }); } } else { if( vpb_c_boxes == "" || vpb_c_boxes == null || vpb_c_boxes == undefined ) { vpb_c_boxes[vpb_c_boxes.length] = to_username; vpb_c_users_d[vpb_c_users_d.length] = vpb_chat_user_info; } else { for (j=0;j<vpb_c_boxes.length;j++) { if (vpb_c_boxes[j] == to_username) { v_data_found = 1; } } if(v_data_found == 1) {} else { vpb_c_boxes[vpb_c_boxes.length] = to_username; vpb_c_users_d[vpb_c_users_d.length] = vpb_chat_user_info; if( vpb_c_users_d == "" || vpb_c_users_d == null || vpb_c_users_d == undefined ) {} else { $.cookie('vpb_chat_users_array', vpb_c_users_d, { expires: 365, path: '/' }); } } } } $("#vpb_chat_box_"+to_username).show(); /*Minimized or Maximized*/ if( $.cookie('vpb_chat_min_or_max_status') != "" && $.cookie('vpb_chat_min_or_max_status') != null && $.cookie('vpb_chat_min_or_max_status') != undefined ) { vpb_min_max_box = $.cookie('vpb_chat_min_or_max_status').split(/\,/); for (var vpb_mm=0;vpb_mm<vpb_min_max_box.length;vpb_mm++) { if(vpb_min_max_box[vpb_mm] != "") { var tousern = vpb_min_max_box[vpb_mm]; $('#vpb_chat_bx_inner_'+tousern).css('display','none'); $('#vpb_min_chat_'+tousern).hide(); $('#vpb_max_chat_'+tousern).show(); } else {} } } else {} var dataSteng = {'page':'display_conversation', 'from_username':from_username, 'to_username':to_username, 'last_chat_message_id_displayed':$("#last_chat_message_id_displayed"+to_username).val()}; $.post(baseURL+'vasplus_chat/vasplus_chat.php', dataSteng,  function(dataResp) { $.cookie('to_username_seen', to_username, { expires: 365, path: '/' }); $("#vpb_message_box"+to_username).html(dataResp); var userData = {'page':'v_current_session_status', 'to_username':to_username};  $.post(baseURL+'vasplus_chat/vasplus_chat.php', userData,  function(eresponse) { var status_of_user_chating_with = eresponse.split(':'); var user_chating_with_identifier = status_of_user_chating_with[0]; var user_chating_with_status = status_of_user_chating_with[1]; $("#v_current_session_status_"+to_username).html(user_chating_with_status); $("#status_of_user_chating_with"+to_username).val(user_chating_with_identifier); }); }); $.cookie('from_username', from_username, { expires: 365, path: '/' }); $.cookie('to_username', to_username, { expires: 365, path: '/' }); $.cookie('to_fullname', to_fullname, { expires: 365, path: '/' }); setTimeout(function() { $("#vpb_message_box"+to_username).scrollTop($("#vpb_message_box"+to_username)[0].scrollHeight); $("#vpb_chat_message"+to_username).focus();},400);} } } 
function vpb_set_selected_chat_option(selected_option) { if( selected_option == "Off" ) { $.cookie('chat_is_turned_off', 'yes', { expires: 365, path: '/' }); $(".headers").css("opacity","0.6"); } else {
		$.removeCookie('chat_is_turned_off', { path: '/' });
		$(".headers").css("opacity","1"); }
	$(".vpb_chat_option_boxes_icons").hide();
	$("#vpb_c_"+selected_option).fadeIn();
	$(".vpb_chat_options_box").hide();
	var dataString = {'page':'vpb_update_chat_status', 'from_username':$("#from_username_identity").val(), 'chat_status':selected_option};
	$.post(baseURL+'vasplus_chat/vasplus_chat.php', dataString,  function(response){
		var vpb_system_response = response.indexOf('DISABLED_CHAT_TEMPORARILY');
		if( vpb_system_response != -1 ) { return false; }
		// Load chat users
		$("#vpb_chat_friends_box").show().html('<center><div align="center" class="loaging_cleared_chats"><img src="'+vpb_image_dir+'vasplus_loading.gif"><br><div align="center" style="padding-top:8px;">Please wait</div></div></center>');
		var dataStrngd = {'page':'vpb_load_friends_box', 'from_username':$("#from_username_identity").val()};
		$.post(baseURL+'vasplus_chat/vasplus_chat.php', dataStrngd,  function(response) {
			var responsebrought = response.indexOf('Chat is turnd off');
			if(responsebrought != -1) {
				if($.cookie('chat_is_turned_off') == "yes") { $(".headers").css("opacity","0.6"); } else { $(".headers").css("opacity","1"); } } else {}
			$("#vpb_chat_friends_box").html(response); }); }); }
function vpb_hide_chat_sidebar(status) {
	if( $("#from_username_identity").val() != "" && $("#from_username_identity").val() != undefined ) {
		$("#vpb_chat_main_box").hide();
		$(".vpb_chat_options_box").hide();
		$("#vpb_chat_main_box_b").show();
		var dataString = {'page':'vpb_hide_chat_sidebar', 'from_username':$("#from_username_identity").val(), 'chat_status':status};
		$.post(baseURL+'vasplus_chat/vasplus_chat.php', dataString,  function(response) {
			var vpb_system_response = response.indexOf('DISABLED_CHAT_TEMPORARILY');
			if( vpb_system_response != -1 ) { return false; }
			var responsebrought = response.indexOf('Chat is turnd off');
			if(responsebrought != -1) {
				$(".headers").css("opacity","0.6");
			} else {
				$(".headers").css("opacity","1"); 
			}
			$("#vpb_chat_main_box").hide();
			$(".vpb_chat_options_box").hide();
			$("#vpb_chat_main_box_b").show();
			return false;
		});
	} else {
		vpb_chat_info_alert('Sorry, your identity could not be verified at the moment. Please refresh this page and try again.<br>Thank You!'); 
		return false;
	}
}
// Show Option Box
function vpb_chat_option_boxed() { $(".vpb_chat_options_box").toggle(); }/* Add break to contents */ function nl2br(vdata, vxml) { var createNewLines = (vxml || typeof vxml === 'undefined') ? '<br ' + '/>' : '<br>'; return (vdata + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + createNewLines + '$2'); }/* Add links to chat URLs */ function vpb_create_chat_links(vpb_chat_text) { var vpb_converted_links, vpb_https_http_ftp_links, vpb_www_links, vpb_email_links; vpb_https_http_ftp_links = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim; vpb_converted_links = vpb_chat_text.replace(vpb_https_http_ftp_links, '<a style="color: blue;" class="hover_text" href="$1" target="_blank">$1</a>'); pb_www_links = /(^|[^\/])(www\.[\S]+(\b|$))/gim; vpb_converted_links = vpb_converted_links.replace(vpb_www_links, '$1<a style="color: blue;" class="hover_text" href="http://$2" target="_blank">$2</a>'); vpb_email_links = /(\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6})/gim; vpb_converted_links = vpb_converted_links.replace(vpb_email_links, '<a style="color: blue;" class="hover_text" href="mailto:$1" target="_blank">$1</a>'); return vpb_converted_links; } /* Add smilies to chat */ function vpb_chat_smilies(vpb_chat_text) { var vpb_chat_text_conversion = vpb_chat_text, vpb_a_smilies = [{ vpb_smiley_symbol: ':)', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'smile.png" title="Smile" align="absmiddle">' },{ vpb_smiley_symbol: ':(', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'frown.png" title="Frown, Sad" align="absmiddle">' },{ vpb_smiley_symbol: ':blushing-angel:', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'angel.png" title="Blushing angel" align="absmiddle">' },{ vpb_smiley_symbol: ':cat-face:', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'colonthree.png" title="Cat face" align="absmiddle">' },{ vpb_smiley_symbol: 'o.O', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'confused.png" title="Confused" align="absmiddle">' },{ vpb_smiley_symbol: 'O.o', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'confused.png" title="Confused" align="absmiddle">' },{ vpb_smiley_symbol: ':cry:', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'cry.png" title="Cry" align="absmiddle">' },{ vpb_smiley_symbol: ':laughing-devil:', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'devil.png" title="Laughing devil" align="absmiddle">' },{ vpb_smiley_symbol: ':O', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'gasp.png" title="Shocked and surprised" align="absmiddle">' },{ vpb_smiley_symbol: 'B)', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'glasses.png" title="Glasses" align="absmiddle">' },{ vpb_smiley_symbol: ':D', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'grin.png" title="Grin, Big Smile" align="absmiddle">' },{ vpb_smiley_symbol: ':grumpy:', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'grumpy.png" title="Upset and angry" align="absmiddle">' },{ vpb_smiley_symbol: ':heart:', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'heart.png" title="Heart" align="absmiddle">' },{ vpb_smiley_symbol: '^_^', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'kiki.png" title="Kekeke happy" align="absmiddle">' },{ vpb_smiley_symbol: ':kiss:', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'kiss.png" title="Kiss" align="absmiddle">' },{ vpb_smiley_symbol: ':v', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'pacman.png" title="Pacman" align="absmiddle">' },{ vpb_smiley_symbol: ':penguin:', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'penguin.gif" title="Penguin" align="absmiddle">' },{ vpb_smiley_symbol: ':unsure:', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'unsure.png" title="Unsure" align="absmiddle">' },{ vpb_smiley_symbol: 'B|', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'sunglasses.png" title="Cool" align="absmiddle">' },{ vpb_smiley_symbol: 'B-|', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'sunglasses.png" title="Cool" align="absmiddle">' },{ vpb_smiley_symbol: '8-|', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'sunglasses.png" title="Cool" align="absmiddle">' },{ vpb_smiley_symbol: '8|', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'sunglasses.png" title="Cool" align="absmiddle">' },{ vpb_smiley_symbol: '-_-', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'squint.png" title="Annoyed, sighing or bored" align="absmiddle">' },{ vpb_smiley_symbol: ':lve:', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'red_heart_love.gif" title="Love" align="absmiddle">' },{ vpb_smiley_symbol: ':putnam:', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'putnam.gif" title="Christopher Putnam" align="absmiddle">' },{ vpb_smiley_symbol: ';)', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'wink.png" title="Wink" align="absmiddle">' },{ vpb_smiley_symbol: ';-)', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'wink.png" title="Wink" align="absmiddle">' },{ vpb_smiley_symbol: '(off)', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'no_idea.gif" title="No idea" align="absmiddle">' },{ vpb_smiley_symbol: '(on)', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'got_idea.gif" title="Got an idea" align="absmiddle">' },{ vpb_smiley_symbol: ':tea-cup:', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'cup_of_tea.png" title="Cup of tea" align="absmiddle">' },{ vpb_smiley_symbol: '(n)', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'no_thumbs_down.gif" title="No, thumb down" align="absmiddle">' },{ vpb_smiley_symbol: '(y)', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'yes_thumbs_up.gif" title="Yes, thumb up" align="absmiddle">' },{ vpb_smiley_symbol: '(^^^)', vpb_smiley_im: '<img src="'+vpb_smiley_dir+'shark.gif" title="Shark" align="absmiddle">' },{ vpb_smiley_symbol: "=P", vpb_smiley_im: "tongue" },{ vpb_smiley_symbol: "=P", vpb_smiley_im: "tongue" }]; for (var i = 0; i < vpb_a_smilies.length; i++) { vpb_chat_text_conversion = vpb_chat_text_conversion.replace(vpb_a_smilies[i].vpb_smiley_symbol, vpb_a_smilies[i].vpb_smiley_im); } return vpb_chat_text_conversion; }
function vpb_trim_data(cText) { return cText.replace(/^\s+|\s+$/gi,''); }
function vpb_send_chat_message(vpb_event, chat_message, from_username, to_username, to_fullname) {
	var vpb_keycode = (vpb_event.keyCode ? vpb_event.keyCode : vpb_event.which);
	if (vpb_event.keyCode == 13 && !vpb_event.shiftKey) { vpb_event.preventDefault(); } /* Do not allow spaces in textarea chat box */
	if(vpb_keycode == 13 && vpb_event.shiftKey == 0) {
		var from_user_name, from_user_photo;
		if( $("#from_user_photo").val() != "" && $("#from_user_photo").val() != undefined ) {
			from_user_name = $("#from_user_name").val();
			from_user_photo = $("#from_user_photo").val();
		} else if( $("#from_user_photos").val() != "" && $("#from_user_photos").val() != undefined ) {
			from_user_name = $("#from_user_names").val();
			from_user_photo = $("#from_user_photos").val();
		} else {
			from_user_name = "";
			from_user_photo = "avatar.png";
		}
		$("#vpb_chat_message"+to_username).animate({
				"height": "16px"
		}, "fast" );
		var chat_message = $(chat_message).val();
		var time_sent=new Date();
		if(vpb_trim_data(chat_message) == "" || to_username == "" || from_username == "") {
			vpb_event.preventDefault();
			return false;
		} else {
			var vpb_chat_regex_url = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
			var vpb_url_in_chat = vpb_trim_data(chat_message).match(vpb_chat_regex_url);
			var first_url;
			var video_chat_display;
			var video_id;
			var vpb_link_type;
			var vpb_determiner = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
			if ( vpb_url_in_chat == "" || vpb_url_in_chat == null ) 
			{
				first_url = "";
				video_chat_display = "";
			} else {
				if(vpb_url_in_chat.length > 0) {
					if(vpb_url_in_chat.length == 1) {
						first_url = vpb_url_in_chat[0];
					}
					else if(vpb_url_in_chat.length == 2) {
						var check_first = (vpb_url_in_chat[0].match(vpb_determiner)) ? RegExp.$1 : false;
						
						if( check_first === false ) {
							first_url = vpb_url_in_chat[1];
						} else {
							first_url = vpb_url_in_chat[0];
						}
					}
					else if(vpb_url_in_chat.length == 3) {
						var check_first = (vpb_url_in_chat[0].match(vpb_determiner)) ? RegExp.$1 : false;
						var check_second = (vpb_url_in_chat[1].match(vpb_determiner)) ? RegExp.$1 : false;
						
						if( check_first === false ) {
							if( check_second === false ) {
								first_url = vpb_url_in_chat[2];
							} else {
								first_url = vpb_url_in_chat[1];
							}
						} else {
							first_url = vpb_url_in_chat[0];
						}
					}
					else if(vpb_url_in_chat.length == 4) {
						var check_first = (vpb_url_in_chat[0].match(vpb_determiner)) ? RegExp.$1 : false;
						var check_second = (vpb_url_in_chat[1].match(vpb_determiner)) ? RegExp.$1 : false;
						var check_third = (vpb_url_in_chat[2].match(vpb_determiner)) ? RegExp.$1 : false;
						
						if( check_first === false ) {
							if( check_second === false ) {
								if( check_third === false ) 
								{
									first_url = vpb_url_in_chat[3];
								} else {
									first_url = vpb_url_in_chat[2];
								}
							} else {
								first_url = vpb_url_in_chat[1];
							}
						} else {
							first_url = vpb_url_in_chat[0];
						}
					} else {
						first_url = vpb_url_in_chat[0];
					}
				} else {
					first_url = '';
				}
				
				if( first_url !== "" ) {
					video_id = (first_url.match(vpb_determiner)) ? RegExp.$1 : '';
					if( video_id !== "") {
						video_chat_display = '<div style="clear:both;"></div><div style="width:180px;margin-top:10px;padding:6px;word-wrap: break-word; border:1px solid #F2F2F2; background:#F9F9F9; font-family:Verdana, Geneva, sans-serif; font-size:11px;"><iframe width="180" height="180" src="//www.youtube.com/embed/'+video_id+'?wmode=transparent&theme=light&modestbranding=1&controls=1&showinfo=0" frameborder="0" allowfullscreen></iframe></div>';
						vpb_link_type = 'vvideo';
					}
					else  { video_chat_display = ""; vpb_link_type = 'vdata'; }
				}
				else { video_chat_display = ""; vpb_link_type = ""; }
			}
			
			$("#seen_or_typing_"+to_username).html('');
			$("#vpb_message_box"+to_username).fadeIn('2000').append('<div class="vpb_chat_contents"><chat_date_time><div class="vlines" style="width:145px;"></div> <div class="hovertext" style="float:right;">'+vpb_date_time_c(time_sent)+'</div><div style="clear:both;"></div></chat_date_time><br clear="all" /><chat_fullname><img title="'+from_user_name+'" src="'+baseURL+'vasplus_chat/photos/'+from_user_photo+'" align="absmiddle" style="width:30px;height:30px;float:left;"></chat_fullname> <chat_messages>'+vpb_create_chat_links(nl2br(vpb_chat_smilies(vasplus_special_text(chat_message))))+video_chat_display+'</chat_messages><div style="clear:both;"></div></div>');
			$("#vpb_message_box"+to_username).scrollTop($("#vpb_message_box"+to_username)[0].scrollHeight);
			$("#vpb_chat_message"+to_username).val('').focus();
			
			if (vpb_esource_browser_supports && vpb_esource_browser_supports == true || vpb_cors_browser_supports && vpb_cors_browser_supports == true)  {}
			else {
				vpb_reader_interval = vpb_low_reader;
				vpb_c_reader = 1;
			}
			vpb_chat_header_notification(".header", "stop");
			var dataString = {'page':'send_new_chat_message', 'last_chat_message_id_displayed':$("#last_chat_message_id_displayed"+to_username).val(), 'from_username':from_username, 'to_username':to_username, 'message':chat_message, 'vpb_link':first_url, 'vpb_link_type':vpb_link_type};
			
			$.post(baseURL+'vasplus_chat/vasplus_chat.php', dataString, function(response) {
				var vpb_system_response = response.indexOf('DISABLED_CHAT_TEMPORARILY');
				if( vpb_system_response != -1 ) { return false; }
			
				setTimeout(function() {
					var response_broght = response.indexOf('VPB ERROR');
					if ( response_broght != -1) {
						vpb_chat_info_alert(response);
						return false;
					} else {
						//$("#vpb_from_and_to_last_message_data").html(response);
						return false;
					}
				},100);
			
			}).fail(function(error_response) 
			{
				vpb_chat_info_alert('Sorry, it appears you have been disconnected from chat. Please refresh this page to try again.<br>Thank You!'); 
				return false;
			});		
		}
		return false;
	}
	else {}
}

// Display file size
function vpb_show_file_size(file_field) { var vpb_file_size = ($("#"+file_field)[0].files[0].size / 1024); var vpb_actual_size; if (vpb_file_size / 1024 > 1) { if (((vpb_file_size / 1024) / 1024) > 1) { vpb_file_size = (Math.round(((vpb_file_size / 1024) / 1024) * 100) / 100); vpb_actual_size = vpb_file_size + "Gb"; } else { vpb_file_size = (Math.round((vpb_file_size / 1024) * 100) / 100); vpb_actual_size = vpb_file_size + "Mb";  } } else { vpb_file_size = (Math.round(vpb_file_size * 100) / 100); vpb_actual_size = vpb_file_size  + "kb"; } return vpb_actual_size; }

// Send new chat message
function vpb_send_chat_file(from_username, to_username, to_fullname) {
	var vfiles = document.getElementById('vpb_attached_photo_'+to_username).files;
	var ext = $('#vpb_attached_photo_'+to_username).val().split('.').pop().toLowerCase();
	if($.inArray(ext, ["jpg", "jpeg", "gif", "png", "doc", "docx", "pdf", "txt", "zip"]) == -1) {
		vpb_chat_info_alert('VPB ERROR: The file type you were about to send is not allowed in this chat.<br />The extensions of files allowed are jpg, jpeg, gif, png, doc, docx, pdf, txt and zip<br />Thank You!'); 
		return false;
	} //// Maximum allowed file size = 61 MB OR 61.69 Mb
	else if(vfiles[0].size > parseInt(64687347)) {
		vpb_chat_info_alert('VPB ERROR: The file that you were about to send exceeded the maximum allowed file size of <b>61 MB</b>.<br>The size of your file is <b>'+vpb_show_file_size('vpb_attached_photo_'+to_username)+'</b>, please reduce your file size to proceed.<br>Thank You!');
		return false;
	} else {
		// Create a formdata object and add the files
		$("#seen_or_typing_"+to_username).html('');
		var data = new FormData();
		$.each(vfiles, function(key, value) {
			data.append(key, value);
		});
		var dataString = 'page=send_new_chat_file&from_username=' + from_username + '&to_username=' + to_username + '&last_chat_message_id_displayed=' + $("#last_chat_message_id_displayed"+to_username).val();
		$.ajax({
			url: baseURL+'vasplus_chat/vasplus_chat.php?'+dataString,
			type: 'POST',
			data: data,
			cache: false,
			processData: false,
			contentType: false,
			beforeSend: function() {
				vpb_chat_header_notification(".header", "stop");
				$("#vpb_loading_wrap_"+to_username).html('<div class="vpb_loading_wrap"><span class="vpb_loading_inner">Sending file</span><span class="vpb_loading"></span><div class="vclear"></div></div>');
			},
			success: function(response) {
				$("#vpb_loading_wrap_"+to_username).html('');
				var response_broght = response.indexOf('VPB ERROR');
				if ( response_broght != -1) {
					document.getElementById('vpb_photo_selected_'+to_username).title = 'No file chosen';
					document.getElementById('vpb_send_file_'+to_username).title = 'Send Files';
					vpb_chat_info_alert(response);
					return false;
				} else {
					document.getElementById('vpb_photo_selected_'+to_username).title = 'No file chosen';
					document.getElementById('vpb_send_file_'+to_username).title = 'Send Files';
					$("#vpb_message_box"+to_username).fadeIn('2000').append(response);
					setTimeout(function() {
						$("#vpb_message_box"+to_username).scrollTop($("#vpb_message_box"+to_username)[0].scrollHeight);
						$("#vpb_chat_message"+to_username).val('').focus();
					},200);
					
					if (vpb_esource_browser_supports && vpb_esource_browser_supports == true || vpb_cors_browser_supports && vpb_cors_browser_supports == true)  {}
					else {
						vpb_reader_interval = vpb_low_reader;
						vpb_c_reader = 1;
					}
				}
				return false;
			}
		});
	}
}
// Enlarge sent photo
function vpb_enlarge_chat_photo(photo_id,fromuser)  {
	$("#vpb_chat_pop_up_background").css({
		"opacity": "0.4"
	});
	$("#vpb_chat_pop_up_background").fadeIn();
	$("#vpb_chat_photo_enlargement_wrapper").fadeIn();
	vasplus_centralized_box('600', '50', 'vpb_chat_photo_enlargement_wrapper');
	var dataString = 'photo_id='+ photo_id + '&fromuser='+ fromuser + '&page=vpb_enlarge_chat_photo';
	$.ajax({
		type: 'POST',
		url: baseURL+'vasplus_chat/vasplus_chat.php',
		data: dataString,
		cache: true,
		beforeSend: function() {
			$("#enlarged_photo_displayer").html('<center><div style="width:600px; margin:20px;" align="center"><img src="'+vpb_image_dir+'vasplus_loading.gif" align="absmiddle" style="width:120px; height:120px;" /></div></center>');
		},
		success: function(response) {
			$("#enlarged_photo_displayer").fadeIn().html(response);
			return false;
		}
	}).fail(function() 
	{
		$("#vpb_chat_photo_enlargement_wrapper").hide();
		$("#vpb_chat_pop_up_background").fadeOut();
		vpb_chat_info_alert('Sorry, it appears you have been disconnected from chat. Please refresh this page to try again.<br>Thank You!'); 
		return false;
	});	
}
// Close photo enlargement box
function vpb_hide_chat_popup_boxy() {	
	$('#vpb_chat_photo_enlargement_wrapper').hide();
	$("#vpb_chat_pop_up_background").fadeOut();
}
// Check if a text is selected or not
function vpb_text_selected() {
    var text = "";
    if (window.getSelection) {
        text = window.getSelection().toString();
    } else if (document.selection && document.selection.type != "Control") {
        text = document.selection.createRange().text;
    }
    return text;
}

// Blink page title
function vpb_chat_page_title(vpb_new_title_message) { if (document.title == vpb_original_title_message) { document.title = vpb_new_title_message; } else { document.title = vpb_original_title_message; } }

// Check to be sure that the user photo exist and then display it
function vpb_verified_to_user_photo(img)  {
	var image = new Image(); 
	image.src = img;
	if (image.width == 0) {
		return false
	} else {
		return true
	}
}
//Focus Search box
function vpb_chat_focus_search_box() {
	$(".vpb_chat_options_box").hide();
	$("#vasplus_chat_users_search").focus();
	$("#vpbchatoptionandbar").hide();
	$("#vasplus_chat_users_search").css('width','165px');
	$("#vpb_search_box_wrap").removeClass('vpb_search_box_wrapper');
	$("#vpb_search_box_wrap").addClass('vpb_search_box_wrappers');
}
//Get basename of file
function vpbbasenameonly(url) {
    //return ((url=/(([^\/\\\.#\? ]+)(\.\w+)*)([?#].+)?$/.exec(url))!= null)? url[2]: '';
	return url.replace(/\\/g,'/').replace( /.*\//, '' );
}

//Resize chat box
function vpb_chat_textarea_expansion(vpb_chat_textarea){
	var vpb_textarea_box = vpb_chat_textarea;
	setTimeout(function() {
		if(vpb_textarea_box.scrollHeight > 120) {
			vpb_textarea_box.css('overflow-y','hidden');
			vpb_textarea_box.scrollHeight + '120px';
		} else {
			vpb_textarea_box.style.cssText = 'height:3; padding:0';
			vpb_textarea_box.style.cssText = 'height:' + vpb_textarea_box.scrollHeight + 'px';
		}
	},0);
}

//Load and display friends box on page load
function vpb_load_chat_friends_box()
{
	if( $("#from_username_identity").val() != "" && $("#from_username_identity").val() != undefined ) {
		$(".headers").css("opacity","0.6"); 
		$("#vpb_chat_friends_box").html('<center><div align="center" class="loaging_cleared_chats"><img src="'+vpb_image_dir+'vasplus_loading.gif"><br><div align="center" style="padding-top:8px;">Please wait</div></div></center>');
	
		var dataStrnge = {'page':'vpb_load_friends_box', 'from_username':$("#from_username_identity").val()};
		$.post(baseURL+'vasplus_chat/vasplus_chat.php', dataStrnge,  function(response)  {
			var vpb_system_response = response.indexOf('DISABLED_CHAT_TEMPORARILY');
			if( vpb_system_response != -1 ) { return false; }
		
			var response_braught = response.indexOf('Chat is turned off');
			if( response_braught != -1 ) { $(".headers").css("opacity","0.6"); }
			else { $(".headers").css("opacity","1"); }
			$("#vpb_chat_friends_box").html(response); 
		}).fail(function() 
		{
			vpb_chat_info_alert('Sorry, it appears you have been disconnected from chat. Please refresh this page to try again.<br>Thank You!'); 
			return false;
		});	
	}
	else {}
}
//Set height of Main Chat Box
function vpb_show_main_box_b() 
{	
	$(".vpb_chat_options_box").hide();
	$("#vpb_chat_main_box_b").hide();
	$("#vpb_chat_main_box").show();
	if ( $("#from_username_identity").val() != "" && $("#from_username_identity").val() != undefined ) {
		var dataString = {'page':'vpb_hide_chat_sidebar', 'from_username':$("#from_username_identity").val(), 'chat_status':'show'};
		$.post(baseURL+'vasplus_chat/vasplus_chat.php', dataString,  function(response) {
			var vpb_system_response = response.indexOf('DISABLED_CHAT_TEMPORARILY');
			if( vpb_system_response != -1 ) { return false; }
				
			var responsebrought = response.indexOf('Chat is turnd off');
			if(responsebrought != -1) {
				$(".headers").css("opacity","0.6");
			} else {
				$(".headers").css("opacity","1"); 
			}
		}).fail(function() 
		{
			vpb_chat_info_alert('Sorry, it appears you have been disconnected from chat. Please refresh this page to try again.<br>Thank You!'); 
			return false;
		});	
	}
	else {
		vpb_chat_info_alert('Sorry, your identity could not be verified at the moment. Please refresh this page and try again.<br>Thank You!'); 
		return false;
	}
}
// Blink chat headers
function vpb_chat_header_notification(element,action) 
{
	if( action === 'start' ) {
		if(vpb_chat_header_notifications) clearInterval(vpb_chat_header_notifications);
		vpb_chat_header_notifications = setInterval(function() { $(element).toggleClass('vpb_chat_box_header_b vpb_chat_box_header_a');}, 800);
	} else {
		$(element).removeClass('vpb_chat_box_header_b');
		$(element).addClass('vpb_chat_box_header_a');
		if(vpb_chat_header_notifications) clearInterval(vpb_chat_header_notifications);
	}
}

function vpb_run_job() {
	$('#run_server_job').delay(500).fadeTo('slow', 1.0, function() {
		var number = 1 + Math.floor(Math.random() * 6);
  		$('#run_server_job_d').html('Numbers: '+number);
		run_job(); 
	});
}


// Vasplus RT - ajax
function vpb_chat_xmlhttp_stream() {
	var vpb_start_comet = function (vpb_url) {
		this.timestamp = 0;
		this.url = vpb_url;  
		this.vpb_no_error = true;
		this.save_in_txt = 'vasplus_streamer';
		this.connect = function() {
			var vpb_me = this;
			$.ajax({
				type : 'get',
				url : this.url,
				dataType : 'json', 
				data : {'timestamp' : vpb_me.timestamp},
				success : function(response) {
					vpb_me.timestamp = response.timestamp;
					vpb_me.handleResponse(response);
					vpb_me.vpb_no_error = true;          
				},
				complete : function(response) 
				{
					if (!vpb_me.vpb_no_error) {
						//You have been disconnected from chat. Trying to connect again in 5 second... 
					setTimeout(function(){ comet.connect(); $(".vpb_been_disconnected_from_chat").fadeIn().html('You have been disconnected from chat.'); }, 5000);          
					} else {
					vpb_me.connect(); 
					$(".vpb_been_disconnected_from_chat").fadeOut().html('');
				}
				vpb_me.vpb_no_error = false; 
				}
			});
		}
		this.disconnect = function() { }
		this.handleResponse = function(response) 
		{
			if($("#vpb_chats_heart_beat").length>0)
			{
				// Auto Start New Session
				if( $("#from_username_identity").val() != "" && $("#from_username_identity").val() != undefined ) {	
					var auto_check_new_chat = 'page=newchatsession' + '&from_username=' + $("#from_username_identity").val();
					var newchatsession = $.ajax({
						type: "POST",
						url: baseURL+"vasplus_chat/vasplus_chat.php",
						data: auto_check_new_chat,
						cache: false,
						success: function(auto_check_new_chat_resp) {
							var vpb_system_response = auto_check_new_chat_resp.indexOf('DISABLED_CHAT_TEMPORARILY');
							if( vpb_system_response != -1 ) { vpb_open_chat('', '', ''); return false; }
							var responsebrought = auto_check_new_chat_resp.indexOf('no_un_seen_chat');
							if( responsebrought != -1 ) {}
							else {
								var from_username = $("#from_username_identity").val();
								var new_chat_details = auto_check_new_chat_resp.split(':');
								var to_username = new_chat_details[0];
								var to_fullname = new_chat_details[1];
								if ( $("#vpb_chat_box_"+to_username).length > 0 ) {
									//display_loaded_conversation
									var vpb_new_chat_data = {'page':'display_loaded_conversation', 'from_username':from_username, 'to_username':to_username, 'last_chat_message_id_displayed':$("#last_chat_message_id_displayed"+to_username).val()};
									
									$.post(baseURL+'vasplus_chat/vasplus_chat.php', vpb_new_chat_data,  function(vpb_new_chat_data_resp) {
										var vpb_system_response = vpb_new_chat_data_resp.indexOf('DISABLED_CHAT_TEMPORARILY');
										if( vpb_system_response != -1 ) { return false; }
										var message_brought = vpb_new_chat_data_resp.indexOf('none');
										if( message_brought != -1 ) {}
										else {
											$("#vpb_from_and_to_last_message_data"+to_username).html(vpb_new_chat_data_resp);
											if($("#vpb_last_message_has_been_displayed"+to_username).val() != "" && $("#vpb_last_message_has_been_displayed"+to_username).val() == $("#vasplus_general_tracker"+to_username).val()) {}
											else {
												$("#vpb_last_message_has_been_displayed"+to_username).val($("#vasplus_general_tracker"+to_username).val());
												$("#last_user_session_displayed"+to_username).val($("#vasplus_general_tracker"+to_username).val());
												
												if ($("#vpb_chat_box_"+to_username).css('display') == 'none') {
													var vpb_c_box_length = 0;
			
													for (var x in vpb_c_boxes) {
														if ($("#vpb_chat_box_"+vpb_c_boxes[x]).css('display') != 'none') {
															vpb_c_box_length++;
														}
													}
												
													if (vpb_c_box_length == 0) {
														$("#vpb_chat_box_"+to_username).css('right', '240px');
													} else {
														var width = (vpb_c_box_length)*(260+7)+240;
														$("#vpb_chat_box_"+to_username).css('right', width+'px');
													}
													var v_data_found = 0;
													var vpb_chat_user_info = from_username+':'+to_username+':'+to_fullname;
													if( $.cookie('vpb_chat_users_array') == "" || $.cookie('vpb_chat_users_array') == null || $.cookie('vpb_chat_users_array') == undefined ) {
														vpb_c_boxes[vpb_c_boxes.length] = to_username; 
														vpb_c_users_d[vpb_c_users_d.length] = vpb_chat_user_info;
														if( vpb_c_users_d == "" || vpb_c_users_d == null || vpb_c_users_d == undefined ) {}
														else { $.cookie('vpb_chat_users_array', vpb_c_users_d, { expires: 365, path: '/' }); }
													} else {
														if( vpb_c_boxes == "" || vpb_c_boxes == null || vpb_c_boxes == undefined ) {
															vpb_c_boxes[vpb_c_boxes.length] = to_username; 
															vpb_c_users_d[vpb_c_users_d.length] = vpb_chat_user_info;
														} else {
															for (j=0;j<vpb_c_boxes.length;j++) {
																if (vpb_c_boxes[j] == to_username) {
																	v_data_found = 1;
																}
															}
															if(v_data_found == 1) {}
															else {
																vpb_c_boxes[vpb_c_boxes.length] = to_username; 
																vpb_c_users_d[vpb_c_users_d.length] = vpb_chat_user_info;
																if( vpb_c_users_d == "" || vpb_c_users_d == null || vpb_c_users_d == undefined ) {}
																else { $.cookie('vpb_chat_users_array', vpb_c_users_d, { expires: 365, path: '/' }); }
															}
														}
													}
													$("#vpb_chat_box_"+to_username).show();
												} else {}
												if($("#seen_or_typing_"+to_username).text().indexOf('typing...') == -1) {
													$("#seen_or_typing_"+to_username).html('');
												}
												else {}
												$("#vpb_message_box"+to_username).append(vpb_new_chat_data_resp);
												
												// Minimized or Maximized
												if( $.cookie('vpb_chat_min_or_max_status') != "" && $.cookie('vpb_chat_min_or_max_status') != null && $.cookie('vpb_chat_min_or_max_status') != undefined ) {
													vpb_min_max_box = $.cookie('vpb_chat_min_or_max_status').split(/\,/);
													var vpb_is_minimized = 0;
													for (var vpb_mm=0;vpb_mm<vpb_min_max_box.length;vpb_mm++) {
														if(vpb_min_max_box[vpb_mm] == to_username)
														{
															vpb_is_minimized = 1;
														}
														else {}
													}
													if( vpb_is_minimized > 0 ) {
														vpb_chat_header_notification("#header_"+to_username, "start");
														$('#vasplusChatAudio')[0].play();
													} else {
														vpb_chat_header_notification(".header", "stop");
														$('#vasplusChatAudio')[0].pause(); 
													}
												} else {}
												setTimeout(function() {
												$("#vpb_message_box"+to_username).scrollTop($("#vpb_message_box"+to_username)[0].scrollHeight);
												$("#vpb_chat_message"+to_username).focus();
												},400);
											}
										}
									});
								} else {
									if( $("#process_is_running").val() != "" && $("#process_is_running").val() != null && $("#process_is_running").val() != undefined ) { }
									else { vpb_open_chat(from_username, to_username, to_fullname); }
								}
							}
						}
					});
				}
				else {}
				if( vpb_c_users_d != "" && vpb_c_users_d != undefined ) {
					var vpb_each_arena = $.each( vpb_c_users_d, function( index, each_u_data ) {
						var each_user_d  = each_u_data.split(':');
						var from_username = each_user_d[0];
						var to_username = each_user_d[1];
						var to_fullname = each_user_d[2];
						if(from_username == '' || from_username == undefined || to_username == '' || to_username == undefined || to_fullname == '' || to_fullname == undefined ) {}
						else {
							// Track typing
							var typingData = 'page=track_show_typing' + '&from_username=' + from_username + '&to_username=' + to_username;
							$.ajax({
								type: "POST",
								url: baseURL+"vasplus_chat/vasplus_chat.php",
								data: typingData,
								cache: false,
								success: function(user_is_typing_response) {
									var vpb_system_response = user_is_typing_response.indexOf('DISABLED_CHAT_TEMPORARILY');
									if( vpb_system_response != -1 ) { return false; }
									
									var user_is_typing_status = user_is_typing_response.split(':');
									var typing_status = user_is_typing_status[0];
									var typed_message = user_is_typing_status[1];
									
									if( typing_status == 'continue' ) {
										if( $('#user_is_typing'+to_username).val() == typed_message ) {
											var dataStrengs = 'page=track_stop_typing' + '&from_username=' + from_username + '&to_username=' + to_username;
											$.ajax({
												type: "POST",
												url: baseURL+"vasplus_chat/vasplus_chat.php",
												data: dataStrengs,
												cache: false,
												success: function(stopped_typing_response) {
													var status_b = stopped_typing_response.indexOf('completed');
													if(stopped_typing_response != -1) {
														$("#seen_or_typing_"+to_username).html('');
													}
													else {}
												}
											});


										} else {
											$("#seen_or_typing_"+to_username).html('<div align="left" style="padding-left:6px;padding-bottom:5px;">'+to_username.substr(0, 17)+' is typing...</div>');
											$('#user_is_typing'+to_username).val(typed_message);
											vpb_chat_header_notification(".header", "stop");
										}
									} else {
										// Check Read,Seen Notifications
										if ( $("#vpb_message_box"+to_username).length > 0 )  {
											var seenData = 'page=track_chat_responses' + '&from_username=' +from_username + '&to_username=' + to_username;
											$.ajax({
												type: "POST",
												url: baseURL+"vasplus_chat/vasplus_chat.php",
												data: seenData,
												cache: false,
												success: function(user_has_seen_response) {
													var first_response_brought = user_has_seen_response.indexOf('Seen');
													if( first_response_brought != -1 ) {
														var user_has_seen_status = user_has_seen_response.split('&');
														var seen_id = user_has_seen_status[0];
														var seen_message = user_has_seen_status[1];
														if($("#user_has_seen_message"+to_username).val() == seen_id) {
															if($("#seen_or_typing_"+to_username).text().indexOf('typing...') != -1) 
															{
																$("#seen_or_typing_"+to_username).html('');
																vpb_chat_header_notification(".header", "stop");
															}
															else {}
														} else {
															$("#seen_or_typing_"+to_username).show().html('<div align="left"><span class="vpb_read_icons"></span>Seen <span>'+seen_message+'</span></div>');
															vpb_chat_header_notification("#header_"+to_username, "start");
															$("#user_has_seen_message"+to_username).val(seen_id);
														}
													} else {
														if($("#seen_or_typing_"+to_username).text().indexOf('typing...') != -1) {
															$("#seen_or_typing_"+to_username).html('');
															vpb_chat_header_notification(".header", "stop");
														}
														else {}
														
														var second_response_brought = user_has_seen_response.indexOf('newchatmessagenotification');
														if( second_response_brought != -1 ) 
														{
															if ( vpb_active_page != 'active' ) {
																if( to_fullname != "" && to_fullname != undefined ) {
																	vpb_chat_page_title(to_fullname+' says...');
																	vpb_chat_header_notification("#header_"+to_username, "start");
																} else {
																	vpb_chat_page_title('New chat message...');
																}
																$('#vasplusChatAudio')[0].play();
															} else {
																// Minimized or Maximized
																if( $.cookie('vpb_chat_min_or_max_status') != "" && $.cookie('vpb_chat_min_or_max_status') != null && $.cookie('vpb_chat_min_or_max_status') != undefined ) {
																	vpb_min_max_box = $.cookie('vpb_chat_min_or_max_status').split(/\,/);
																	var vpb_is_minimized;
																	for (var vpb_mm=0;vpb_mm<vpb_min_max_box.length;vpb_mm++) {
																		if(vpb_min_max_box[vpb_mm] == to_username)
																		{
																			vpb_is_minimized = 1;
																		}
																		else { vpb_is_minimized = 0; }
																	}
																	if( vpb_is_minimized == 1 ){
																		vpb_chat_header_notification("#header_"+to_username, "start");
																		$('#vasplusChatAudio')[0].play();
																	} else {
																		var dataupdater = {'page':'track_chat_update', 'from_username':from_username, 'to_username':to_username, 'last_chat_message_id_displayed':$("#last_chat_message_id_displayed"+to_username).val(), 'last_chat_message_updated':$("#last_chat_message_updated"+to_username).val()};
																		$.post(baseURL+'vasplus_chat/vasplus_chat.php', dataupdater,  function(responsebrgt)
																		{
																			$("#vpb_from_and_to_last_message_updated_data"+to_username).html(responsebrgt);
																		});
																		
																		document.title = vpb_original_title_message;
																		$('#vasplusChatAudio')[0].pause(); 
																		vpb_chat_header_notification(".header", "stop");
																	}
																} else {
																	var dataupdater = {'page':'track_chat_update', 'from_username':from_username, 'to_username':to_username, 'last_chat_message_id_displayed':$("#last_chat_message_id_displayed"+to_username).val(), 'last_chat_message_updated':$("#last_chat_message_updated"+to_username).val()};
																	$.post(baseURL+'vasplus_chat/vasplus_chat.php', dataupdater,  function(responsebrgt)
																	{
																		$("#vpb_from_and_to_last_message_updated_data"+to_username).html(responsebrgt);
																	});
																	
																	document.title = vpb_original_title_message;
																	$('#vasplusChatAudio')[0].pause(); 
																	vpb_chat_header_notification(".header", "stop");
																}																
															}
															
														} else {
															document.title = vpb_original_title_message;
															$('#vasplusChatAudio')[0].pause(); 
														} 
													}
												}
											});
										}
										else { /* No chat box is open */ }
									}
								}
							});
							
							$("#vpb_message_box"+to_username).on('mouseenter mouseleave',function(event) {
								if (event.type == "mouseenter") { $.cookie('mouseenter', 'yes', { expires: 365, path: '/' }); } else { $.removeCookie('mouseenter', { path: '/' }); }
							});
							
							//Auto check current session online, offline, busy or unavailable status
							var datasStrngbb = 'page=v_current_session_status' + '&to_username=' + to_username;
							$.ajax({
								type: "POST",
								url: baseURL+"vasplus_chat/vasplus_chat.php",
								data: datasStrngbb,
								cache: false,
								success: function(cresponse) {
									var vpb_system_response = cresponse.indexOf('DISABLED_CHAT_TEMPORARILY');
									if( vpb_system_response != -1 ) { return false; }
									
									var status_of_user_chating_with = cresponse.split(':');
									var user_chating_with_identifier = status_of_user_chating_with[0];
									var user_chating_with_status = status_of_user_chating_with[1];
									if($("#status_of_user_chating_with"+to_username).val() != "" && $("#status_of_user_chating_with"+to_username).val() != undefined ) {
										if( $("#status_of_user_chating_with"+to_username).val() == user_chating_with_identifier ) {}
										else {
											$("#v_current_session_status_"+to_username).html(user_chating_with_status);
											$("#status_of_user_chating_with"+to_username).val(user_chating_with_identifier);
										}
									} else {
										$("#v_current_session_status_"+to_username).html(user_chating_with_status);
										$("#status_of_user_chating_with"+to_username).val(user_chating_with_identifier);
									}
								}
							});
						}
					});
				}
				else {}
				if($("#search_stop_loading").val() != "" && $("#search_stop_loading").val() != null && $("#search_stop_loading").val() != undefined ) {}
				else if($("#from_username_identity").val() == "" || $("#from_username_identity").val() == undefined ) {}
				else {
					//Auto load and display friends box when someone comes comes online and goes offline 
					var dataStrngd = 'page=vpb_load_friends_box' + '&from_username=' + $("#from_username_identity").val();
					var vpb_load_friends_box = $.ajax({
						type: "POST",
						url: baseURL+"vasplus_chat/vasplus_chat.php",
						data: dataStrngd,
						cache: false,
						success: function(response) 
						{
							var vpb_system_response = response.indexOf('DISABLED_CHAT_TEMPORARILY');
							if( vpb_system_response != -1 ) { return false; }
							if($.cookie('username_of_last_user_displayed') == $("#username_of_last_user_saved").val()) {}
							else
							{
								$("#vpb_chat_friends_box").html(response);
								$("#username_of_last_user_saved").val($.cookie('username_of_last_user_displayed'));
							}
						}
					});
					//Count friends online
					var friendsData = 'page=vpb_friends_counter' + '&from_username=' + $("#from_username_identity").val();
					var vpb_friends_counter = $.ajax({
						type: "POST",
						url: baseURL+"vasplus_chat/vasplus_chat.php",
						data: friendsData,
						cache: false,
						success: function(response) {
							var vpb_system_response = response.indexOf('DISABLED_CHAT_TEMPORARILY');
							if( vpb_system_response != -1 ) { return false; }
							if($("#counter_online_users").val() != "" && $("#counter_online_users").val() != undefined ) 
							{
								if($("#counter_online_users").val() == response) {}
								else {
									$("#vpb_counter_result").html(response);
									$("#counter_online_users").val(response);
								}
							} else {
								$("#vpb_counter_result").html(response);
								$("#counter_online_users").val(response);
							}	
						}
					});
				}
				$('#vpb_chats_heart_beat').html(response.msg);
			}
			else 
			{
				// Not on chat page
			}
		}
	}
	var comet = new vpb_start_comet(baseURL+'vasplus_chat/vpb_chat_heart_beat_plain.php');
	comet.connect();
}



// Clear previous chat session
function vpb_destroy_previous_chat_session() {
	$.removeCookie('from_username', { path: '/' });
	$.removeCookie('to_username', { path: '/' });
	$.removeCookie('to_fullname', { path: '/' });
}
//Clear chat box
function vpb_clear_chat_box(from_username, to_username) {
	//if(vpb_timer)
		//clearInterval(vpb_timer);
		
	$("#process_is_running").val('stop'); 
	$("#vpb_message_box"+to_username).html('<center><div align="center" class="loaging_cleared_chats"><img src="'+vpb_image_dir+'vasplus_loading.gif"><br><div align="center" style="padding-top:8px;">Please wait</div></div></center>');
	var dataString = {'page':'close_conversation', 'from_username':from_username, 'to_username':to_username};
	$.post(baseURL+'vasplus_chat/vasplus_chat.php', dataString,  function(response) {
		$("#process_is_running").val(''); 
		$("#vpb_message_box"+to_username).html(''); 
		$("#seen_or_typing_"+to_username).html(''); 
		$("#vpb_chat_message"+to_username).val('').focus(); 
   });
}
//End chat session
function vpb_end_user_chat_session(from_username, to_username, to_fullname) 
{
	$("#process_is_running").val('stop');
	setTimeout(function() {
		$.removeCookie('from_username', { path: '/' });
		$.removeCookie('to_username', { path: '/' });
		$.removeCookie('to_fullname', { path: '/' });
		
		
		var dataString = {'page':'close_conversation', 'from_username':from_username, 'to_username':to_username};
		$.post(baseURL+'vasplus_chat/vasplus_chat.php', dataString,  function(response) 
		{
			$("#process_is_running").val('');
			$("#vpb_message_box"+to_username).html('');
		});
	},100);
	
	
	vpb_c_boxes.splice(vpb_c_boxes.indexOf(to_username), 1);
	if( vpb_c_users_d == "" || vpb_c_users_d == null || vpb_c_users_d == undefined ) 
	{
		if( $.cookie('vpb_chat_users_array') != "" && $.cookie('vpb_chat_users_array') != null && $.cookie('vpb_chat_users_array') != undefined )
		{
			vpb_c_users_d[vpb_c_users_d.length] = $.cookie('vpb_chat_users_array');
		}
		else { }
	}
	else { }
	
	
	var vpb_chat_user_info = from_username+':'+to_username+':'+to_fullname;
	vpb_c_users_d.splice(vpb_c_users_d.indexOf(vpb_chat_user_info), 1);
	$.cookie('vpb_chat_users_array', vpb_c_users_d, { expires: 365, path: '/' });
	
	// Min and Max
	vpb_min_max_box.splice(vpb_min_max_box.indexOf(to_username), 1);
	$.cookie('vpb_chat_min_or_max_status', vpb_min_max_box, { expires: 365, path: '/' });
	
	$('#vpb_chat_box_'+to_username).css('display','none');	
	$('#vpb_chat_box_'+to_username).remove();
	vpb_position_chat_box();
	return;
}


//Show/Hide Smiley Box
function vpb_d_smiley_box(to_username) {
	var vpb_box_state = $('#vpb_smiley_box_'+to_username).css('display');
	if(vpb_box_state == 'block') {
		$('#vpb_smiley_box_'+to_username).slideUp(); 
	} else {
		$('.vpb_smiley_box_wrapper').slideUp(); 
		$('#vpb_smiley_box_'+to_username).slideDown(); 
	}
}
//Add smiley to chat box when clicked on
function vpb_add_chat_smiley_a(to_username, smiley) {
	var old_chat_message = $('#vpb_chat_message'+to_username).val();
	if(old_chat_message == "") {
		$('#vpb_chat_message'+to_username).focus();
		$('#vpb_chat_message'+to_username).val(smiley);
	}
	else
	{
		$('#vpb_chat_message'+to_username).focus();
		$('#vpb_chat_message'+to_username).val(old_chat_message+' '+smiley);
	}
}
//Chat box min/max
function vpb_min_and_max_chat_box(to_username) 
{
	$('#vpb_smiley_box_'+to_username).hide(); 
	if ($('#vpb_chat_bx_inner_'+to_username).css('display') == 'none') 
	{
		vpb_min_max_box.splice(vpb_min_max_box.indexOf(to_username), 1);
		$.cookie('vpb_chat_min_or_max_status', vpb_min_max_box, { expires: 365, path: '/' });
		
		$('#vpb_max_chat_'+to_username).hide();
		$('#vpb_min_chat_'+to_username).show();
		
		vpb_chat_header_notification(".header", "stop");
		$('#vasplusChatAudio')[0].pause();
		
		$('#vpb_chat_bx_inner_'+to_username).slideToggle();
		$("#vpb_message_box"+to_username).scrollTop($("#vpb_message_box"+to_username)[0].scrollHeight); $("#vpb_chat_message"+to_username).focus();
		
	} else {
		
		var v_data_found = 0;
		if ($.cookie('vpb_chat_min_or_max_status') != "" && $.cookie('vpb_chat_min_or_max_status') != null && $.cookie('vpb_chat_min_or_max_status') != undefined) 
		{
			vpb_min_max_box[vpb_min_max_box.length] = to_username;
			if( vpb_min_max_box == "" || vpb_min_max_box == null || vpb_min_max_box == undefined ) {}
			else { $.cookie('vpb_chat_min_or_max_status', vpb_min_max_box, { expires: 365, path: '/' }); } 
		}
		else
		{
			if( vpb_min_max_box == "" || vpb_min_max_box == null || vpb_min_max_box == undefined ) 
			{
				vpb_min_max_box[vpb_min_max_box.length] = to_username;
				if( vpb_min_max_box == "" || vpb_min_max_box == null || vpb_min_max_box == undefined ) {}
				else { $.cookie('vpb_chat_min_or_max_status', vpb_min_max_box, { expires: 365, path: '/' }); } 
			}
			else 
			{
				for (j=0;j<vpb_min_max_box.length;j++) {
					if (vpb_min_max_box[j] == to_username) {
						v_data_found = 1;
					}
				}
				
				if(v_data_found == 1) {}
				else
				{
					vpb_min_max_box[vpb_min_max_box.length] = to_username; 
					if( vpb_min_max_box == "" || vpb_min_max_box == null || vpb_min_max_box == undefined ) {}
					else { $.cookie('vpb_chat_min_or_max_status', vpb_min_max_box, { expires: 365, path: '/' }); } 
				}
			} 
		}
		
		$('#vpb_min_chat_'+to_username).hide();
		$('#vpb_max_chat_'+to_username).show();
		
		$('#vpb_chat_bx_inner_'+to_username).slideToggle();
	}
}


(function($) {
$(window).load(function(){
jQuery(document).ready(function($){
	$.cookie('vpb_loaded_friends_box','yes', { expires: 365, path: '/' });
	
	if ($("#vpb_chat_pop_up_background").length > 0) {} else { $('<div id="vpb_chat_pop_up_background"></div><div id="vpb_chat_photo_enlargement_wrapper" style="display:none;"><div id="enlarged_photo_displayer"></div></div><div id="vpb_main_right_chat_box"></div><div class="vpb_chat_main_box_wrapper" id="vpb_chat_main_box"><div id="vpb_headers" class="headers" onclick="vpb_hide_chat_sidebar(\'hide\');">Chat </div><div id="vpb_chat_friends_box" class="vpb_chat_friends_box_class"></div><div id="main_chat_bottom_box"><div style="padding:5px;" id="vpb_search_box_wrap" class="vpb_search_box_wrapper"><span class="vpb_chat_search" style="margin-top:3px;" onclick="vpb_chat_focus_search_box();"></span> <input type="text" id="vasplus_chat_users_search" placeholder="Search" /><span id="vpbchatoptionandbar"><span class="vpb_chat_hide_sidebar_and_options_box" title="Hide Sidebar" onclick="vpb_hide_chat_sidebar(\'hide\');"><span class="vpb_chat_hide_sidebar_icons"></span></span><span class="vpb_chat_hide_sidebar_and_options_box" title="Options" onclick="vpb_chat_option_boxed();"><span class="vpb_chat_options_icons"></span></span></span></div></div></div><div class="vpb_chat_options_box"><div id="vpb_chat_options_inner_box" align="left" onclick="vpb_set_selected_chat_option(\'Online\');"><div style="float:left; width:25px" align="left"><span id="vpb_c_Online" class="vpb_chat_option_boxes_icons"></span>&nbsp;</div><div style="float:left;">Set status to Online</div><br clear="all" /></div><div id="vpb_chat_options_inner_box" align="left" onclick="vpb_set_selected_chat_option(\'Offline\');"><div style="float:left; width:25px" align="left"><span id="vpb_c_Offline" class="vpb_chat_option_boxes_icons"></span>&nbsp;</div><div style="float:left;">Set status to Offline</div><br clear="all" /></div><div id="vpb_chat_options_inner_box" align="left" onclick="vpb_set_selected_chat_option(\'Busy\');"><div style="float:left; width:25px" align="left"><span id="vpb_c_Busy" class="vpb_chat_option_boxes_icons"></span>&nbsp;</div><div style="float:left;">Set status to Busy</div><br clear="all" /></div><div id="vpb_chat_options_inner_box" align="left" onclick="vpb_set_selected_chat_option(\'Off\');"><div style="float:left; width:25px" align="left"><span id="vpb_c_Off" class="vpb_chat_option_boxes_icons"></span>&nbsp;</div><div style="float:left;">Turn off chat</div><br clear="all" /></div></div><div class="vpb_chat_main_box_b_wrapper" onclick="vpb_show_main_box_b();" id="vpb_chat_main_box_b"><span class="vpb_bottom_chat_icon"></span> <span style="float:left; margin-left:5px; padding-bottom:2px; color:#666;">Chat (<span id="vpb_counter_result">0</span>)</span><div style="clear:both;"></div></div><div id="vpb_chats_heart_beat" style="display:none;"></div><audio id="vasplusChatAudio"><source src="vasplus_chat/vpb_sound/funny_baby.mp3" type="audio/mpeg"></audio><input type="hidden" id="search_stop_loading" value="" /><input type="hidden" id="process_is_running" value="" /><input type="hidden" id="counter_online_users" value="" /><input type="hidden" id="username_of_last_user_saved" value="" />').appendTo($( "body" )); }
	
	// Default name and photo of the from_username
		var vpb_from_user_d = {'page':'vpb_get_from_user_d', 'from_username':$("#from_username_identity").val()};
		$.post(baseURL+'vasplus_chat/vasplus_chat.php', vpb_from_user_d,  function(response) {
			var vpb_system_response = response.indexOf('DISABLED_CHAT_TEMPORARILY');
			if( vpb_system_response != -1 ) {}
			else { $(response).appendTo($( "body" )); }
		});
		vpb_image_dir = $("#vpb_image_directory_path").val(); vpb_smiley_dir = $("#vpb_smileys_directory_path").val();
		setTimeout(function() { vpb_image_dir = $("#vpb_image_directory_path").val(); vpb_smiley_dir = $("#vpb_smileys_directory_path").val(); 
		
	$.post(baseURL+'vasplus_chat/vasplus_chat.php', {'page':'system_general_check'},  function(general_response) {
		var vpb_system_general_response = general_response.indexOf('DISABLED_CHAT_TEMPORARILY');
		if( vpb_system_general_response != -1 ) { vpb_open_chat('', '', ''); return false; }
		else {
			if( $.cookie('vpb_chat_users_array') != "" && $.cookie('vpb_chat_users_array') != null && $.cookie('vpb_chat_users_array') != undefined ) {
				var vpb_n_box = new Array();
				vpb_n_box = $.cookie('vpb_chat_users_array').split(/\,/);
				for (var vpb_o=0;vpb_o<vpb_n_box.length;vpb_o++) {
					if(vpb_n_box[vpb_o] != "") {
						var live_user_datas = vpb_n_box[vpb_o].split(':');
						var from_usernamed = live_user_datas[0]; 
						var to_usernamed = live_user_datas[1]; 
						var to_fullnamed = live_user_datas[2]; 
						
						if( from_usernamed != "" && from_usernamed != undefined && to_usernamed != "" && to_usernamed != undefined && to_fullnamed != "" && to_fullnamed != undefined ) {
							vpb_open_chat(from_usernamed, to_usernamed, to_fullnamed); 
						} else {}
					} else {}
				}
			} else {}
		}
	});
	
	$.post(baseURL+'vasplus_chat/vasplus_chat.php', {'page':'vpb_datas'},  function() {});
	//Auto check user sidebar settings
	if( $("#from_username_identity").val() != "" && $("#from_username_identity").val() != undefined )  {
		var sidebarData = {'page':'vpb_track_user_sidebar', 'from_username':$("#from_username_identity").val()};
		$.post(baseURL+'vasplus_chat/vasplus_chat.php', sidebarData,  function(response) 
		{
			var vpb_system_response = response.indexOf('DISABLED_CHAT_TEMPORARILY');
			if( vpb_system_response != -1 ) {}
			else {
				var response_broght = response.indexOf('show');
				if( response_broght != -1 ) {
					$("#vpb_chat_main_box_b").hide();
					$("#vpb_chat_main_box").show();
						
				} else {
					$("#vpb_chat_main_box").hide();
					$("#vpb_chat_main_box_b").show();
				}
			}
		});
		
		
		//Load and display friends box on page load
		vpb_load_chat_friends_box();
	
		//Auto check from_username status and tick the appropriate option
		var v_box_is_ticked_data = {'page':'v_box_is_ticked', 'from_username':$("#from_username_identity").val()};
		$.post(baseURL+'vasplus_chat/vasplus_chat.php', v_box_is_ticked_data,  function(response) 
		{
			$(".vpb_chat_option_boxes_icons").hide();
			$("#vpb_c_"+response).show();
		});
		
		//Count friends online
		var vpb_friends_counter_data = 'page=vpb_friends_counter' + '&from_username=' + $("#from_username_identity").val();
		$.ajax({
			type: "POST",
			url: baseURL+"vasplus_chat/vasplus_chat.php",
			data: vpb_friends_counter_data,
			cache: false,
			success: function(response) {
				var vpb_system_response = response.indexOf('DISABLED_CHAT_TEMPORARILY');
				if( vpb_system_response != -1 ) {}
				else {
					if($("#counter_online_users").val() != "" && $("#counter_online_users").val() != undefined ) 
					{
						if($("#counter_online_users").val() == response) {}
						else {
							$("#vpb_counter_result").html(response);
							$("#counter_online_users").val(response);
						}
					} else {
						$("#vpb_counter_result").html(response);
						$("#counter_online_users").val(response);
					}	
				}
			}
		});
	}
	else {}
	},20000);
	$('.vpb_chat_messages').on('mouseenter mouseleave',function(vpb_evet) {
		var to_username = $(this).attr('id').replace('vpb_message_box', '');
		if (vpb_evet.type == "mouseenter")  {
			$.cookie('mouseenter', 'yes', { expires: 365, path: '/' });
			$('#vpb_message_box'+to_username).css('overflow-y','auto');
		} else {
			$.removeCookie('mouseenter', { path: '/' });
			$('.vpb_chat_messages').css('overflow-y','hidden');
		}
	});
	$('.vpb_chat_friends_box_class').css('overflow-y','hidden');
	$('.vpb_chat_friends_box_class').on('mouseenter mouseleave',function(vpb_evt) {
		if (vpb_evt.type == "mouseenter")  {
			$('.vpb_chat_friends_box_class').css('overflow-y','auto');
		} else {
			$('.vpb_chat_friends_box_class').css('overflow-y','hidden');
		}
	});
	$('#vasplus_chat_users_search').on('click',function()  {
		$(".vpb_chat_options_box").hide();
		$("#vpbchatoptionandbar").hide();
		$("#vpb_search_box_wrap").removeClass('vpb_search_box_wrapper');
		$("#vpb_search_box_wrap").addClass('vpb_search_box_wrappers');
		$("#vasplus_chat_users_search").css('width','165px');
	});
	$('#vasplus_chat_users_search').on('keyup',function() {
		var searchTerm = $(this).val();
		if( searchTerm == "" || searchTerm == "Search") {
			$("#search_stop_loading").val('');
			vpb_load_chat_friends_box();
			return false;
		}
		else if(searchTerm.length>parseInt(15)) {
			$("#search_stop_loading").val('searching');
			$("#vpb_chat_friends_box").html('<div style="padding:10px;">No friend was found</div>');
			return false;
		} else {
			var dataString = 'page=vpb_chat_search_for_people' + '&from_username='+ $("#from_username_identity").val() + '&searchTerm=' + searchTerm;
			$.ajax({
				type: 'POST',
				url: baseURL+'vasplus_chat/vasplus_chat.php',
				data: dataString,
				cache: true,
				beforeSend: function() 
				{
					$("#search_stop_loading").val('stop');
					$("#vpb_chat_friends_box").show().html('<center><div align="center" class="loaging_cleared_chats"><img src="'+vpb_image_dir+'vasplus_loading.gif"><br><div align="center" style="padding-top:8px;">Please wait</div></div></center>');
				},
				success: function(response) 
				{
					var vpb_system_response = response.indexOf('DISABLED_CHAT_TEMPORARILY');
					if( vpb_system_response != -1 ) 
					{
						$("#search_stop_loading").val('');
						vpb_load_chat_friends_box();
						return false; 
					}
				
					$("#search_stop_loading").val('searching');
					var response_brought = response.indexOf('VPB ERROR');
					if(response_brought != -1)
					{
						$("#vpb_chat_friends_box").html(response);
						return false;
					} 
					else  {
						var responsebrought = response.indexOf('Chat is turnd off');
						if(responsebrought != -1) {
							$(".headers").css("opacity","0.6");  
						} else {
							$(".headers").css("opacity","1"); 
						}
						$("#vpb_chat_friends_box").html(response);
						return false;
					}
				}
			});
		}
	});
	//Hide chat option box when a user clicks outside the box
	$("html,body").click(function(e){
		vpb_chat_header_notification(".header", "stop");
		if(e.target.className !== "vpb_chat_options_box" && e.target.className !== "vpb_chat_hide_sidebar_and_options_box" && e.target.className !== "vpb_chat_options_icons" && e.target.id !== "vasplus_chat_users_search" && e.target.className !== "vpb_chat_search" && e.target.className !== "vpb_chat_friends_box_class" && e.target.className !== "vpb_friends_main_box" && e.target.id !== "main_chat_bottom_box" && e.target.id !== "vpb_chat_friends_box" && e.target.className !== "vpb_friends_main_box_b" && e.target.className !== "inner" && e.target.id !== "vpb_chat_main_box" && e.target.id !== "searchResult" && e.target.id !== "searchResults" && e.target.id !== "searchResultss" && e.target.id !== "searchResultsss") 
		{
			$(".vpb_chat_options_box").hide(); 
			$("#vasplus_chat_users_search").css('width','120px');
			$("#vpbchatoptionandbar").show();
			
			$("#vpb_search_box_wrap").removeClass('vpb_search_box_wrappers');
			$("#vpb_search_box_wrap").addClass('vpb_search_box_wrapper');
			$("#vasplus_chat_users_search").val('');
			$("#search_stop_loading").val('');
		} 
		else  { }
	});
	$(".vpb_chat_messages").on('click', function() {
		var to_username = $(this).attr('id').replace('vpb_message_box', '');
		vpb_chat_header_notification("#header_"+to_username, "stop");
		if ($('#vpb_message_box'+to_username).css('display') != 'none') {
			if(vpb_text_selected() == "") { $("#vpb_chat_box_"+to_username+" .vpb_chat_message").focus(); } else {}
		}
	});
	$(".vpb_chat_message").on('click', function() {});
	$(".vpb_chat_message").on("keypress", function() {
		var to_username = $(this).attr('id').replace('vpb_chat_message', '');
		if($("#from_username_identity").val() == "" || $("#from_username_identity").val() == undefined || to_username == "" || to_username == undefined || $("#vpb_chat_message"+to_username).val() == "" || $("#vpb_chat_message"+to_username).val() == undefined ) {}
		else {
			var dataStrng = {'page':'track_save_typing', 'from_username':$("#from_username_identity").val(), 'to_username':to_username, 'message':$("#vpb_chat_message"+to_username).val()};
			$.post(baseURL+'vasplus_chat/vasplus_chat.php', dataStrng,  function(response) { return false; });
		}
	});
	vpb_original_title_message = document.title;
	$.vpb_chat_info_alert_wrap = function(vpb_contents) {
		if($('#vpb_chat_confirmation_alert_box').length) { return false; } else { var VPB_CHAT_BOX_POP_LOADS = ['<div id="vpb_chat_confirmation_alert_box">','<div id="vpb_chat_confirmation_alert_box_contents">','<div id = "vpb_chat_confirmation_alert_box_headers">'+vpb_contents.vpb_confirmation_heading+'</div>','<p>'+vpb_contents.vpb_confirmation_body+'</p>','<center><div id="vpb_chat_confirmation_buttons"><center><div align="center"><span class="vpb_ok_or_cancel_button" onClick="vpb_chat_info_alert_seen();">'+vpb_contents.vpb_proceed_button+'</span></div><center></div><center></div></div>'].join(''); $(VPB_CHAT_BOX_POP_LOADS).hide().fadeIn('fast').appendTo('body'); } }; 
$("#vpb_chat_pop_up_background").click(function() { $('#vpb_chat_photo_enlargement_wrapper').hide(); $("#vpb_chat_pop_up_background").fadeOut(); });
			vpb_chat_xmlhttp_stream();
		});
	});
})(jQuery);

// Position any pop up box - You don't need to modify any thing in this function as everything is dynamic
function vasplus_centralized_box(vpb_box_width, vpb_box_height, vpb_box_div_id)
{
	if (document.getElementById('vpb_pbox_width') == null && !isNaN(parseInt(vpb_box_width)) && vpb_box_div_id != undefined ) 
	{
		var _vpb_new_div_creat_ = document.createElement('div');
		var vpb_hidden_body_items = '<input type="hidden" id="vpb_pbox_width" value="'+parseInt(vpb_box_width)+'"><input type="hidden" id="vpb_pbox_height" value="'+parseInt(vpb_box_height)+'"><input type="hidden" id="vpb_pbox_div_id" value="'+vpb_box_div_id+'">'; 
		_vpb_new_div_creat_.innerHTML = vpb_hidden_body_items;
		document.body.appendChild(_vpb_new_div_creat_);
	} 
	else 
	{
		if(document.getElementById('vpb_pbox_width') != null && !isNaN(parseInt(vpb_box_width)) && !isNaN(parseInt(vpb_box_height)) && vpb_box_div_id != undefined )
		{
			document.getElementById('vpb_pbox_width').value = vpb_box_width;
			document.getElementById('vpb_pbox_height').value = vpb_box_height;
			document.getElementById('vpb_pbox_div_id').value = vpb_box_div_id;
		}
		else {}
	}
	
	if (document.getElementById('vpb_pbox_width') != null && document.getElementById('vpb_pbox_width') != undefined )
	{
		var vpb_pbox_width = vpb_box_width != undefined && vpb_box_width != null ? vpb_box_width : document.getElementById('vpb_pbox_width').value;
		var vpb_pbox_height = vpb_box_height != undefined && vpb_box_height != null ? vpb_box_height : document.getElementById('vpb_pbox_height').value;
		var vpb_pbox_div_id = vpb_box_div_id != undefined && vpb_box_div_id != null ? vpb_box_div_id : document.getElementById('vpb_pbox_div_id').value;
		
		var winW = window.innerWidth;
		var winH = window.innerHeight;
		var vpb_pop_up_box_wrap = document.getElementById(vpb_pbox_div_id);
		vpb_pop_up_box_wrap.style.left = (winW/2) - (parseInt(vpb_pbox_width) * .5)+"px";
		vpb_pop_up_box_wrap.style.top = parseInt(vpb_pbox_height)+"px";//(winH/2) - (parseInt(vpb_pbox_height) * .5)+"px"; 
		//vpb_pop_up_box_wrap.style.display = "block";
	}
	else {}
	
}
window.onresize = function() { vasplus_centralized_box(); };