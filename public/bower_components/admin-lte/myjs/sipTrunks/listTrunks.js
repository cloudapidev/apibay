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
	function showTrunksList(data)
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
	}
	function dealResult(res)
	{
		res=eval('('+res+')');
		return res;
	}
});