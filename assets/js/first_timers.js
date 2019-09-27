    $(document).ready(function () {

        fetch_data();

        $('#add_button').click(function () {
            $('#first_timer_modal').modal('show');
            $('#first_timer_form')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Add First Timer");
            $('#action').val("Add First Timer");
            $('#btn_action1').val("Add");
        });


        $(document).on('submit', '#first_timer_form', function (event) {
            event.preventDefault();
            $('#action').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({
                url: "operations/first_timers.php",
                method: "POST",
                data: form_data,
                success: function (data) {
                    $('#first_timer_form')[0].reset();
                    $('#first_timer_modal').modal('hide');
                    $('#alert').fadeIn().html(data);
                    $('#action').attr('disabled', false);
                    fetch_data();
                }
            })
        });

    });

//=====ajax live update for table=====//
function fetch_data() {
    $.ajax({
        url: "load/first_timers.php", 
        method : "POST",
        success : function (data) {
            $('#load').html(data);
        }
    });
}
// fetch_data();