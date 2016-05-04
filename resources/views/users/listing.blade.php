@extends('admin_template')

@section('content')
	<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal" onsubmit="return false;">
						<div class="box box-solid box-default">
               <div class="box-header with-border">
									<h3 class="box-title">Search & Filter</h3>
								</div><!-- /.box-header -->
											
									<div class="row">
	
										<div class="box-body">
										
												<label for="inputPassword3" class="col-md-1 control-label">Name</label>
												<div class="col-md-2">
													<div class="input-group">
														<input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="">
													</div>
												</div>
								
		
											
															
												<label for="inputPassword3" class="col-md-2 control-label">Records per page</label>
												<div class="col-md-2">
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
							</form>
							
						</div>
					</div>
		
				<!-- End Filter -->
       
        <div class="row">
						<div class="pull-right">
								<a href="{{url("users/add")}}" class="btn bg-maroon btn-flat margin ">Create New</a>
						</div>
						
						
            <div class="col-xs-12">
							
			
														 <div class="box">
														 
																<div class="box-header with-border">
																	<h3 class="box-title">Results</h3>
																</div>
														
																<div class="box-body table-responsive">
																	<table id="example1" class="display">
																		<thead>
																			<tr>
																				<th>#</th>
																				<th>Login</th>
																				<th>Full Name</th>
																				<th>Email</th>
																				<th>External ID</th>
																				<th>Facebook</th>
																				<th>Twitter</th>
																				<th>Tag</th>
																				<th>Last Signin</th>
																				<th>Date Created</th>
																				<th></th>
																			</tr>
																		</thead>
																		<tbody>
																			

																			<tr>
																				<td>$cnt </td>
																				<td>$item['login']</td>
																				<td>$item['fullname']</td>
																				<td>$item['email']</td>
																				<td>$item['external_id']</td>
																				<td>$item['facebook']</td>
																				<td>$item['twitter']</td>
																				<td>$item['tag']</td>
																				<td>$item['lastsignin']</td>
																				<td>$item['date_create']</td>
																				<td><a href="url('users/edit',['id'=>$item['id']])" class="btn btn-block btn-default">Edit</a></td>
																			</tr>

																		</tbody>
																		<tfoot>
																			<tr>
																				<th>#</th>
																				<th>Login</th>
																				<th>Full Name</th>
																				<th>Email</th>
																				<th>External ID</th>
																				<th>Facebook</th>
																				<th>Twitter</th>
																				<th>Tag</th>
																				<th>Last Signin</th>
																				<th>Date Created</th>
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
	<script type="text/javascript" src="{{ asset("/bower_components/admin-lte/myjs/users/listUsers.js") }}"></script>
	<script>
 
	$('.checkall').on('ifChecked', function(event){
			$('input[type=checkbox]').iCheck('check');
	});
	$('.checkall').on('ifUnchecked', function(event){
			$('input[type=checkbox]').iCheck('uncheck');
	});
 </script>
 @endsection