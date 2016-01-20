$(function(){
	$("#registerForm").validate({
		rules:{
			full_name:
			{ 
				required:true,
				minlength:5,
				maxlength:20
			},
			email:
			{
				required:true,
				email:true
			},
			 password:
		      {
		        required: true,
		        minlength: 5
		      },
		      repassword:
		      {
		        required: true,
		        minlength: 5,
		        equalTo: "#password"
		      },
		      accept:
		      {
		    	  required:true
		      }
		},
		message:{
			full_name:{
				required:"*",
				minlength:"minlength is 5",
				maxlength:"maxlength is 20"
			},
			email:
			{
				required:"*",
				email:"email is error"
			},
			 password:
		      {
		        required: "*",
		        minlength: "minlength is 5"
		      },
		      repassword:
		      {
		        required: "*",
		        minlength: "minlength is 5",
		        equalTo: "not equal to password"
		      },
		      accept:
		      {
		    	  required:"*"
		      }
		}
	});
	$("#loginForm").validate({
		rules:{
			loginId:
			{
				required:true
			},
			password:
			{
				required:true
			}
		}
	});
});