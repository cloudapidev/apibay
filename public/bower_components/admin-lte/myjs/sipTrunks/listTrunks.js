$(function(){
	url=$("#rootUrl").html();
	$('.checkall').on('ifChecked', function(event){
		$('input[type=checkbox]').iCheck('check');
	});
	$('.checkall').on('ifUnchecked', function(event){
		$('input[type=checkbox]').iCheck('uncheck');
	});
	
	
	
	$('.search').delegate('.searchBtn','click',searchInfo);
	$("#creatNew").delegate('.creatNewBtn',"click",CreateNew);
	function searchInfo(e)
	{
		var data=$("#searchForm").serialize();
		$.ajax({
			url:url+"/siptrunk/search",

			type:'post',
			data:data,
			success:function(res)
			{
				console.log(res);
				res=dealResult(res);
				if(res.flag == 'success')
				{
					showTrunksList(res.data);
				}
				else
				{
					
				}
			}
		})
	}
	function CreateNew(e)
	{
		var data=$("#modelForm").serialize();
//		if(data.length == 0)	return false;
		$.ajax({
			type:'post',
			url:url+"/siptrunk/create",
			data:data,
			success:function(res)
			{
				
				console.log(res);
				res=dealResult(res);
				if(res.flag == 'success')
				{
					
					window.location.href=url+"/siptrunk/edit/"+res.data.id;
				}
			}
		})
		
	}
	//show the trunks list
/*	function showTrunksList(data)
	{
		if(data.length == 0) return false;
		var tbody=$("#example1").find('tbody');
		var str="";
		$.each(data,function(i,item){
			str +="<str>"+
			"<td></td>"+
			"<td></td>"+
			"<td></td>"+
			"<td></td>"+
			"<td></td>"+
			"<td></td>"+
			"</tr>";
		});
		tbody.append($(str));
	}*/
	function dealResult(res)
	{
		res=eval('('+res+')');
		return res;
	}
});


	$(function () {
		url=$("#rootUrl").html();
		$("#example1").DataTable({
			"paging": true,
			"select": true,
			"processing": true,
			"serverSide": true,
			"ajax": "siptrunk/get",
			"lengthChange": false,
			"searching": false,
			"ordering": false,
			"info": true,
			"autoWidth": false,
			"columns": [
				{"data": "index"},
				{"data": "name"},
				{"data": "termination_uri"},
				{"data": "origination_uri"},
				{"data": "channel"},
				{"data":"edit","render":function(data,type,full,meta){return '<a href="'+url+"/siptrunk/edit/"+data+'" class="btn btn-block btn-default" type="button">Edit</a>'}}
/*				{"data": "edit",  "defaultContent": "<a href='' class='btn btn-block btn-default' type='button' onclick='test(' +  +')'>Edit</a>"}*/
			]
		});
		$("#example1").on("click",".btn btn-block btn-default");
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false
		});
	});