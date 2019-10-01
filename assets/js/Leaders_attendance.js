$(document).ready(function () {
    fetch_data();

    $(document).on('click', '#start', function (e) {
        startAttendance();
        e.preventDefault();
    });

    $(document).on('click', '#end', function (e) {
        var service_id = $(this).data('id');
        endAttendance(service_id);
        e.preventDefault();
    });
   
    $(document).on('click', '#delete_service', function (e) {
        var service_id = $(this).data('id');
        deleteService(service_id);
        e.preventDefault();
    });

    function startAttendance() {
        swal({
            title: 'Are you sure?',
            text: "This will start today's attendance registration!",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Start',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {

                    $.ajax({
                            url: 'operations/start_leaders_attendance.php',
                            type: 'POST',
                            dataType: 'json'
                        })
                        .done(function (response) {
                            swal('Success!', response.message, response.status);
                            document.location.reload();
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

    function endAttendance(service_id) {
        swal({
            title: 'Are you sure?',
            text: "This will end today's registration!",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'End',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {

                    $.ajax({
                            url: 'operations/end_leaders_attendance.php',
                            type: 'POST',
                            data: 'end=' + service_id,
                            dataType: 'json'
                        })
                        .done(function (response) {
                            swal('Success!', response.message, response.status);
                            var delay = 1000;
                            document.location.reload();           
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

    function deleteService(service_id) {
        swal({
            title: 'Are you sure?',
            text: "This attendance record will be delete",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {

                    $.ajax({
                            url: 'operations/delete/Leaders_attendance.php',
                            type: 'POST',
                            data: 'delete='+ service_id,
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

//=====ajax live update for table=====//
function fetch_data() {
    $.ajax({
        url: "load/Leaders_attendence.php",
        method: "POST",
        success: function (data) {
            $('#load').html(data);
        }
    });
}