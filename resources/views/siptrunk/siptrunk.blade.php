@extends('admin_template')
@section('content')
<span id="rootUrl" style="display: none">{{url("/")}}</span>
<div class="row">
	<div class="search col-md-12">
		<form id="searchForm" class="form-horizontal" onsubmit="return false;">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="box box-solid box-default">
		         <div class="box-header with-border">
					<h3 class="box-title">Search & Filter</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<label for="inputPassword3" class="col-md-1 control-label">Name</label>
					<div class="col-md-2">
						<div class="input-group">
							<input name="name" type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="">
						</div>
					</div>
					<label id='limit' for="inputPassword3" class="col-md-2 control-label">Records per page</label>
					<div class="col-md-2">
							<select class="form-control" name="limit">
								<option value='0'>- Select -</option>
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="30">30</option>
								<option value="40">40</option>
								<option value="50">50</option>
							</select>
					</div>
					<div class="pull-right col-xm-1">
						<a href="#" class="searchBtn btn bg-maroon btn-flat margin ">Search</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- End Filter -->
<div class="resultsList row">
		<div class="pull-right">
				<span data-toggle="modal" data-target="#creatNew" class="btn bg-maroon btn-flat margin" data-backdrop='static'>Create New</span>
		</div>
        <div class="col-xs-12">
			 <div class="box">
				
				<div class="box-header with-border">
					<h3 class="box-title">Results</h3>
				</div>
				<div class="box-body table-responsive">
					<table id="example1" class="datatable table table-bordered table-striped table-condensed cf">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Termination URI</th>
								<th>Origination URI </th>
								<th>No. of Channel</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php $cnt=0; if(!empty($allTrunks)):?>
							<?php  foreach($allTrunks as $key=>$item): ++$cnt;
							
							?>
							<tr>
								<td><?=$cnt ?></td>
								<td><?=$item->name?></td>
								<td><?=$item->termination_uri?>.pstn.apibay.com</td>
								<td></td>
								<td></td>
								<td><a href='{{url("siptrunk/edit",["id"=>$item->id])}}' class="btn btn-block btn-default">Edit</a></td>
							</tr>
							<?php endforeach;  ?>
							<?php endif;?>
						</tbody>
						<tfoot>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Termination URI</th>
								<th>Origination URI</th>
								<th>No. of Channel</th>
								<th></th>
						 </tr>
						</tfoot>
					</table>
				</div><!-- /.box-body -->
				
				</div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
					
	<!-- 			<div class="row">
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
					</div> -->	
<div id="creatNew" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Creat New</h4>
      </div>
      <div class="modal-body">
        <form id="modelForm" method="post" class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        	 <div class="form-group">
			    <label for="name" class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="name" name="name" placeholder="name">
			    </div>
			  </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="creatNewBtn btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('afterfooter')
<script type="text/javascript" src="{{ asset("/bower_components/admin-lte/myjs/sipTrunks/listTrunks.js") }}"></script> 
@endsection