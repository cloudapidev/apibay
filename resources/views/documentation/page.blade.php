
@extends('admin_template')

@section('content')

<div class="row">

            <div class="col-xs-12">
							
							
							<div class="nav-tabs-custom">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-info-circle"></i> Documentation</a></li>
									<li><a href="#tab_2" data-toggle="tab"><i class="fa fa-bars"></i> API Explorer</a></li>
									<li><a href="#tab_3" data-toggle="tab"><i class="fa fa-cube"></i> SDK</a></li>
								</ul>
								
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1">	
										<?php $type="apisdk"; require("template.php"); ?>											
									</div>

									<div class="tab-pane" id="tab_2">
											<iframe id='apiex' width="100%" frameBorder="0" height="700" src="http://restapi.hosting.gnum.com/"></iframe>
									</div>
									
									<div class="tab-pane" id="tab_3">
										<?php $type="sdk"; require("template.php");?>
									</div>

								</div>
							</div>
						
					
     
    </div><!-- /.col -->
  </div><!-- /.row -->

  @endsection
