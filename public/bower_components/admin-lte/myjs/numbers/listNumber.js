$(function(){
	var url=$('#sbuyUrl').html();
	$('#purchasedDate').datepicker({
		 onClose: function( selectedDate ) {
             $( "#expiredDate" ).datepicker( "option", "minDate", selectedDate );
         }
	})
	
	$('#expiredDate').datepicker({
		 onClose: function( selectedDate ) {
             $( "#purchasedDate" ).datepicker( "option", "maxDate", selectedDate );
         }
	})
	
	$('.form-horizontal').delegate('.searchbtn','click',searchNumbers);
	$('.pageLink').delegate('a','click',refreshPage);
	function searchNumbers(e)
	{
		var data=$('#searchForm').serialize();
		$.ajax({
				url:url+"/numbers/search",
				type:'post',
				data:data,
				success:function(res){
					res=dealResult(res);
					if(res.flag == 'success')
					{
						showNumbersL ist(res.data);
					}
					
				},
				error:function(res){
					}
			});
		
	}
	function showNumbersList(data)
	{
		var tbody=$('.numberList tbody');
		tbody.empty();
		$.each(data, function(i, item){  
		 	str ="<tr>"+
			"<td>"+(i+1)+"</td>"+
			"<td>"+item.number+"</td>"+
			"<td>"+item.country+"</td>"+
			"<td>"+item.capabilities+"</td>"+
			"<td>"+item.purchased_date+"</td>"+
			"<td>"+item.expired_date+"</td>"+
			"<td>"+item.price+"</td>"+
			"<td><b>Voice</b> : <i>Forward to number :</i> <br /><b>Messaging :</b> <i>URL</i>: </td>"+
			"<td><a href='"+url+"/numbers/edit/"+item.number+"' class='btn btn-block btn-default'>Edit</a></td>"+
			"</tr>";
			tbody.append($(str)); 
		});     
	}
	function refreshPage(e)
	{
//		e.preventDefault();
		var self= $(this);
		var page=self.attr('name');
		$.ajax({
			url:url+"/numbers/list/"+page,
			type:'get',
			success:function(res){
				res=dealResult(res);
				if(res.flag == 'success')
				{
					reshowPageNumber(res.pagelist);
					showNumbersList(res.data);
				}
			}
		});
	}
	function reshowPageNumber(obj)
	{
		var pagelist=$('.pageLink');
		pagelist.empty();
		pagelist.append($(obj));
	}
	function dealResult(res)
	{
		return eval("("+res+")");
});