
//删除场景
function deleteFile(ids){
	$.post(backPath+"/file/image/delete",{"ids":ids.join(",")},function(data){
		if(data.returnCode=="SUCCESS"){
			location.reload();
		}else{
			alert(data.returnMsg);
		}
	});
}
//上传
function secneupfileimg(result){
	var successfilelists = result ? result : successfilelist
    var fd = new FormData();
        fd.append('file', fileimgarr[successfilelists]);
        var startimes  = new Date()
    // 生成结果
   ajaxfileimgarr.push($.ajax({
        type: "POST",
        url: fileupload,
        data: fd,
        processData: false,
        contentType: false,
        success: function (res) {
        	var result=res;
		    if(result.returnCode=="SUCCESS"){
		    	var sceneGroupId=sceneGroupIds;
		    	d={
		    		"img_url":result.imgUrl,
		    		"img_type":sceneGroupId,
		    		"build_id":data_id,
		    	};
		    	saveImage(d);
		    }else{
		    	$("#ajaxload").hide();
		    	$("#alretboxmian .uploadimg_com_waring_tx").show().html(result.returnMsg);
		    	//alert(result.returnMsg);
		    }
        },
        xhr:xhrOnProgress(function(e){
            var percent=(e.loaded / e.total)*100;//计算百分比            
            var endtime = new Date()  
            var stmes = (endtime-startimes)/1000
            $(".uploadstar_list li").eq(successfilelists).find('.loadbg').css('width',percent+'%')
            $(".uploadstar_list li").eq(successfilelists).find('.uploadstar_list_tx').html('<i>'+percent.toFixed(2)+'%</i>')
            $(".uploadstar_list li").eq(successfilelists).find('.uploadstar_list_m').html(((((e.total)/1024)/1024)/(stmes)).toFixed(2)+'MB/S')
            if(percent==100){
            	$(".uploadstar_list li").eq(successfilelists).find('.loadbg').css('width','99.99%')
            	$(".uploadstar_list li").eq(successfilelists).find('.uploadstar_list_tx').html('<i>99.99%</i>')
	            $(".uploadstar_list li").eq(successfilelists).find('.uploadstar_list_m').html(((((e.total)/1024)/1024)/(stmes)).toFixed(2)+'MB/S')
            }
         }),
        error: function(data) {
        }
    })
   )
  
}
//保存上传图片
function saveImage(d){
	$.post(Imgsava,d,function(data){
		if(data.status=="1"){
			if(successfilelist < fileimgarr.length){
				$(".uploadstar_list li").eq(successfilelist).find('.loadbg').hide()
            	$(".uploadstar_list li").eq(successfilelist).find('.uploadstar_list_tx').html('<i style="color:#16d38e">完成</i>')
				$(".uploadstar_list li").eq(successfilelist).find('.uploadstar_list_m').html('')
				$(".uploadstar_list li").eq(successfilelist).find('.londingclose').hide()
			}
		}else{
			$(".uploadstar_list li").eq(successfilelist).find('.loadbg').hide()
        	$(".uploadstar_list li").eq(successfilelist).find('.uploadstar_list_tx').html('<i style="color:#ff5050">失败</i>')
			$(".uploadstar_list li").eq(successfilelist).find('.uploadstar_list_m').html('')
			$(".uploadstar_list li").eq(successfilelist).find('.londing').show()
			$(".uploadstar_list li").eq(successfilelist).find('.londingclose').hide()
			$("#alretboxmian .uploadimg_com_waring_tx").show().html(data.returnMsg);
			//alert(data.returnMsg);
		}
		if(successfilelist == (fileimgarr.length-1)){
			window.location.href=url; 
		}
		successfilelist++
		$('.uploadstar_mian .alert_title_upinggrup').html(successfilelist+'/'+fileimgarr.length)
		secneupfileimg()
		
	});
}
$(function(){

	
	//上传图片
	$('.fileupload').localResizeIMG(fileimgaugment);
	//上传图片弹窗
	$("#btn_imageuploads").click(function(){
		if($("#alretboxmian").length){
			$("#alertboxbg").remove();
		        $("#alretboxmian").remove();
		}
		$(".fileupload").click();
	    alertbox({
	        msg:$('.uploadimg_com').html(),
	        tcallfn_tx:'开始上传',
	        ishide:true,
	        tcallfn:function(){
	        	var txhtml='';
	        	var sceneGroupel= $("#alretboxmian .sceneGroup")[0]
	        	sceneGroupIds=$(sceneGroupel).val();
		    	sortscennum=$("#alretboxmian .sceneGroup option:selected").data("scenenum");
    			$('.uploadstar_mian').show();
    			$('.uploadingstar_group span').html(sceneGroupel.options[sceneGroupel.selectedIndex].text)
    			$('.uploadstar_mian .alert_title_upinggrup').html(successfilelist+'/'+fileimgarr.length)
    			for(var i=0;i<fileimgarr.length;i++){
    				 //_create(fileimgaugment,fileimgarr[i],secneupfileimg)
    				txhtml+='<li class="color_859dad clear">'+
    				'<span><i class="uploadstaricon"></i></span>'+
    				'<span class="tx_over uploadstar_list_name">'+fileimgarr[i].name+'</span>'+
    				'<span class="uploadstar_list_tx"><i>排队中..</i></span>'+
    				'<span class="tx_over uploadstar_list_m"></span>'+
    				'<span class="uploadstar_list_size">'+(fileimgarr[i].size/1024/1024).toFixed(2)+'M</span>'+
    				'<span class="uploadstar_list_up"><i class="londing"></i></span>'+
    				'<span><i class="londingclose"></i></span>'+
    				'<p class="loadbg"></p>'+
         			'</li>'
    			}
    			$('.uploadstar_list').append(txhtml);
    			$('#sihaiload').show()
    			$('.uploadstar_mian').show()
    			secneupfileimg();
	        }
	    });  
	});
	 $('body').on('click','.londingclose',function(){
		 var idx = $(this).parents('li').index()
		 if(idx == successfilelist){
			ajaxfileimgarr[successfilelist].abort()
			$(".uploadstar_list li").eq(successfilelist).find('.loadbg').hide();
        	$(".uploadstar_list li").eq(successfilelist).find('.uploadstar_list_tx').html('<i style="color:#ff5050">取消</i>');
			$(".uploadstar_list li").eq(successfilelist).find('.uploadstar_list_m').html('');
			$(".uploadstar_list li").eq(successfilelist).find('.londing').show();
			$(".uploadstar_list li").eq(successfilelist).find('.londingclose').hide();
			successfilelist++;
			secneupfileimg();
		 }else{
			 fileimgarr.splice(idx,1)
			 $(this).parents('li').remove()
		 }
		 $('.uploadstar_mian .alert_title_upinggrup').html(successfilelist+'/'+fileimgarr.length)
	 })
	 $('.uploadstar_close').click(function(){
		 location.reload();
	 })
	 $('#uploadstar_smalls').click(function(){
		 if($(this).is('.uploadstar_small')){
			$(this).addClass('uploadstar_big').removeClass('uploadstar_small');
			$('.uploadlist_mian').hide();
		 }else{
			$(this).addClass('uploadstar_small').removeClass('uploadstar_big');
				$('.uploadlist_mian').show();
		 }
	 })
	 $('body').on('click','.londing',function(){
		 var idx = $(this).parents('li').index();
		 fileimgarr.push(fileimgarr[idx])
		 fileimgarr.splice(idx,1)
		 $(this).parents('li').remove()
		 --successfilelist
		 var fileimgarrlength = fileimgarr.length -1
		 var txhtml='<li class="color_859dad clear">'+
			'<span><i class="uploadstaricon"></i></span>'+
		'<span class="tx_over uploadstar_list_name">'+fileimgarr[fileimgarrlength].name+'</span>'+
		'<span class="uploadstar_list_tx"><i>排队中..</i></span>'+
		'<span class="tx_over uploadstar_list_m"></span>'+
		'<span class="uploadstar_list_size">'+(fileimgarr[fileimgarrlength].size/1024/1024).toFixed(2)+'M</span>'+
		'<span class="uploadstar_list_up"><i class="londing"></i></span>'+
		'<span><i class="londingclose"></i></span>'+
		'<p class="loadbg"></p>'+
			'</li>'
			$('.uploadstar_list').append(txhtml);
	 })

})