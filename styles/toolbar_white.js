/*
 * TOOLBAR STYLE TEMPLATE
 *
 * This file controls aspects of FCChat's layout and appearance.
 * 
 * In this file comments are preceded by double slashes ie.
 *      //THIS IS A COMMENT
 *      
 * Refer to the product manual for info regarding how to effectively make changes to the
 * style template:
 * 
 * http://www.fastcatsoftware.com/chat/manual.html
 * 
 * To use this template, edit FCChat/config/config.js as follows:
 * 
 *  //STYLE
 *	toolbar_style_template:"toolbar_default.js",
 * 
 * If you create a decent style template. Please email us the template at 
 * support@fastcatsoftware.com
 */

(function(){
jGo.fcchat_toolbar.style={
		height:35,
		border_height:2,
		css:"-webkit-box-shadow:0px 0px 8px 2px rgba(0,0,0,0.4);box-shadow:0px 0px 8px 2px rgba(0,0,0,0.4);background-color:#fefefe;border-top: 2px solid darkblue;border-bottom: 2px solid darkblue;triangle-color:darkblue;",
		banner_css:{"background-color":"#fff","border-bottom":"2px solid #eeeeee","border-top":"1px solid #fff"},
		mobile_banner:{
			title:"color:green;",
			links:"background-color:darkblue;color:#fff;"
		},
		alt_css:"border-right:1px solid #cccccc;border-left:1px solid #cccccc;",
		text_size:"font-size:8pt",
		text:"color:#444444;font-size:8pt;font-family:arial;font-weight:bold;",
		dialog_box:{
			css:"-webkit-box-shadow:0px 0px 6px 2px rgba(0,0,0,0.4);box-shadow:0px 0px 6px 2px rgba(0,0,0,0.4);background-color:#fefefe;",
			alt_css:"border:1px solid darkblue;",
			title_box_css:"top:0px;left:0px;height:40px;background-color:#2E9FFF;border-bottom:1px solid #cccccc;",
			list_divider_css:"border-bottom:1px solid transparent;",
			select_user:{
				over_color:"#f0f9ff",
				off_color:"transparent",
				selected_color:"#d3ffd3"
			},
			text:{
				css:"font-family:arial;font-size:12px;color:#444444;",
				title_css:"font-weight:bold;color:white;",
				link_css:"color:white;",
				disabled_css:"color:#dddddd;",
				secondary_link_css:"color:#528DC4;text-decoration:none;",
				screen_name_css:"font-family:arial;font-size:10pt;color:green;font-weight:700;text-decoration:none;",
				timestamp_css:"color:green;",
				info:"color:gray;font-style:italic;",
				user_info_css:"color:#888888;",
				offline_css:"font-style:italic;color:green;"
			}
		},
		menus:{
			user_options:{
				position:{
					left:null,
					top:null,
					offsetLeft:0,
					offsetTop:0
				},
				css:{
					width:"200px",
					height:"230px",
					"-webkit-box-shadow": "2px 2px 2px 1px rgba(0,0,0,0.5)",
					"box-shadow": "2px 2px 2px 1px rgba(0,0,0,0.5)",
					"background-color":"#fff",
					border:"1px solid silver"
				},
				menu_item:{
					dim:"width:200px;height:30px;",
					css:"padding:8px;font:10pt arial;font-weight:bold;",
					link_color:"#444444",
					link_css:"text-decoration:none",
					disabled_link_color:"#999999",
					hover_color:"#f0f9ff",
					hide_icon:{
						css:"color:#444444;font-stretch:wider;font-size:16px;font-weight:bold;text-decoration:none"
					}
				}
			},
			set_availability:{
				position:{
					left:null,
					top:null,
					offsetLeft:50,
					offsetTop:30
				},
				css:{
					width:"200px",
					height:"80px",
					"-webkit-box-shadow": "2px 2px 2px 1px rgba(0,0,0,0.5)",
					"box-shadow": "2px 2px 2px 1px rgba(0,0,0,0.5)",
					"background-color":"#eeeeee",
					border:"1px solid silver"
				},
				menu_item:{
					css:"padding:8px;font:10pt arial;",
					hide_icon:{
						css:"color:#444444;font-stretch:wider;font-size:16px;font-weight:bold;text-decoration:none"
					}
				}
			},
			mod_menu:{
				position:{
					left:null,
					top:null,
					offsetLeft:40,
					offsetTop:30
				},
				css:{
					width:"200px",
					height:"200px",
					"-webkit-box-shadow": "2px 2px 2px 1px rgba(0,0,0,0.5)",
					"box-shadow": "2px 2px 2px 1px rgba(0,0,0,0.5)",
					"background-color":"#fff",
					border:"1px solid silver"
				},
				menu_item:{
					dim:"width:200px;height:30px;",
					css:"padding:8px;font:10pt arial;font-weight:bold;",
					link_color:"#444444",
					link_css:"text-decoration:none",
					disabled_link_color:"#999999",
					hover_color:"#f0f9ff",
					hide_icon:{
						css:"color:#444444;font-stretch:wider;font-size:16px;font-weight:bold;text-decoration:none"
					}
				}
			},
			set_signature:{
				position:{
					left:null,
					top:null,
					offsetLeft:50,
					offsetTop:30
				},
				css:{
					width:"200px",
					height:"85px",
					"-webkit-box-shadow": "2px 2px 2px 1px rgba(0,0,0,0.5)",
					"box-shadow": "2px 2px 2px 1px rgba(0,0,0,0.5)",
					"background-color":"#eeeeee",
					border:"1px solid silver"
				},
				menu_item:{
					css:"padding:9px;font:10pt arial;",
					set_notice:{
						css:"color:green;font-weight:bold;font-style:italic"
					},
					hide_icon:{
						css:"color:#444444;font-stretch:wider;font-size:16px;font-weight:bold;text-decoration:none"
					}
				}
			},
			set_nickname:{
				css:"font:10pt arial;width:300px;-webkit-box-shadow: 0px 0px 2px 2px rgba(0,0,0,0.5);box-shadow: 0px 0px 2px 2px rgba(0,0,0,0.5);background-color:#eeeeee;padding:15px;border:1px solid black;-moz-border-radius: 2px;-webkit-border-radius: 2px;border-radius:2px;",
				menu_item:{
					link_css:"font:10pt arial;",
					input_css:"width:290px;",
					set_notice:{
						css:"color:green;font-weight:bold;font-style:italic"
					}
				}
			}
		},
		divider_css:"top:0px;width:4px;height:35px;background-color:transparent;",
		icons_16px:{
			top:10
		},
		icon_tray:{
			width:FCChatConfig.blog?0:105,
			minimize_icon:{
				top:10,
				offset:35,
				css:"color:#444444;font-stretch:wider;font-size:8pt;font-weight:bold;text-decoration:none;"
			},
			restore:{
				width:40
			},
			hide_icon:{
				top:10,
				offset:15,
				css:"color:#444444;font-stretch:wider;font-size:8pt;font-weight:bold;text-decoration:none;"
			}
		}
	};

function applyQuickStyles(){
	var d = FCChatConfig.quickstyling;
	if(window["fcchat_domain"]&&d[window["fcchat_domain"]]){
		d = d[window["fcchat_domain"]];
	}else{
		d = d.alldomains;
	}
	var c = d.toolbar;
	var s = "jGo.fcchat_toolbar.style";
	var x = jGo.util.mergeOption;
	var w = c.width_prop_offsets.split(':');
	
	w[0]-=0;
	w[1]-=0;
	w[2]-=0;
	x(s+".css",c.background_css);
	x(s+".text",c.base_font_css);
	x(s+".divider_css",c.divider_css);
	x(s+".icon_tray.minimize_icon.css",c.base_font_css);
	x(s+".icon_tray.hide_icon.css",c.base_font_css);
	x(s+".icon_tray.minimize_icon.top",c.text_top_offset);
	x(s+".icon_tray.hide_icon.top",c.text_top_offset);
	x(s+".icon_tray.restore.width",w[2]);
	
	c = d.dialog;

	s = "jGo.fcchat_toolbar.style.dialog_box";
	x(s+".css",c.border_css);
	x(s+".title_box_css",c.title_background_css);
	x(s+".text.title_css",c.title_css);
	x(s+".text.link_css",c.link_css);
};

if(FCChatConfig.blog&&jGo.mobile&&jGo.blogdim.width<395)jGo.util.mergeOption("jGo.fcchat_toolbar.style.text","font-size:100%;");
		
applyQuickStyles();	

}());