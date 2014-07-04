/*
 * WIDGET STYLE TEMPLATE
 *
 * This file controls aspects of FCChat's layout and appearance.
 * 
 * In this file comments are preceded by double slashes ie.
 *      //THIS IS A COMMENT
 *      
 * Refer to the product manual for info regarding how to effectively make changes to the
 * style template:
 * 
 * http://www.fastcatsoftware.com/chat/manual.htmk
 * 
 * To use this template, edit FCChat/config/config.js as follows:
 * 
 *  //STYLE
 *	widget_style_template:"widget_default_sidebar.js",
 * 
 * If you create a decent style template. Please email us the template at 
 * support@fastcatsoftware.com
 */
(function(){

	var widget_base_font = "font-family:arial;font-size:12px;color:#444444;";
	var toolbar_base_font = jGo.fcchat_toolbar.style.text;
	
	FCChatConfig.styles.widget={
		control:{
			top:0, //for absolute positioning
			left:310, //"     "
			width:680,
			height:35,
			align_dialogs:false,
			css:"background-color:#eeeeee;-moz-border-radius: 5px;-webkit-border-radius: 5px;border-radius:5px;",
			logo:{
				top:9,
				left:10,
				css:""
			},
			title_box:{
				top:6,
				left:30,
				width:90,
				height:30,
				css:"background-color:transparent;",
				text:{
					css:widget_base_font+";font-weight:bold;font-size:12px;color:#777777;"
				}
			},
			status:{
				css:""
			},
			buttons:{
				top:6,
				left:120,
				width:140,
				height:25,
				default_css:widget_base_font+";text-decoration:none;",
				states:{
					link_css:"color:rgb(22, 125, 200);",
					hover_css:"color:darkblue;",
					disabled_css:"color:#aaaaaa;"
				},
				full_page_button:{
					css:""
				},
				on_off_button:{
					css:"margin-left:20px;"
				}
			},
			info_box:{
				top:6,
				left:260,
				width:450,
				height:25,
				css:"background-color:transparent;",
				linebreak:"",
				text:{
					css:widget_base_font,
					alert_css:widget_base_font+"font-weight:bold;color:green;",
					info_css:widget_base_font+"color:#444444;"
				}
			}	
	    },
		toolbar_item:{
			text:{
				css:toolbar_base_font+"color:#444444;",
				alert_css:toolbar_base_font+"color:red;",
				link_css:toolbar_base_font+"color:#444444;",
				info_css:toolbar_base_font+"color:#3AAACF;"
			},
			buttons:{
				default_css:toolbar_base_font+"text-decoration:none;",
				states:{
					link_css:"color:#444444;",
					hover_css:"color:lightgreen;",
					disabled_css:"color:#a9a9a9;"
				}
			},
			chatcenter_layout:{
				width:FCChatConfig.blog?440:570,
				info_box:{
					width:420,
					css:"height:35px;left:10px;top:0px;",
					padding_top:11
				},
				open_chat_button:{
					top:10,
					left:455
				},
				off_button:{
					top:10,
					left:540
				},
				status:{
					top:15,
					left:400,
					css:""
				},
				divider:{
					top:0,
					left:442,
					css:"width:4px;height:35px;background-color:#fff;"
				}
			},
			msgcenter_layout:{
				width:425,
				info_box:{
					width:300,
					css:"height:30px;left:10px;top:0px;",
					padding_top:11
				},
				open_chat_button:{
					top:10,
					left:332
				},
				off_button:{
					top:10,
					left:400
				},
				status:{
					top:15,
					left:320,
					css:""
				},
				divider:{
					top:0,
					left:322,
					css:"width:4px;height:35px;background-color:transparent;"
				}
			}
		},
		online_box:{
			top:43,
			left:180,
			toolbar_offset:3,
			width:230,
			height:343,
			css:jGo.fcchat_toolbar.style.dialog_box.css,
			title_box_css:jGo.fcchat_toolbar.style.dialog_box.title_box_css,
			greeting_box_css:"top:40px;left:0px;height:40px;border-top:1px solid #cccccc;border-bottom:1px dotted #444444;",
			greeting_box_link:jGo.fcchat_toolbar.style.dialog_box.text.secondary_link_css,
			list_box_css:"top:82px;left:0px;height:193px;",
			list_divider_css:jGo.fcchat_toolbar.style.dialog_box.list_divider_css,
			info_box_css:"top:275px;left:0px;height:67px;border-top:1px dotted #444444;",
			text:jGo.fcchat_toolbar.style.dialog_box.text
		},
		new_messages_box:{
			top:43,
			left:0,
			toolbar_offset:3,
			width:280,
			height:343,
			css:jGo.fcchat_toolbar.style.dialog_box.css,
			title_box_css:jGo.fcchat_toolbar.style.dialog_box.title_box_css,
			greeting_box_css:"top:40px;left:0px;height:40px;border-top:1px solid #cccccc;border-bottom:1px dotted #444444;",
			greeting_box_link:jGo.fcchat_toolbar.style.dialog_box.text.secondary_link_css,
			view_msg_box_css:"top:82px;left:0px;height:193px;margin-top:4px;",
			send_msg_box_css:"top:275px;left:0px;height:67px;border-top:1px dotted #444444;",
			input_css:"height:18px !important;background-color:white !important;border:1px solid silver !important;margin-left:2px !important;color:#44444 !important;",
			text:jGo.fcchat_toolbar.style.dialog_box.text,
			msg_interrupt:{
				css:"background-color:#ededff;",
				respond_css:"font-size:8pt;color:#528DC4;text-decoration:none;",
				close_css:"color:gray;font-stretch:wider;font-size:8pt;font-weight:bold;text-decoration:none;"
			}
		},
		friends_box:{
			top:43,
			left:180,
			toolbar_offset:3,
			width:230,
			height:343,
			css:jGo.fcchat_toolbar.style.dialog_box.css,
			title_box_css:jGo.fcchat_toolbar.style.dialog_box.title_box_css,
			greeting_box_css:"top:40px;left:0px;height:40px;border-top:1px solid #cccccc;border-bottom:1px dotted #444444;",
			greeting_box_link:jGo.fcchat_toolbar.style.dialog_box.text.secondary_link_css,
			list_box_css:"top:82px;left:0px;height:193px;",
			list_divider_css:jGo.fcchat_toolbar.style.dialog_box.list_divider_css,
			info_box_css:"top:275px;left:0px;height:67px;border-top:1px dotted #444444;",
			text:jGo.fcchat_toolbar.style.dialog_box.text
		},
		chatrooms_box:{
			top:43,
			left:240,
			width:(jGo.mobile?300:400),
			height:343,
			css:jGo.fcchat_toolbar.style.dialog_box.css,
			title_box_css:jGo.fcchat_toolbar.style.dialog_box.title_box_css,
			list_box_css:"top:93px;left:0px;height:180px;border-top:1px solid #cccccc;",
			text:jGo.fcchat_toolbar.style.dialog_box.text,
			selected_color:"lightblue",
			hover_color:"#e6e6e6",
			background_color:"transparent",
			separator:"1px solid #dddddd",
			room_name_font_css:"font-size:14px;font-weight:bold;color:#444444;",
			font_css:"color:#444444;font-family:arial;font-weight:normal;font-size:12px;",
			count_font_css:"font-size:14px;color:blue;font-weight:bold;",
			disabled_room_name_font_css:"font-size:14px;font-weight:bold;color:#8888aa;",
			room_passwords:{
				font:{
					textfield_description_css:"font-family:arial;font-size:12px;color:#darkgray;font-style:italic;font-weight:bold;"
				},
				textfield_css:"background-color:white;border:1px solid #444444;padding:5px;color:#444444"
			}
		},
		login_panel:{
			top:43,
			left:5,
			box_shadow:"0px 0px 12px 2px rgba(0,0,0,0.5)",
			background_color:"#eeeeee",
			border:"2px solid gray",
			font:{
				textfield_description_css:{"font-family":"arial","font-size":"10pt",color:"black","font-style":"italic","font-weight":"bold"},
				smalltext_css:{"margin-right":"10px","font-family":"arial","font-size":"10pt",color:"black"}
			},
			textfield_css:"background-color:#dddddd !important;color:#444444 !important;width:180px !important;height:18px !important;"
		}
	};
	
	function applyQuickStyles(){
		var d = FCChatConfig.quickstyling;
		var c;
		var s = "FCChatConfig.styles.widget.control";
		var x = jGo.util.mergeOption;
		if(!window["fcchat_domain"]){
			c=d.alldomains.widget;		
			var w = c.width_prop_offsets.split(':');	
			w[0]-=0;
			w[1]-=0;
			w[2]-=0;
			x(s+".css",c.background_css);
			x(s+".height",c.height_offset);
			x(s+".width",w[0]+w[1]+w[2]);
			x(s+".logo.top",c.logo_top_offset);
			x(s+".logo.left",c.logo_left_offset);
			x(s+".logo.css",c.logo_css);
			x(s+".title_box.height",c.height_offset);
			x(s+".title_box.top",c.text_top_offset);
			x(s+".title_box.width",w[0]);
			x(s+".title_box.css",c.title_css);
			x(s+".title_box.text.css",c.base_font_css+c.title_font_css);
			x(s+".buttons.left",w[0]);
			x(s+".buttons.top",c.text_top_offset);
			x(s+".buttons.height",c.height_offset);
			x(s+".buttons.width",w[1]);
			x(s+".buttons.default_css",c.base_font_css);
			x(s+".buttons.states.link_css",c.link_css);
			x(s+".buttons.states.hover_css",c.link_hover_css);
			x(s+".buttons.states.disabled_css",c.link_disabled_css);
			x(s+".buttons.full_page_button.css",c.full_page_button_css);
			x(s+".buttons.on_off_button.css",c.off_button_css);
			x(s+".info_box.left",w[0]+w[1]);
			x(s+".info_box.top",c.text_top_offset);
			x(s+".info_box.height",c.height_offset);
			x(s+".info_box.width",w[2]);
			x(s+".info_box.css",c.infobox_css);
			x(s+".info_box.text.css",c.base_font_css);
			x(s+".info_box.text.alert_css",c.base_font_css+c.alert_css);
			x(s+".info_box.text.link_css",c.base_font_css+c.link_css);
			x(s+".info_box.text.info_css",c.base_font_css+c.info_css);
			
			s = "FCChatConfig.styles.widget";
			x(s+".online_box.top",c.height_offset);
			x(s+".login_panel.top",c.height_offset);
			x(s+".friends_box.top",c.height_offset);
			x(s+".chatrooms_box.top",c.height_offset);
			x(s+".new_messages_box.top",c.height_offset);
		}
		if(window["fcchat_domain"]&&d[window["fcchat_domain"]]){
			c = d[window["fcchat_domain"]];
		}else{
			c = d.alldomains;
		}
		c = c.toolbar;
		s = "FCChatConfig.styles.widget.toolbar_item";
		var w = c.width_prop_offsets.split(':');
		
		w[0]-=0;
		w[1]-=0;
		w[2]-=0;
		x(s+".text.css",c.base_font_css);
		x(s+".text.link_css",c.base_font_css+c.link_css);
		x(s+".text.alert_css",c.base_font_css+c.alert_css);
		x(s+".text.info_css",c.base_font_css+c.info_css);
		x(s+".buttons.default_css",c.base_font_css);
		x(s+".buttons.states.link_css",c.link_css);
		x(s+".buttons.states.hover_css",c.link_hover_css);
		x(s+".buttons.states.disabled_css",c.link_disabled_css);
		x(s+".chatcenter_layout.info_box.padding_top",c.text_top_offset);
		x(s+".chatcenter_layout.open_chat_button.top",c.text_top_offset);
		x(s+".chatcenter_layout.off_button.top",c.text_top_offset);
		x(s+".msgcenter_layout.info_box.padding_top",c.text_top_offset);
		x(s+".msgcenter_layout.open_chat_button.top",c.text_top_offset);
		x(s+".msgcenter_layout.off_button.top",c.text_top_offset);
		x(s+".chatcenter_layout.width",w[0]+w[1]);
		x(s+".msgcenter_layout.width",w[0]+w[1]);
		x(s+".chatcenter_layout.info_box.width",w[0]);
		x(s+".msgcenter_layout.info_box.width",w[0]);
		x(s+".chatcenter_layout.open_chat_button.left",w[0]);
		x(s+".msgcenter_layout.open_chat_button.left",w[0]);
		x(s+".chatcenter_layout.off_button.left",w[0]+(c.off_button_left_offset||0));
		x(s+".msgcenter_layout.off_button.left",w[0]+(c.off_button_left_offset||0));
		x(s+".chatcenter_layout.status.left",w[0]);
		x(s+".msgcenter_layout.status.left",w[0]);
		x(s+".chatcenter_layout.divider.left",w[0]);
		x(s+".msgcenter_layout.divider.left",w[0]);
		x(s+".chatcenter_layout.divider.css",c.divider_css);
		x(s+".msgcenter_layout.divider.css",c.divider_css);
		
	}

	applyQuickStyles();	

})();
