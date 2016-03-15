$(function(){
					
				/*	//start select sip profile
					$('#select-sip').change(function(){
						var val = $(this).val();
						if(val!=""){
							$(".sipprofile").fadeIn();
						}else
							$(".sipprofile").fadeOut();
					});
					//end select sip profile
					
					
					//start select server app
					$('#select-server').change(function(){
						var val = $(this).val();
						if(val!=""){
							$(".selectserver").fadeIn();
						}else
							$(".selectserver").fadeOut();
					});
					//end select server app
					*/
					
					
					//start select configure type
	$('input[type=radio] , .radio label , .radio label ins').click(function(){

		var val = $(this).attr("value");

		if($(this).parent().hasClass('radio') || $(this).parent().parent().hasClass('radio'))
			val = $(this).find("input[type=radio]").attr("value");
	
	
		if($(this).hasClass('iCheck-helper'))
			val = $(this).parent().find("input[type=radio]").attr("value");

		if(val == "SIPTRUNK" || val == "SERVER_APP" || val == "F2NUMBER" || val == "BINDTOUSER"){
			$('.SIPTRUNK').hide();
			$('.SERVER_APP').hide();
			$('.F2NUMBER').hide();
			$('.BINDTOUSER').hide();
		}
		
		if(val == "url" || val == "server_sms"){
			$('.url').hide();
			$('.server_sms').hide();
		}

		$('.'+val).fadeIn();
			
	});
	var voiceType=$("#voice_type").attr('data-value');	
	var voiceRadioObj=$('input[value="'+voiceType+'"]');
	voiceRadioObj.iCheck('check');
	$("."+voiceType).show();				
	
	
	var msgType=$("#smg_type").attr('data-value');		
	if(msgType == "SERVER_APP")
		msgType="server_sms";
	var smgRadioObj=$('input[value="'+msgType+'"]');
	smgRadioObj.iCheck('check');
	$("."+msgType).show();
	
	
	$("."+msgType).show();				
	url=$('#sbuyUrl').html();			
	$("#editForm").delegate('.releasebtn','click',releaseNumber);		
	$("#editForm").delegate('.savebtn','click',saveConfig);		
	
	function releaseNumber(e)
	{
		e.preventDefault();
		var number=$("#number").html();
		var capabilities=$("#capabilities").html();
		$.ajax({
			url:url+"/numbers/release/"+number+"/"+capabilities,
			type:'get',
			success:function(res)
			{
				res=dealResult(res);
				if(res.flag == "success")
				{
					showSuccessNotice("Release successfully");
					setTimeout(function(){location.href=url+"/numbers";},5000);
				}
				else
				{
					showErrorNotice("Release Faild");
				}
			}
		});
	}
	
	function saveConfig()
	{
		var data=$("#editForm").serialize();
		$.ajax({
			url:url+"/numbers/save",
			type:"post",
			data:data,
			success:function(res)
			{
				res=dealResult(res);
				if(res.flag == 'success')
				{
					showSuccessNotice(res.success);
				}else
				{
					showErrorNotice(res.error);
					
				}
			}
		});
	}
	
	function showSuccessNotice(data)
	{
		$('.alert-danger').hide();
		$('.alert-success').show();
		$('.alert-success p').html(data);
	}
	function showErrorNotice(data)
	{
		$('.alert-success').hide();
		$('.alert-danger').show();
		$('.alert-danger p').html(data);
	}
})