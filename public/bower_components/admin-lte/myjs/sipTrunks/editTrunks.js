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
	    $("body").delegate('#deleteAuthBtn','click',deleteAuth);
		$("body").delegate('#addIpAccess','click',addIPAccess);
	    $("body").delegate('#deleteAssigndnum','click',deleteAssigndnum);
	    $("body").delegate('.edit','click',getAuth);
	    $("body").delegate('#user_submit','click',getSelectionAuth);//Add credential authentication
		$("body").delegate('#ip_submit','click',getIp);
	 	$("body").delegate('#deleteIpAccess','click',deleteIp);
 		$("body").delegate('#getAddipType','click',getSelectionIp);//Add IP Access
		$("body").delegate('.close','click',cleanType);
		$("body").delegate('#add2list','click',addNumToTrunks);
		$("body").delegate('#deleteAssigndnum','click',DeleteAssignedNum);

	function DeleteAssignedNum()
	{
		var token=$("#getToken").val();
		var obj=$("#example1").find("input[type=checkbox]:checked");

		var data=Array();
		obj.each(function(index,value){
			data[index]=$(this).val();
			console.log(data);
		});
		$.ajax({
			url:url+"/siptrunk/deleteAssignedNum",
			type:"post",
			data:{number:data,_token:token},
			success:function(res){
				console.log(res);
				res=dealResult(res);
				if(res.flag =='success')
				{
					showSuccessNotice("Delete Successfully");
					window.location.reload()
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
	 function addNumToTrunks()
	 {
		 var siptrunkId=$("#siptrunkId").val();
		var token=$("#getToken").val();
		 var obj=$("#example2").find("input[type=checkbox]:checked");
		 var data=Array();
		  obj.each(function(index,value){
			 data[index]=$(this).val();
		  });
		 $.ajax({
			 url:url+"/siptrunk/assignedNum",
			 type:"post",
			 data:{data:data,_token:token,sip_trunk_id:siptrunkId},
			 success:function(res){
				 console.log(res);
				 res=dealResult(res);
				 if(res.flag =='success')
				 {
					 showSuccessNotice("Add Successfully");
					 window.location.reload()
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
/*
	function showSelectedList()
	{
		var tbody=$('.seletedNum tbody');
		//tbody.empty();
		var data=$("#example1").serialize();
		console.log(data);
		$.each(data, function(i, item){
			str ="<tr>"+
				"<td>"+(i+1)+"</td>"+
				"<td>"+this.country+"</td>"+
				"<td>"+this.number+"</td>"+
				"<td><input readonly name='type["+this.number+"]' value="+this.capabilities+" ></td>"+
				"<td name='price'>"+"$"+this.price+"</td>"+
				"<td><input type='number' name='month["+this.number+"]' class='totalmonth' min='1' max='12' value=1></td>"+
				"<td name='subtotal'><span class='subtotal' >"+"$"+this.price+"</span></td>"+

				'<td><a name='+this.number+'  class="removebtn btn btn-default">Remove</a></td>'+
				"</tr>";
			tbody.append($(str));
		});
	}
*/



	  function deleteAuth()
	  {
		  var authId=$("#getAuthId").val();
		  var trunkId=$("#getTrunkId").val();
		  $.ajax({
			  url:url+"/siptrunk/removeAuth/"+trunkId+"/"+authId,
			  success:function(res){
				  console.log(res);
				  res=dealResult(res);
				  if(res.flag =='success')
				  {
					  showSuccessNotice("Delete Successfully");
					  window.location.reload()
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

        function getAuth(){
			var authId=$(this).attr("data-authid");
			var username=$(".usn"+authId).html();
			var password=$(this).attr("data-pwd");
			console.log(password);

			$("#getAuthId").val(authId);
			$("#uu").val(username);
			$("#pp").val(password);
			$("#getType").val("edit")

		}

	    function deleteAssigndnum(){
			var number=$("#assignedNumber").html();
			$.ajax({
				url:url+"/numbers/release/"+number+"/"+capabilities,
			});
		}
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
					//saveTabsInfo(data);
				}
				if($(this).hasClass('active') && $(this).hasClass('origination'))
				{
					data=$('#saveOriginationForm').serialize();
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
	function getSelectionAuth()
	{

		$("#getAuthId").val("");
		$("#uu").val("");
		var authId=$("#selectAuth").val();
		var password=$("#selectAuth").find("option:selected").attr("type");
		var username=$("#selectAuth").find("option:selected").text();
		if(username=="---Select---") {
			$("#uu").val("");
			$("#getType").val("create")
		}else{
			$("#uu").val(username);
		}
		$("#getAuthId").val(authId);
		$("#pp").val(password);
	}

		function addAuthToTrunks()
		{
			var data=$('#addAuthForm').serialize();
			console.log(data);
			var authId=$("#getAuthId").val();

			var type=$("#getType").attr("value");

		if(type=="edit"){
				$.ajax({
					type:"post",
					url:url+"/siptrunk/editeauth/"+authId,
					data:data,
					success:function(res)
					{
						console.log(res);
						res=dealResult(res);
						if(res.flag == 'success')
						{
							//addAuthToList(res.data);
							console.log(res.data.name);
							showSuccessNotice(res.msg);
						}else
						{
							showErrorNotice(res.msg);
						}
					}
				});
			}else if(type=="create")
			{

				$.ajax({
					type: "post",
					url: url + "/siptrunk/createauth",
					data: data,
					success: function (res) {
						console.log(res);
						res = dealResult(res);
						if (res.flag == 'success') {
							showSuccessNotice(res.msg);
							window.location.reload()
						} else {
							showErrorNotice(res.msg);
						}
					}
				});
			}else{
			if(authId==null | authId=="")
			{

				var authId=$("#selectAuth").val();

			}
			$.ajax({
				type:"post",
				url:url + "/siptrunk/addtoauthlist",
				data:data,
				success:function(res){
					console.log(res);
					res=dealResult(res);
					if (res.flag == 'success') {
						showSuccessNotice(res.msg);
						window.location.reload()
					} else {
						showErrorNotice(res.msg);
					}
				}
			})
			}
		}

	function getIp(){
		var id=$(this).attr("data-ipaccess");
		var ipdes=$(".des"+id).html();
		var ipnum=$(".ip"+id).html();
       console.log(ipdes+ipnum);
		$("#getId").val(id);
		$("#ipDes").val(ipdes);
		$("#ipNum").val(ipnum);
		$("#getIpType").val("edit")
	}

	function deleteIp()
	{
		var id=$("#getId").val();
		var trunkId=$("#getTrunkId2").val();
		$.ajax({
			url:url+"/siptrunk/removeip/"+trunkId+"/"+id,
			success:function(res){
				console.log(res);
				res=dealResult(res);
				if(res.flag =='success')
				{
					showSuccessNotice("Delete Successfully");
					window.location.reload()
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
	   function getSelectionIp()
	   {
		   $("#getId").val("");
		   $("#ipDes").val("");
		   $("#ipNum").val("");
		   var id=$("#selectIpcontrol").val();
		   var ipNum=$("#selectIpcontrol").find("option:selected").attr("type");
		   var ipDes=$("#selectIpcontrol").find("option:selected").text();
		   if(ipDes=="---Select---") {
			   $("#ipDes").val("");
			   $("#getIpType").val("create")
		   }else{
			   $("#ipDes").val(ipDes);
		   }
		   $("#getId").val(id);
		   $("#ipNum").val(ipNum);
	   }
		function addIPAccess(e)
		{
			var data=$("#addIPAccessForm").serialize();
			var id=$("#getId").val();
			var trunkId=$("#getTrunkId2").val();
			var type=$("#getIpType").attr("value");
			if(type=="create") {
				$.ajax({
					type: 'post',
					url: url + "/siptrunk/createTrunkIp",
					data: data,
					success: function (res) {
						console.log(res);
						res = dealResult(res);
						if (res.flag == 'success') {
							console.log(res.data.name);
							showSuccessNotice(res.msg);
							window.location.reload()
						} else {
							showErrorNotice(res.msg);
						}
					}
				});
				$("#getIpType").val("");
			} else if(type=="edit"){
				$.ajax({
					type:"post",
					url:url+"/siptrunk/editip/"+id,
					data:data,
					success:function(res)
					{
						console.log(res);
						res=dealResult(res);
						if(res.flag == 'success')
						{
							//addAuthToList(res.data);
							console.log(res.data.name);
							showSuccessNotice(res.msg);
						}else
						{
							showErrorNotice(res.msg);
						}
					}
				});
				$("#getIpType").val("");
			}else{
				$.ajax({
					type:"post",
					url:url + "/siptrunk/addtoiplist",
					data:data,
					success:function(res){
						console.log(res);
						res=dealResult(res);
						if (res.flag == 'success') {
							showSuccessNotice(res.msg);
							window.location.reload()
						} else {
							showErrorNotice(res.msg);
						}
					}
				});
			}
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
	});
	 function cleanType(){
		 $("#getIpType").val("");
		 $("#getType").val("");
	 }
$(function(){
	var url=$("#url").html();
	var country=$("#country").find("option:selected").val();
	var capabilities=$("#capabilities").find("option:selected").val();
	console.log(capabilities);
	var tableTest = $("#example2").DataTable({
		"paging": true,
		"select": true,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url":url+"/siptrunk/getNumTable",
			"data":function(d){
				d.country=country;
				d.capabilities=capabilities;
			}
		},
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": true,
		"autoWidth": false,

		"columns": [
			{"data": "index"},
			{"data": "country"},
			{"data": "area"},
			{"data": "number"},
			{"data": "capabilities"},
			{"data":"check","render":function(data,type,full,meta){return '<input type="checkbox" value="'+data+'">'}},
			/*		{"data":"check","render":function(data,type,full,meta){return '<a href="'+url+"/siptrunk/edit/"+data+'" class="btn btn-block btn-default" type="button">Edit</a>'}}*/
		]
	});
	$("#searchNum").click(function () {
		capabilities=$("#capabilities").find("option:selected").val();
	    country=$("#country").find("option:selected").val();
		tableTest.ajax.reload();
	});
});



$(function(){
	var url=$("#url").html();
	var sipTrunkId=$("#siptrunkId").val();
	$("#example1").DataTable({
		"paging": true,
		"select": true,
		"processing": true,
		"serverSide": true,
		"ajax":url+"/siptrunk/assignedNumlist/"+sipTrunkId,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": true,
		"autoWidth": false,

		"columns": [
		 {"data": "index"},
			{"data": "number"},
		 {"data": "country"},
		 {"data": "area"},

		 {"data": "capabilities"},
		 {"data":"check","render":function(data,type,full,meta){return '<input type="checkbox" value="'+data+'">'}}
	/*	 {"data":"check","render":function(data,type,full,meta){return '<a href="'+url+"/siptrunk/edit/"+data+'" class="btn btn-block btn-default" type="button">Edit</a>'}}*/

		 ]
	});
});

