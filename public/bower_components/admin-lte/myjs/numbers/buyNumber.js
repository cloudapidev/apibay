$(function(){
	var url=$('#sbuyUrl').html();

	$('#searchForm').delegate(".kpsubmit",'click',searchSubmit);//show the number list after clicking search button
	$('nav').delegate("li",'click',showOverlay);//show the shade
	$('.kptable ').delegate('a','click',setNumberSelected);//click buy button to change it to be selected
	$('.kpbuysummary ').delegate('.refreshbtn','click',showSelectedNumbers);
	$('.purchaseTotal').delegate('.removebtn','click',removeSelectedNumber);//click button to change selected status and remove this line. 
	$('.purchaseTotal').delegate('.totalmonth','change',changeSubtotal);
	$('.invoice').delegate(".comPurchase",'click',comfirmPurchase);
	changTotals();
	function searchSubmit(event)
	{
		$('.kpsearch').show();
		$('.overlay').show();
		var tbody=$('.kptable tbody');
	    tbody.empty();
		var data=$('#searchForm').serialize();
		$.ajax({
				url:url+"/numbers/sbuy",
				type:'post',
				data:data,
				success:function(res){
					res=dealResult(res);
					showNumberslist(res.data)
					},
				error:function(res){
					}
			});
			setTimeout(function(){
				$('.overlay').hide();
				$('.kptable').fadeIn();
			}, 2000);
	}
	function showNumberslist(arr)
	{
		var tbody=$('.kptable tbody');
		$.each(arr, function(i, item){  
		 	str ="<tr>"+
			"<td>"+(i+1)+"</td>"+
			"<td name='country'>"+this.country+"</td>"+
			"<td name='number'>"+this.number+"</td>"+
			"<td name='capabilities'>"+this.capabilities+"</td>"+
			"<td name='price'>"+this.price+"</td>"+
			'<td><a name='+this.number+'  class="buy btn btn-default">Buy</a></td>';
			"</tr>";
			tbody.append($(str)); 
		});     
	  }
	function showOverlay(event){
		//$('.kptable').hide();
		$('.overlay').show();
		setTimeout(function(){
				$('.overlay').hide();
				$('.kptable').fadeIn();
			}, 2000);
	};
	function setNumberSelected(event)
	{
		var self=$(this);
		$.ajax({
			url:url+'/numbers/selected/'+self.attr('name'),
			type:'get',
			success:function(res){
				console.log(res);
				res=dealResult(res);
				if(res.flag =='success')
				{
					/*self.addClass('selected');
					self.removeClass('buy');*/
					$('.kpbuysummary').show();
					var trObject=self.parent().parent();
					trObject.remove();
					showSelectedNumbers();
					
				}
			},
			error:function(res){
			}
		});
		
	}
	function showSelectedNumbers()
	{
		$.ajax({
			url:url+'/numbers/selectedlist',
			type:'get',
			success:function(res){
				res=dealResult(res);
				if(res.flag == 'success')
				{
					showSelectedList(res.data);
					changTotals();
				}
			},
			error:function(res){
				}
		});
	}
	
	function showSelectedList(data)
	{
		var tbody=$('.purchaseTotal tbody');
		tbody.empty();
		$.each(data, function(i, item){  
		 	str ="<tr>"+
			"<td>"+(i+1)+"</td>"+
			"<td>"+this.country+"</td>"+
			"<td>"+this.number+"</td>"+
			"<td><input readonly name='type["+this.number+"]' value="+this.capabilities+" ></td>"+
			"<td name='price'>"+"$"+this.price+"</td>"+
			"<td><input type='number' name='month["+this.number+"]' class='totalmonth' min='1' max='12' value=1></td>"+
			"<td name='subtotal'><span class='subtotal' >"+"$"+this.price+"</span></td>"+
			'<td><a name='+this.number+'  class="removebtn btn btn-default">Remove</a></td>';
			"</tr>";
			tbody.append($(str)); 
		});     
	}
	
	function removeSelectedNumber(event)
	{
		var self=$(this);
		var number=self.attr('name');
		$.ajax({
			url:url+'/numbers/remove/'+number,
			type:'get',
			success:function(res){
				console.log(res);
				res=dealResult(res);
				if(res.flag == 'success')
				{
					var trObj=self.parent().parent();
					trObj.remove();
					changTotals();
				}
				},
			error:function(res){
				}
		});
	}
	
	function changeSubtotal(event)
	{
		var self=$(this);
		var monthes=self.val();
		var parentObj=self.parent().parent();
		var price=parentObj.find('td[name="price"]').html();
		var subTotal=parentObj.find('td[name="subtotal"]').find('span');
		var value=parseInt(price.substring(1))*monthes;
		subTotal.html("$"+value);
		//change the total details;
		changTotals();
	}
	
	function changTotals()
	{
		var subtotalArr=$('.subtotal');
		var totals=0;
		var curCreditObj=$('#curCredit');
		var afterCreditObj=$('#afterCredit');
		var afterValue=0;
		var tmpV;
		$.each(subtotalArr, function(i, item){
			tmpV=$(this).html().substring(1);
			totals =parseInt(tmpV) + totals;
		});
		$('#total').html("$"+totals);
		afterValue=curCreditObj.html().substring(1)-totals;
		afterCreditObj.html("$"+afterValue);
		wetherShowAlert();
		
	}
	
	function wetherShowAlert(e)
	{
		var self=$("#afterCredit");
		var value=parseInt(self.html().substring(1));
		if(value < 0)
		{
			$('#alertDanger').show();
			$('.kp-topup').show();
			$('.kpconfirm-purchase').hide();
		}else
		{
			$('#alertDanger').hide();
			$('.kp-topup').hide();
			$('.kpconfirm-purchase').show();
		}
	
	}
	function comfirmPurchase(e)
	{
//		var balance=$('#curCredit').html();
		var data=$("#purchaseForm").serialize();
		if(data.length == 0) return false;
		$.ajax({
			url:url+"/numbers/purchase",
			type:'post',
			data:data,
			success:function(res){
				console.log(res);
				res=dealResult(res);
				if(res.flag == 'error' )
				{
					//buy faildly
					showSelectedNumbers();
					showErrorNotice(res.msg);
					
				}else  if(res.flag == 'success')
				{
					//buy successfully.
					showSuccessNotice(res.msg);
					showSelectedNumbers();
				}
		
					
			},
			error:function(res){
			}
		});
		
	}
	
	function showSuccessNotice(data)
	{
		$('#error').hide();
		$('.alert-success').show();
		$('.alert-success p').html(data);
	}
	function showErrorNotice(data)
	{
		$('.alert-success').hide();
		$('#error').show();
		$('#error p').html(data);
	}
	function dealResult(res)
	{
		res=eval('('+res+')');
		return res;
	}
	
	
});