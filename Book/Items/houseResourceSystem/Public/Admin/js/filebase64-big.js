/**
 * 获得base64
 * @param {Object} obj
 * @param {Number} [obj.width] 图片需要压缩的宽度，高度会跟随调整
 * @param {Number} [obj.quality=0.8] 压缩质量，不压缩为1
 * @param {Function} [obj.before(this, blob, file)] 处理前函数,this指向的是input:file
 * @param {Function} obj.success(obj) 处理后函数
 * @example
 *
 */
$.fn.localResizeIMG = function(obj) {
    this.on('change', function() {
        var file = this.files;
        var that = this;
        var URL = window.URL || window.webkitURL;
        var allowExtention=".jpg,.jpeg,.png";//允许上传文件的后缀名.bmp,.gif
		for(var i = 0;i<file.length;i++){
			var extention=file[i].name.substring(file[i].name.lastIndexOf(".")+1).toLowerCase();
			if(!(allowExtention.indexOf(extention)>-1)){
				alert('只允许上传jpg、jpeg、png格式的图片');
				return false;
			}
            if (typeof obj.maxSize != 'undefined' && file[i].size > obj.maxSize) {
				alert('文件大小必须在50KB以内');
				return false;
            }
            var blob = URL.createObjectURL(file[i]);
            var img = new Image();
            img.src = blob;
            img.onload = function() {
                if (this.width != obj.width && this.height != obj.height) {
				    alert('图片尺寸必须为1000*750');
                    return;
                }
                // 执行前函数
                if ($.isFunction(obj.before)) {
                    obj.before(that)
                };
                obj.success(that);
                //_create(blob, file);
                that.value = ''; // 清空临时数据
            }
        	fileimgarr.push(file[i])
        }
    });

    /**
     * 生成base64
     * @param blob 通过file获得的二进制
     */
    
};
// $.fn.localResizeIMG = function(obj) {
//     this.on('change', function() {
//         var file = this.files;

//         var allowExtention=".jpg,.jpeg,.png";//允许上传文件的后缀名.bmp,.gif
// 		for(var i = 0;i<file.length;i++){
// 			var extention=file[i].name.substring(file[i].name.lastIndexOf(".")+1).toLowerCase();
// 			if(!(allowExtention.indexOf(extention)>-1)){
// 				alert('只允许上传jpg、jpeg、png格式的图片');
// 				return false;
// 			}
//         	fileimgarr.push(file[i])
//         }
//        // var URL = window.URL || window.webkitURL;
//         //var blob = URL.createObjectURL(file);
        
//         // 执行前函数
//         if ($.isFunction(obj.before)) {
//             obj.before(this)
//         };
//         obj.success(this);
//         //_create(blob, file);
//         this.value = ''; // 清空临时数据
//     });

//     /**
//      * 生成base64
//      * @param blob 通过file获得的二进制
//      */
    
// };
function _create(obj,amgumentfile,secneupfileimg) {
	var URL = window.URL || window.webkitURL;
    var blob = URL.createObjectURL(amgumentfile);
    var img = new Image();
    img.src = blob;
    img.onload = function() {
        var that = this;
		var filewidth,fileheight;
        //生成比例
        var w = that.width,
            h = that.height,
            scale = w / h;
        w = obj.width || w;
        h = w / scale;
        if(that.width >= 8192){
        	filewidth= 8192; 
            fileheight = 4096; 
        }else{
        	filewidth =that.width;
        	fileheight =that.height;
        }
        
        //生成canvas
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        $(canvas).attr({
            width: filewidth,
            height: fileheight
        });
        ctx.drawImage(that, 0, 0, filewidth, fileheight);
        /**
         * 生成base64
         * 兼容修复移动设备需要引入mobileBUGFix.js
         */
        var base64 = canvas.toDataURL('image/jpeg', obj.quality || 0.8);
        var result = {
            base64: base64,
            clearBase64: base64.substr(base64.indexOf(',') + 1),
            filewidth:filewidth,
            fileheight:fileheight,
            filename:amgumentfile.name
        };
        // 执行后函数 
        secneupfileimg(result)
    };

}
