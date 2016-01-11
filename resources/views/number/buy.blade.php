@extends('admin_template')

@section('content')

        <div class="row">
					<div class="col-md-12">
						
						<div class="box box-default box-solid">
               
                <div class="box-header with-border">
                  <h3 class="box-title">Search new Number</h3>
                </div><!-- /.box-header -->
								
								<form class="form-horizontal" onsubmit="return false;">
										<div class="box-body">
											<div class="form-group">
												<label for="inputPassword3" class="col-sm-1 control-label">Country</label>
												
												<div class="col-sm-2">
													<select class="form-control">
														<option>(+1) United States</option>
														<option>(+65) Singapore</option>
													</select>
												</div>
												
												<label for="inputPassword3" class="col-sm-1 control-label">Area</label>
												<div class="col-sm-1">
													<input type="text" class="form-control">
												</div>
													
								
												<label for="inputPassword3" class="col-sm-1 control-label">Number</label>
												<div class="col-sm-2">
													<input type="text" class="form-control">
												</div>
								
												<label for="inputPassword3" class="col-sm-1 control-label">Capabilities</label>
												<div class="col-sm-1">
													<div class="radio">
														<label>
															<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
															Voice
														</label>
													</div>
												</div>
												<div class="col-sm-1">
													<div class="radio">
														<label>
															<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
															SMS
														</label>
													</div>
												</div>
												<div class="col-sm-1">
													<div class="radio">
														<label>
															<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
															Voice + SMS
														</label>
													</div>
												</div>
											</div>
									</div>
									<div class="box-footer">
                    <button type="submit" class="kpsubmit btn btn-primary pull-right">Search</button>
                    <button type="submit" class="btn btn-default">Reset</button>
                  </div>
								</form>
								
							</div>
					
						</div>
					</div>
					
					
					
					<div class="row kpsearch" style="display:none;">
						<div class="col-md-12">
							<div class="box box-solid container-fluid">
						 
							<div class="box-header with-border">
								<h3 class="box-title">Search Results</h3>
							</div><!-- /.box-header -->
								<div class="box-body buytable table-responsive" >
									<table class="table kptable table-striped datastable" style="display:none;">
										<thead>
											<tr>
												<th>No</th>
												<th>Country</th>
												<th>Area</th>
												<th>Number</th>
												<th>Capabilities</th>
												<th>Price</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>Malaysia</td>
												<td>Johor</td>
												<td>+6012345664</td>
												<td>Voice</td>
												<td>$64.50</td>
												<td>
													<a class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>2</td>
												<td>Singapore</td>
												<td>-</td>
												<td>+65612345664</td>
												<td>SMS</td>
												<td>$50.00</td>
												<td>
													<a  class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>3</td>
												<td>Singapore</td>
												<td>-</td>
												<td>+65612345667</td>
												<td>Voice+SMS</td>
												<td>$10.70</td>
												<td>
													<a  class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>4</td>
												<td>China</td>
												<td>Cheng Du</td>
												<td>+86612345664</td>
												<td>Voice</td>
												<td>$25.99</td>
												<td>
													<a  class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>5</td>
												<td>Malaysia</td>
												<td>Johor</td>
												<td>+6012345664</td>
												<td>Voice</td>
												<td>$64.50</td>
												<td>
													<a class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>6</td>
												<td>Singapore</td>
												<td>-</td>
												<td>+65612345664</td>
												<td>SMS</td>
												<td>$50.00</td>
												<td>
													<a  class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>7</td>
												<td>Singapore</td>
												<td>-</td>
												<td>+65612345667</td>
												<td>Voice+SMS</td>
												<td>$10.70</td>
												<td>
													<a  class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>8</td>
												<td>China</td>
												<td>Cheng Du</td>
												<td>+86612345664</td>
												<td>Voice</td>
												<td>$25.99</td>
												<td>
													<a  class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>9</td>
												<td>Malaysia</td>
												<td>Johor</td>
												<td>+6012345664</td>
												<td>Voice</td>
												<td>$64.50</td>
												<td>
													<a class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>10</td>
												<td>Singapore</td>
												<td>-</td>
												<td>+65612345664</td>
												<td>SMS</td>
												<td>$50.00</td>
												<td>
													<a  class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>11</td>
												<td>Singapore</td>
												<td>-</td>
												<td>+65612345667</td>
												<td>Voice+SMS</td>
												<td>$10.70</td>
												<td>
													<a  class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>12</td>
												<td>China</td>
												<td>Cheng Du</td>
												<td>+86612345664</td>
												<td>Voice</td>
												<td>$25.99</td>
												<td>
													<a  class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>13</td>
												<td>Malaysia</td>
												<td>Johor</td>
												<td>+6012345664</td>
												<td>Voice</td>
												<td>$64.50</td>
												<td>
													<a class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>14</td>
												<td>Singapore</td>
												<td>-</td>
												<td>+65612345664</td>
												<td>SMS</td>
												<td>$50.00</td>
												<td>
													<a  class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>15</td>
												<td>Singapore</td>
												<td>-</td>
												<td>+65612345667</td>
												<td>Voice+SMS</td>
												<td>$10.70</td>
												<td>
													<a  class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>16</td>
												<td>China</td>
												<td>Cheng Du</td>
												<td>+86612345664</td>
												<td>Voice</td>
												<td>$25.99</td>
												<td>
													<a  class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>17</td>
												<td>Malaysia</td>
												<td>Johor</td>
												<td>+6012345664</td>
												<td>Voice</td>
												<td>$64.50</td>
												<td>
													<a class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>18</td>
												<td>Singapore</td>
												<td>-</td>
												<td>+65612345664</td>
												<td>SMS</td>
												<td>$50.00</td>
												<td>
													<a  class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>19</td>
												<td>Singapore</td>
												<td>-</td>
												<td>+65612345667</td>
												<td>Voice+SMS</td>
												<td>$10.70</td>
												<td>
													<a  class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>20</td>
												<td>China</td>
												<td>Cheng Du</td>
												<td>+86612345664</td>
												<td>Voice</td>
												<td>$25.99</td>
												<td>
													<a  class="btn btn-default">Buy</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="overlay" >
										<i class="fa fa-refresh fa-spin"></i>
								</div>
							
								<div class="row">
									<div class="col-md-12">
										<nav class="pull-right">
											<ul class="pagination">
												<li class="default"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
												<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
												<li class="default"><a href="#">2 <span class="sr-only">(current)</span></a></li>
												<li class="default"><a href="#">3 <span class="sr-only">(current)</span></a></li>
												<li class="default"><a href="#">4 <span class="sr-only">(current)</span></a></li>
												<li class="default"><a href="#">5 <span class="sr-only">(current)</span></a></li>
												<li class="disabled"><a href="#">6 <span class="sr-only">(current)</span></a></li>
											</uldefault
										</nav>
									</div>
								</div>
								
		
							</div>
						</div>
					</div>
					
						
					
					<div class="row kpbuysummary"  style="display:none;">
						<div class="col-md-12">
						
							<section class="invoice" style=''>
							<!-- title row -->
							<div class="row">
								<div class="col-xs-12">
									<h2 class="page-header">
										<i class="fa fa-globe"></i> Purchase total
										<small class="pull-right">Date: <?=date("d/m/Y")?></small>
									</h2>
								</div><!-- /.col -->
							</div>
							<!-- info row -->
					 

          
          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6 table-responsive">
							 <p class="lead">Item</p>
							<table class="table table-striped table-condensed cf">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Country</th>
                    <th>Area</th>
                    <th>Number</th>
                    <th>Capabilities</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody class="kpselectedtable">
                  
                </tbody>
              </table>
            </div><!-- /.col -->
            <div class="col-xs-6">
              <p class="lead">Amount Due 2/22/2014</p>
              <div class="table-responsive">
                <table class="table">
                  <tbody><tr>
                    <th style="width:50%">Subtotal:</th>
                    <td>$250.30</td>
                  </tr>
                  <tr>
                    <th>Tax (9.3%)</th>
                    <td>$10.34</td>
                  </tr>
         
                  <tr>
                    <th>Total:</th>
                    <td>$265.24</td>
                  </tr>
									
									 <tr>
                    <th>Your current available credit:</th>
                    <td>$300.00</td>
                  </tr>
									
									<tr>
                    <th>Your Available Credit After checkout:</th>
                    <td>$34.76</td>
                  </tr>
									
                </tbody></table>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
					
					<div class="alert alert-danger alert-dismissable" style="display:none;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-ban"></i> Alert!</h4>
						Your credit balance is insufficient, please topup your amount first in order to proceed.
					</div>
					
					<div class="row no-print kpconfirm-purchase">
            <div class="col-xs-12">
              <a href="number-listing.php?success" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Confirm Purchase</a>
            </div>
          </div>

          <!-- this row will not appear when printing -->
          <div class="row no-print kp-topup" style="display:none;">
            <div class="col-xs-12">
              <a href="number-confirm.php" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Topup Balance</a>
            </div>
          </div>
        </section>

						
						
						
						</div>
					</div>


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