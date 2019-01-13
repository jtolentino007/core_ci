$(function(){
    var baseURL = Utility.BaseUrl();
    var dt = $('#tblUsers').DataTable({
        ajax: baseURL + "users/get/list",
        columns: [
            { target: [0], data: "fullname" },
            { target: [1], data: "email"},
            { target: [2], data: "createdDateTime"},
            { target: [3], data: "modifiedDateTime" },
            {
                class: "text-center",
                target: [4],
                render: function(data, row) {
                    return "<button class='btn btn-danger btn-delete'><i class='fa fa-trash'></i></button>";
                }
            }
        ]
    });

    $('#tblUsers tbody').on('click', '.btn-delete', function () {
        var currentRow  = $(this).closest('tr');
        var rowData     = dt.row(currentRow).data();

        $.ajax({
            url: baseURL + "user/delete",
            type: "POST",
            dataType: 'json',
            data: {id: rowData.id},
            success: function (response) {
                console.log(response)
                toastr.success(response.message);
                currentRow.remove();

            }, error: function (jqXHR, exception) {
                console.log(jqXHR);
                console.log(exception);
                toastr.error(jqXHR);
            }
        });

    });
});