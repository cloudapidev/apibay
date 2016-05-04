
@extends('admin_template')

@section('content')

        <!-- Filter -->
<span style="display: none" id="sbuyUrl">{{url('/')}}</span>
<div class="row">
    <div class="col-md-12">
        <form id="searchForm" class="form-horizontal" onsubmit="return false;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="box box-solid box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('numbers.Search & Filter')}}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <!-- <label for="inputPassword3" class="col-md-1 control-label">{{trans('numbers.Search')}}Country</label>
            			<div class="col-md-2">
             				 <select class="form-control">
								<option>(+1) United States</option>
								<option>(+65) Singapore</option>
							</select>
            			</div>
						<label for="inputPassword3" class="col-md-1 control-label">{{trans('numbers.Area')}}</label>
         				<div class="col-md-2">
              				<input type="text" class="form-control">
           				</div>-->
                        <label for="inputPassword3" class="col-md-1 control-label">{{trans('numbers.Number')}}</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id='number' name='number'>
                        </div>
                        <label for="inputPassword3" class="col-md-1 control-label">{{trans('numbers.Capabilities')}}</label>
                        <div class="col-md-2">
                            <select class="form-control" id="capabilities" name="capabilities">
                                <option value="VOICE">{{trans('numbers.Voice')}}</option>
                                <option value="SMS">{{trans('numbers.SMS')}}</option>
                                <option value="VOICE_SMS">{{trans('numbers.Voice + SMS')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="box-body">
                            <label for="inputPassword3" class="col-md-1 control-label">{{trans('numbers.Date Purchased')}}</label>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="purchasedDate" name="purchasedDate" class="datepicker form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="">
                                </div>
                            </div>
                            <label for="inputPassword3" class="col-md-1 control-label">{{trans('numbers.Date Expired')}}</label>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="expiredDate" id="expiredDate" class="datepicker form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="">
                                </div>
                            </div>
                            <label for="inputPassword3" class="col-md-1 control-label">{{trans('numbers.Records per page')}}</label>
                            <div class="col-md-2">
                                <select class="form-control" name="limit" id="limit">
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="150">150</option>
                                </select>
                            </div>
                            <div class="pull-right col-xm-1">
                                <span class="searchbtn btn bg-maroon btn-flat margin ">{{trans('numbers.Search')}}Search</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Filter -->
<div class="row numberList">
    <div class="pull-right">
        <a href="{{ url('numbers/buy') }}" class="btn bg-maroon btn-flat margin ">{{trans('numbers.Buy Number')}}</a>
    </div>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{trans('numbers.Results')}}</h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">



                <table id="example1" class="datatabsle table table-bordered table-striped table-condensed cf">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{trans('numbers.Number')}}</th>
                        <th>{{trans('numbers.Country')}}</th>
                        <th>{{trans('numbers.Capabilities')}}</th>
                        <th>{{trans('numbers.Date Purchased')}}</th>
                        <th>{{trans('numbers.Date Expired')}}</th>
                        <th>{{trans('numbers.Price ( Monthly )')}}</th>
                        <th>{{trans('numbers.Configuration')}}</th>
                        <th></th>
                        <!--<th>
                                <input type="checkbox" class="checkall" >
                        </th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($listDatas)):
                    $cnt=0;
                    //var_dump($listDatas[0]);
                    foreach($listDatas as $key=>$item){ ++$cnt;?>
                    <tr>
                        <td><?=$cnt ?></td>
                        <td><?=$item->number?></td>
                        <td><?=$item->country?></td>
                        <td><?=$item->capabilities?></td>
                        <td><?=$item->purchased_date?></td>
                        <td><?=$item->expired_date?></td>
                        <td><?=$item->price?></td>
                        <td>
                            <?php echo "<b>Voice</b> : <i>Forward to number :</i> ";
                            echo "<br /><b>Messaging :</b> <i>URL</i>: ";?>
                            <?php
                            /* if($item->configure_with == "Forward to number")
                                echo "<b>Voice</b> : <i>Forward to number :</i> {$item->bind_number}";
                            if($item->configure_with == "SIP Trunk")
                                echo "<b>Voice</b> : <i>Sip Trunk :</i> {$item->sip_trunk}";
                            if($item->configure_with == "Server App")
                                echo "<b>Voice</b> : <i>Server App :</i> {$item->server_app}";
                            if($item->configure_with == "Bind to user")
                                echo "<b>Voice</b> : <i>Bind to user :</i> {$item->bind_account}";
                            if($item->messaging_url)
                            echo "<br /><b>Messaging :</b> <i>URL</i>: {$item->messaging_url}";
                            if($item->messaging_server)
                            echo "<br /><b>Messaging :</b> <i>Server App</i> : {$item->messaging_server}"; */
                            ?>
                        </td>
                        <td><a href="{{url('numbers/edit',['number'=>$item->number])}}" class="btn btn-block btn-default">{{trans('numbers.Edit')}}</a></td>
                        <!--<td>
                            <input type="checkbox">
                        </td>-->
                    </tr>
                    <?php } endif; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>{{trans('numbers.Number')}}</th>
                        <th>{{trans('numbers.Country')}}</th>
                        <th>{{trans('numbers.Capabilities')}}</th>
                        <th>{{trans('numbers.Date Purchased')}}</th>
                        <th>{{trans('numbers.Date Expired')}}</th>
                        <th>{{trans('numbers.Price ( Monthly )')}}</th>
                        <th>{{trans('numbers.Configuration')}}</th>
                        <th></th>
                        <!--<th></th>-->
                    </tr>
                    </tfoot>
                </table>





            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<div class="pageLink row">


</div>
@endsection
@section('afterfooter')
    <script type="text/javascript" src="{{ asset("/bower_components/admin-lte/myjs/page.js") }}"></script>
    <script type="text/javascript" src="{{ asset("/bower_components/admin-lte/myjs/numbers/listNumber.js") }}"></script>
@endsection