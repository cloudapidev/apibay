$(function(){
		var url=$('#url').html();
		
		$('.kpsubmit').click(function(){
			$('.kpsearch').show();
				setTimeout(function(){
					$('.overlay').hide();
					$('.kptable').fadeIn();
				}, 2000);
			});
		

		$('.checkall').on('ifChecked', function(event){
			$('input[type=checkbox]').iCheck('check');
		});
		$('.checkall').on('ifUnchecked', function(event){
				$('input[type=checkbox]').iCheck('uncheck');
		});
		

		$('.modal .mcheckall').on('ifChecked', function(event){
			$('.modal input[type=checkbox]').iCheck('check');
		});
		$('.modal .mcheckall').on('ifUnchecked', function(event){
				$('.modal input[type=checkbox]').iCheck('uncheck');
		});
			
		//Initialize Select2 Elements
     $(".select2").select2();
		$(".addnumber").change(function(){
			var val=$(this).val();
			if(val > 10){
				$(".closes , .buy ").hide();
				$(".topup , .alert").show();
			}else{
				$(".closes , .buy").show();
				$(".topup , .alert").hide();
			}
		});		
		
		$('.buy').click(function(){
			$(".overlay").show();
			setTimeout(function(){
					$('.overlay').hide();
				}, 2000);
		});
	
		//-----------------------------------------
		
		$(".editTrunk").delegate('#saveTrunkInfo','click',saveInfo);
		$("body").delegate('#saveAuthBtn','click',addAuthToTrunks);
		$("body").delegate('#addIpAccess','click',addIPAccess);
		function saveInfo()
		{
			var tabs=$('[id*="tab_"]');
			var data="";
			$.each(tabs,function(i,item){
				if($(this).hasClass('active') && $(this).hasClass('general'))
				{
					data=$('#saveTrunkInfoForm').serialize();
					saveTabsInfo(data);
				}
				if($(this).hasClass('active') && $(this).hasClass('termination'))
				{
					data=$('#saveTerminationForm').serialize();
					console.log(data);
					saveTabsInfo(data);
				}
			});
			
		}
		function saveTabsInfo(data)
		{
				$.ajax({
					url:url+"/siptrunk/saveInfo",
					type:"post",
					data:data,
					success:function(res){
						console.log(res);
						res=dealResult(res);
						if(res.flag =='success')
						{
							showSuccessNotice("Save Successfully");
						}
						else
						{
							showErrorNotice(res.msg);
						}
					},
					error:function(res){
						console.log(res);
					}
				});
		}
	/*	function addAuthInfo(e)
		{
			 var data = $("#authorForm").serialize();
	            $("#myModalauth").modal("hide");//关闭模态框
	        	$.ajax({
					type:'post',
					url:url+"/siptrunk/createauth",
					data:data,
					success:function(res)
					{
						console.log(res);
						res=dealResult(res);
					}
				});
		}*/
		function addAuthToTrunks(e)
		{
			var data=$('#addAuthForm').serialize();
			$.ajax({
				type:"post",
				url:url+"/siptrunk/createauth",
				data:data,
				success:function(res)
				{
					console.log(res);
					res=dealResult(res);
					if(res.flag == 'successs')
					{
						showSuccessNotice(res.msg);
					}else
					{
						showErrorNotice(res.msg);
					}
				}
			});
		}
		function addAuthToList(data)
		{
			var tbody=$("#authTable").find('tbody');
			var index=tbody.find('tr').last().find('td').first().html();
			index++;
			var str="";
			str="<tr>" +
					"<td>"+index+"</td>" +
					"<td>"+data.username+"</td>" +
					"<td>"+data.password+"</td>" +
					"</tr>";
			tbody.append($(str));
		}
		function addIPAccess(e)
		{
			var data=$("#addIPAccessForm").serialize();
			$.ajax({
				type:'post',
				url:url+"/siptrunk/createTrunkIp",
				data:data,
				success:function(res)
				{
					console.log(res);
					res=dealResult(res);
					if(res.flag == 'success')
					{
						addToIpAccessList(res.data);
						console.log(res.data.name);
						showSuccessNotice(res.msg);
					}else
					{
						showErrorNotice(res.msg);
					}
				}
			});
		}
		function addToIpAccessList(data)
		{
			var tbody=$("#IpAccessList").find("tbody");
			var index=tbody.find("tr").last().find('td').first().html();
			index++;
			var str="";
			str="<tr>" +
				"<td>"+ index+"</td>"+
				"<td>"+data.name+"</td>"+
				"<td>"+data.ip+"</td>"+
				"</tr>";
			tbody.append($(str));
			
		}
		function showSuccessNotice(data)
		{
			var obj=$("#success");
			var eObj=$("#error");
			var str="<p>"+data+"</p>";
			obj.find("p").empty();
			obj.find("p").append($(str));
			eObj.hide();
			obj.show();
			setTimeout(function () {
		        obj.hide();
		    }, 6000);
		}
		function showErrorNotice(data)
		{
			var obj=$("#error");
			var sObj=$("#success");
			var str="<p>"+data+"</p>";
			obj.find('p').empty();
			obj.find('p').append($(str))
			sObj.hide();
			obj.show();
			setTimeout(function () {

		        obj.hide();

		    }, 6000);

			
		}
		function dealResult(res)
		{
			res=eval("("+res+")");
			return res;
		}
	})