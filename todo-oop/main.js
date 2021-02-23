$(document).ready(function () {
    loadtask();
    function loadtask() {
        var action = 'load';
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { action: action },
            success: function (data) {
                $('#todo-table').html(data);
            }
        })
    }
    // insert record

    $('#submit').on('click', function (event) {
        event.preventDefault();
        if ($('#detailtext').val() == '') {
            alert('Enter the task detail');
            return false;
        } else {
            var detail = $('#detailtext').val();
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: {
                    detail: detail
                },
                success: function (data) {
                    // alert(data);
                    loadtask();
                    if (data == "inserted") {
                        toastr.success("Task has been Added sucessfully");
                        $('#todo_form')[0].reset();
                    }
                }

            });
        }

    });

    // delete record
    $(document).on('click', '#remove-btn', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        var action = "delete";
        $.ajax({
            url: 'action.php',
            method: 'POST',
            data: { id: id, action: action },
            success: function (data) {
                if (data == "deleted") {
                    toastr.success("Task has been deleted sucessfully");
                    window.location.reload();

                }

            }
        })

    });
});


