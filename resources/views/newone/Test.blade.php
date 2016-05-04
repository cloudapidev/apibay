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
                    <h3 class="box-title">Table</h3>
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

                        @if(!empty($allTrunks))
                            @foreach($allTrunks as $key=>$item)
                        <tr>
                            <td>{{$key+1}} </td>
                            <td> {{$item->name}}</td>
                            <td>{{$item->termination_uri}}.pstn.apibay.com</td>
                            <td></td>
                            <td></td>
                            <td><a href='{{url("newone/edit",["id"=>$item->id])}}' class="btn btn-block btn-default">Edit</a></td>
                        </tr>
                          @endforeach
                        @endif
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




@endsection
@section('afterfooter')
    <script type="text/javascript" src="{{ asset("/bower_components/admin-lte/myjs/sipTrunks/listTrunks.js") }}"></script>
@endsection