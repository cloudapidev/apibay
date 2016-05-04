/**
 * Created by Administrator on 2016/4/18.
 */

$(function(){
    var url=$('#url').html();
    $("body").delegate('#create','click',saveInfo);
    function saveInfo()
    {
        var data=$('#Credentialsform').serialize();
        $.ajax({
            type: "post",
            url: url+"/clientapps/create",
            data: data,
           /* success: function (res) {
                console.log(res);
                res = dealResult(res);
                if (res.flag == 'success') {
                    showSuccessNotice(res.msg);
                    window.location.reload()
                } else {
                    showErrorNotice(res.msg);
                }
            }*/
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




