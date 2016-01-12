@extends('admin_template')
@section('content')
 <div class="row">
					<div class="col-md-12">
							
							
							<div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Number</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="+6584983919" value="+6584983919 , +60128708988">
                      </div>
                    </div>
										 <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">SMS Message</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" rows="5"></textarea>
                      </div>
                    </div>

                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Send</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
							
						

            </div><!-- /.col -->
          </div><!-- /.row -->
@endsection
@section('afterfooter')
<script>
	$(function(){
		$('.kpsubmit').click(function(){
			$('.kpsearch').show();
				setTimeout(function(){
					$('.overlay').hide();
					$('.kptable').fadeIn();
				}, 2000);
			});

		
		$('nav').find('li').click(function(){
			//$('.kptable').hide();
			$('.overlay').show();
			setTimeout(function(){
					$('.overlay').hide();
					$('.kptable').fadeIn();
				}, 2000);
		});
		
		
		var cnt = 0;
		$('.buytable').find('a').click(function(){
			++cnt;
			$(this).text("selected");
			$('.kpbuysummary').slideDown();
			$('.kpselectedtable').append($(this).parent().parent().clone()).find('a').text('remove');
			
			if(cnt>3){
				$('.alert-dismissable').show();
				$('.kp-topup').show();
				$('.kpconfirm-purchase').hide();
			}
		});
		
	})
</script>
@endsection