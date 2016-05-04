$(function(){
    var url=$('#rootUrl').html();
    $('.checkall').on('ifChecked', function(event){
        $('input[type=checkbox]').iCheck('check');
    });
    $('.checkall').on('ifUnchecked', function(event){
        $('input[type=checkbox]').iCheck('uncheck');
    });

    $("body").delegate('#saveinfo',"click",saveInfo);
    $("body").delegate('#updateInfo',"click",update);
    $("body").delegate('#removeApp',"click",remove);


        function remove()
        {
            var id=$("#appId").val();
            $.ajax({
                url:url+'/serverapps/remove/'+id,
                success:function(res){
                    console.log(res);
                    res=dealResult(res);
                    if(res.flag =='success')
                    {
                        showSuccessNotice("Delete Successfully");
                        window.location.reload()
                    }
                    else
                    {
                        showErrorNotice(res.msg);
                    }
                },
                error:function(res){
                    console.log(res);
                }


            })
        }
        function update()
        {
            var data=$("#saveAppsInfo").serialize();

            $.ajax({
                url:url+"/serverapps/update",
                type:'post',
                data:data,
                success:function(res) {
                    console.log(res);
                    res = dealResult(res);
                    if(res.flag == 'success')
                    {
                        showSuccessNotice("Save Successfully");
                        window.location.reload()

                    }else
                    {
                        showErrorNotice(res.msg);
                    }

                }


            })
        }
        function saveInfo()
        {
            var data=$("#saveAppsInfo").serialize();
            $.ajax({
                url:url+"/serverapps/create",
                type:'post',
                data:data,
                success:function(res) {
                    console.log(res);
                    res = dealResult(res);
                    if(res.flag == 'success')
                    {
                        showSuccessNotice("Save Successfully");
                        window.location.reload()

                    }else
                    {
                        showErrorNotice(res.msg);
                    }

                }
            });
        }
    function showSuccessNotice(data)
    {
        var obj=$("#success");
        var eObj=$("#error");
        var str="<p>"+data+"</p>";
        obj.find("p").empty();
        obj.find("p").append($(str));
        eObj.hide();
        obj.show();
        setTimeout(function () {
            obj.hide();
        }, 6000);
    }
    function showErrorNotice(data)
    {
        var obj=$("#error");
        var sObj=$("#success");
        var str="<p>"+data+"</p>";
        obj.find('p').empty();
        obj.find('p').append($(str))
        sObj.hide();
        obj.show();
        setTimeout(function () {

            obj.hide();

        }, 6000);


    }
    function dealResult(res)
    {
        res=eval("("+res+")");
        return res;
    }
    });
$(function () {
    var url=$('#rootUrl').html();
    $("#example2").DataTable({
        "paging": true,
        "select": true,
        "processing": true,
        "serverSide": true,
        "ajax": url+"/serverapps/getnum",
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
   /*   "columns": [
            {"data": "index"},
            {"data": "name"},
            {"data": "termination_uri"},
            {"data": "origination_uri"},
            {"data": "channel"},
            {"data":"edit","render":function(data,type,full,meta){return '<a href="'+url+"/siptrunk/edit/"+data+'" class="btn btn-block btn-default" type="button">Edit</a>'}}
        ]*/
    });
});


