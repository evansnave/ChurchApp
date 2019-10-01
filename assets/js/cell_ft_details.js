$(document).ready(function () {

    fetch_data();

    $(document).on('click', '#delete_product', function (e) {

        var firstTimerId = $(this).data('id');
        SwalDelete(firstTimerId);
        e.preventDefault();
    });


    function SwalDelete(firstTimerId) {
        swal({
            title: 'Are you sure?',
            text: "First Timer will be deleted permanently!",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {

                    $.ajax({
                            url: 'operations/delete/cell_first_timers.php',
                            type: 'POST',
                            data: 'delete=' + firstTimerId,
                            dataType: 'json'
                        })
                        .done(function (response) {
                            swal('Deleted!', response.message, response.status);
                            fetch_data();
                        })
                        .fail(function () {
                            swal('Oops...', 'Something went wrong. Try Again!', 'error');
                        });
                });
            },
            allowOutsideClick: false
        });
    }

});