	$(function() {
		var tinymce_path = default_texteditor_path+'/tiny_mce/';
		
		var options = {
        selector: "textarea.texteditor",
        forced_root_block : "",
		statusbar: false,
        force_br_newlines : true,
        force_p_newlines : false,
        relative_url: false,
        remove_script_host: false,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen media",
            "insertdatetime media table contextmenu paste textcolor"
        ],

        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | styleselect formatselect fontselect fontsizeselect | forecolor backcolor latex",
        entity_encoding : "raw",
        relative_urls: false,
        external_filemanager_path: "/3rdparty/filemanager/filemanager/",
        filemanager_title:"Quản lý file upload" ,

        external_plugins: { "filemanager" :"/3rdparty/filemanager/filemanager/plugin.min.js", "nanospell": "/3rdparty/nanospell/plugin.js"},
        nanospell_server: "php",
        height: 250,
		setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    };
    
    tinymce.init(options);
	
		/*var tinymce_options = {

				// Location of TinyMCE script
				script_url : tinymce_path +"tiny_mce.js",
				
				// General options
				theme : "advanced",
				plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

				// Theme options
				theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
				theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : true,
				entity_encoding : "raw",
				/*
				// Example content CSS (should be your site CSS)
				content_css : "css/content.css",
				*/
				// Drop lists for link/image/media/template dialogs
				/*template_external_list_url : tinymce_path +"lists/template_list.js",
				external_link_list_url : tinymce_path +"lists/link_list.js",
				external_image_list_url : tinymce_path +"lists/image_list.js",
				media_external_list_url : tinymce_path +"lists/media_list.js",

				// Replace values for the template plugin
				template_replace_values : {
					username : "Some User",
					staffid : "991234"
				}
			};
		
		$('textarea.texteditor').init(tinymce_options);
		
		var minimal_tinymce_options = $.extend({}, tinymce_options);
		minimal_tinymce_options.theme = "simple";
		
		$('textarea.mini-texteditor').init(minimal_tinymce_options);*/
		
	});