@extends('admin_template')
@section('content')
<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal" onsubmit="return false;">
						<div class="box box-solid box-default">
               <div class="box-header with-border">
									<h3 class="box-title">Search & Filter</h3>
								</div><!-- /.box-header -->
								
								
								
								<div class="box-body">
								
									<div class="row">
									
									
									
										<div class="box-body">
										
												<label for="inputPassword3" class="col-md-1 control-label">Name</label>
												<div class="col-md-2">
													<div class="input-group">
														<input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="">
													</div>
												</div>
								
		
												<label for="inputPassword3" class="col-md-1 control-label">Type</label>
												<div class="col-md-2">
													<div class="input-group">
															<select class="form-control" id="application_type" name="application[type]" required="required" aria-required="true"><option value="Other" selected="selected">Other</option>
															<option value="Game">Game</option>
															<option value="Fun">Fun</option>
															<option value="Office">Office</option>
															<option value="Productivity">Productivity</option>
															<option value="Books">Books</option>
															<option value="Business">Business</option>
															<option value="Dining">Dining</option>
															<option value="Education">Education</option>
															<option value="Entertainment">Entertainment</option>
															<option value="Finance">Finance</option>
															<option value="Food">Food and Drink</option>
															<option value="Gaming">Gaming</option>
															<option value="Lifestyle">Lifestyle</option>
															<option value="Local">Local</option>
															<option value="Medical">Medical</option>
															<option value="Music">Music</option>
															<option value="News">News</option>
															<option value="Photo">Photo &amp; Video</option>
															<option value="Security">Security</option>
															<option value="SocialNetworking">Social Networking</option>
															<option value="SocialNetworkingDating">Social Networking (Dating)</option>
															<option value="Sports">Sports</option>
															<option value="Travel">Travel</option>
															<option value="Utilities">Utilities</option></select>
													</div>
												</div>
												
															
												<label for="inputPassword3" class="col-md-2 control-label">Records per page</label>
												<div class="col-md-1">
														<select class="form-control">
															<option>- Select -</option>
															<option>50</option>
															<option>100</option>
															<option>150</option>
														</select>
												</div>
												
												<div class="pull-right col-xm-1">
													<a href="#" class="btn bg-maroon btn-flat margin ">Search</a>
												</div>

										</div>
										
									</div>
								</div>
							</div>
							</form>
							
						</div>
					</div>
		
				<!-- End Filter -->
       
        <div class="row">
						<div class="pull-right">
								<a href="clientapp-new.php" class="btn bg-maroon btn-flat margin ">Create New</a>
						</div>
						
						
            <div class="col-xs-12">
							
			
														 <div class="box">
														 
																<div class="box-header with-border">
																	<h3 class="box-title">Results</h3>
																</div>
														
																<div class="box-body table-responsive">
																	<table id="example1" class="datastable table table-bordered table-striped table-condensed cf">
																		<thead>
																			<tr>
																				<th>#</th>
																				<th>Icon</th>
																				<th>Name</th>
																				<th>Date create</th>
																				<th>Type</th>
																				<th>Description</th>
																				<th>Total Users</th>
																				<th></th>
																			</tr>
																		</thead>
																		<tbody>
																			
																			<?php $cnt=0; foreach(openCSV("clientapp-listing") as $key=>$item){ ++$cnt;?>
																			<tr>
																				<td data-title="Monday"><?=$cnt ?></td>
																				<td style="width:20px;" data-title="Monday">
																					<div class="icon">
																						<span class="info-box-icon <?=$item['background']?>"><i class="fa <?=$item['icon']?>"></i></span> 
																					</div>
																				</td>
																				<td>
																						<?=$item['name']?>
																				</td>
																				<td data-title="Monday"><?=$item['date_create']?></td>
																				<td data-title="Monday"><?=$item['type']?></td>
																				<td data-title="Monday"><?=$item['description']?></td>
																				<td data-title="Monday"><?=$item['no_user']?></td>
																				<td><a href='clientapp-new.php?edit' class="btn btn-block btn-default">Edit</a></td>
																			</tr>
																			<?php } ?>
																		</tbody>
																		<tfoot>
																			<tr>
																				<th>#</th>
																				<th>Icon</th>
																				<th>Name</th>
																				<th>Date create</th>
																				<th>Type</th>
																				<th>Description</th>
																				<th>Total Users</th>
																				<th></th>
																				<th></th>
																		 </tr>
																		</tfoot>
																	</table>
																</div><!-- /.box-body -->
															</div><!-- /.box -->

				
							
             
            </div><!-- /.col -->
          </div><!-- /.row -->
					
					<div class="row">
						<div class="col-xs-12">
							<nav class="pull-right">
								<ul class="pagination">
									<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
									<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
									<li class="default"><a href="#">2 <span class="sr-only">(current)</span></a></li>
									<li class="default"><a href="#">3 <span class="sr-only">(current)</span></a></li>
									<li class="default"><a href="#">4 <span class="sr-only">(current)</span></a></li>
									<li class="default"><a href="#">5 <span class="sr-only">(current)</span></a></li>
									<li class="default"><a href="#">6 <span class="sr-only">(current)</span></a></li>
								</ul>
							</nav>
						</div>
					</div>
@endsection
@section('afterfooter')
 <script>
 
	$('.checkall').on('ifChecked', function(event){
			$('input[type=checkbox]').iCheck('check');
	});
	$('.checkall').on('ifUnchecked', function(event){
			$('input[type=checkbox]').iCheck('uncheck');
	});
 </script>
@endsection