/**
 * Created by Administrator on 2016/4/18.
 */
$(function () {
    url = $("#rootUrl").html();
    $("#example1").DataTable({
        "paging": true,
        "select": true,
        "processing": true,
        "serverSide": true,
        "ajax": "users/get",
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "columns": [
            {"data": "index"},
            {"data": "login"},
            {"data": "fullname"},
            {"data": "email"},
            {"data": "external_id"},
            {"data": "facebook"},
            {"data": "twitter"},
            {"data": "tag"},
            {"data": "lastsignin"},
            {"data": "date_create"},
            {
                "data": "edit", "render": function (data, type, full, meta) {
                return '<a href="' + url + "/siptrunk/edit/" + data + '" class="btn btn-block btn-default" type="button">Edit</a>'
            }
            }
        ]
    });
});