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
                      <label for="inputEmail3" class="col-sm-2 control-label">Caller's Country</label>
                      <div class="col-sm-10">
                        <select class="form-control">
													<?php $cnt=0; foreach(openCSV("countries") as $key=>$item){ ++$cnt;?>
														<option value="<?=$item["country"]?>"><?=$item["country"]?></option>
													<?php } ?>
												</select>
                      </div>
                    </div>
										 <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Callee's Country</label>
                      <div class="col-sm-10">
                        <select class="form-control">
													<?php $cnt=0; foreach(openCSV("countries") as $key=>$item){ ++$cnt;?>
														<option value="<?=$item["country"]?>"><?=$item["country"]?></option>
													<?php } ?>
												</select>
                      </div>
                    </div>

                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a class="btn btncheck btn-info pull-right">Check</a>
                  </div><!-- /.box-footer -->
                </form>
              </div>
							
						

            </div><!-- /.col -->
          </div><!-- /.row -->
				
				
				 <div class="row resultdiv" style="display:none;">
					<div class="col-md-12">
							
							
							<div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Rates</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
										<dl class="dl-horizontal  box-rate">
											<dt>Country call from </dt>
											<dd>Singapore</dd>
											<dt>Country call to </dt>
											<dd>China</dd>
											<dt>Call ( per minute )</dt>
											<dd>$ 0.017</dd>
											<dt>SMS ( per sms )</dt>
											<dd>$ 0.002</dd>
										</dl>
                  </div><!-- /.box-body -->
								
                </form>
									<div class="overlay" >
										<i class="fa fa-refresh fa-spin"></i>
									</div>
              </div>
							
						

            </div><!-- /.col -->
          </div><!-- /.row -->
@endsection
@section('afterfooter')

<script>
	$(function(){
		
		$('.btncheck').click(function(){
			$('.box-rate').hide();
			$('.resultdiv').show();
			$('.overlay').show();
			setTimeout(function(){
					$('.overlay').hide();
					$('.box-rate').fadeIn();
				}, 2000);
		});
		
		
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