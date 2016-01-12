@extends('admin_template')

@section('content')

<!-- Filter -->
<div class="row">
	<div class="col-md-12">
		<form class="form-horizontal" onsubmit="return false;">
			<div class="box box-solid box-default">
      			 <div class="box-header with-border">
						<h3 class="box-title">Search & Filter</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
          			<div class="row">
						<label for="inputPassword3" class="col-md-1 control-label">Country</label>
            			<div class="col-md-2">
             				 <select class="form-control">
								<option>(+1) United States</option>
								<option>(+65) Singapore</option>
							</select>
            			</div>
						<label for="inputPassword3" class="col-md-1 control-label">Area</label>
         				<div class="col-md-2">
              				<input type="text" class="form-control">
           				</div>
						<label for="inputPassword3" class="col-md-1 control-label">Number</label>
						<div class="col-md-2">
             				<input type="text" class="form-control">
            			</div>
						<label for="inputPassword3" class="col-md-1 control-label">Capabilities</label>
						<div class="col-md-2">
							<select class="form-control">
									<option>Voice</option>
									<option>SMS</option>
									<option>Voice + SMS</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="box-body">
							<label for="inputPassword3" class="col-md-1 control-label">Date Purchased</label>
							<div class="col-md-2">
								<div class="input-group">
									<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="">
								</div>
							</div>
							<label for="inputPassword3" class="col-md-1 control-label">Date Expired</label>
							<div class="col-md-2">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="">
								</div>
							</div>
							<label for="inputPassword3" class="col-md-1 control-label">Records per page</label>
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
			</div>
		</form>
	</div>
</div>
		<!-- End Filter -->
<div class="row">
	<div class="pull-right">
		<a href="{{ url('numbers/buy') }}" class="btn bg-maroon btn-flat margin ">Buy Number</a>
	</div>
    <div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Results</h3>
			</div><!-- /.box-header -->
		<div class="box-body table-responsive">
		
		
		
			<table id="example1" class="datatabsle table table-bordered table-striped table-condensed cf">
				<thead>
					<tr>
						<th>#</th>
						<th>Number</th>
						<th>Country</th>
						<th>Area</th>
						<th>Capabilities</th>
						<th>Date Purchased</th>
						<th>Date Expired</th>
						<th>Price ( Monthly )</th>
						<th>Configuration</th>
						<th></th>
						<!--<th>
								<input type="checkbox" class="checkall" >
						</th>-->
						</tr>
					</thead>
					<tbody>
						<?php $cnt=0; //$listData=openCSV("number-listing");
						foreach($listDatas as $key=>$item){ ++$cnt;?>
						<tr>
							<td><?=$cnt ?></td>
							<td><?=$item['number']?></td>
							<td><?=$item['country']?></td>
							<td><?=$item['area']?></td>
							<td><?=$item['capability']?></td>
							<td><?=$item['date_purchase']?></td>
							<td><?=$item['date_expire']?></td>
							<td><?=$item['price']?></td>
							<td>
								<?php 
									if($item['configure_with'] == "Forward to number")
										echo "<b>Voice</b> : <i>Forward to number :</i> {$item['bind_number']}";
									if($item['configure_with'] == "SIP Trunk")
										echo "<b>Voice</b> : <i>Sip Trunk :</i> {$item['sip_trunk']}";
									if($item['configure_with'] == "Server App")
										echo "<b>Voice</b> : <i>Server App :</i> {$item['server_app']}";
									if($item['configure_with'] == "Bind to user")
										echo "<b>Voice</b> : <i>Bind to user :</i> {$item['bind_account']}";
									if($item['messaging_url'])
									echo "<br /><b>Messaging :</b> <i>URL</i>: {$item['messaging_url']}";
									if($item['messaging_server'])
									echo "<br /><b>Messaging :</b> <i>Server App</i> : {$item['messaging_server']}";
								?>
							</td>
							<td><a href="{{url('numbers/edit',['id'=>$item['id']])}}" class="btn btn-block btn-default">Edit</a></td>
							<!--<td>
								<input type="checkbox">
							</td>-->
						</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<th>#</th>
							<th>Number</th>
							<th>Country</th>
							<th>Area</th>
							<th>Capabilities</th>
							<th>Date Purchased</th>
							<th>Date Expired</th>
							<th>Price ( Monthly )</th>
							<th>Configuration</th>
							<th></th>
							<!--<th></th>-->
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