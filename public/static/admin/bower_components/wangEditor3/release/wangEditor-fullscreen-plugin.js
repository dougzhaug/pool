/**
 * 
 */
window.wangEditor.fullscreen = {
	// editor create之后调用
	init: function(editorSelector){
		$(editorSelector + " .w-e-toolbar").append('<div class="w-e-menu"><i class="_wangEditor_btn_fullscreen fa fa-arrows-alt" href="javascript:void(0);" onclick="window.wangEditor.fullscreen.toggleFullscreen(\'' + editorSelector + '\')"></i></div>');
	},
	toggleFullscreen: function(editorSelector){
		$(editorSelector).toggleClass('fullscreen-editor');
		if($(editorSelector + ' ._wangEditor_btn_fullscreen').hasClass("fa-arrows-alt")){
			$(editorSelector + ' ._wangEditor_btn_fullscreen').removeClass('fa-arrows-alt');
			$(editorSelector + ' ._wangEditor_btn_fullscreen').addClass('fa-compress');
		}else{
            $(editorSelector + ' ._wangEditor_btn_fullscreen').removeClass('fa-compress');
            $(editorSelector + ' ._wangEditor_btn_fullscreen').addClass('fa-arrows-alt');
		}
	}
};