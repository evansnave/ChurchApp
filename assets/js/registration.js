 $(document).ready(function () {
    fetch_members();
    fetch_first_timers();
    fetch_registered();


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
                fetch_first_timers();
            }
        })
    });

    $('#add_member').click(function () {
        $('#members_modal').modal('show');
        $('#members_form')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add Member");
        $('#action').val("Add Member");
        $('#btn_action').val("Add");
    });


    $(document).on('submit', '#members_form', function (event) {
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        var form_data = $(this).serialize();
        $.ajax({
            url: "operations/members.php",
            method: "POST",
            data: form_data,
            success: function (data) {
                $('#members_form')[0].reset();
                $('#members_modal').modal('hide');
                $('#alert').fadeIn().html(data);
                $('#action').attr('disabled', false);
                fetch_members();
            }
        })
    });

    $(document).on('click', '.register', function () {
        var id = $(this).attr("id");
        $.ajax({
            url: "operations/members_present.php",
            method: "POST",
            data: { id:id },
            success: function (data) {
                $('#alert').fadeIn().html(data);
                fetch_members();
            }
        })
            $('#alert').fadeIn().html('<div class = "alert alert-info text-center" > Registered Successfully </div><br>');
        fetch_members();
        fetch_registered();
    });

    $(document).on('click', '.revert', function () {
        var id = $(this).attr("id");
        $.ajax({
            url: "operations/revert.php",
            method: "POST",
            data: {
                id: id
            },
            success: function (data) {
                $('#alert').fadeIn().html(data);
                fetch_members();
            }
        })
        $('#alert').fadeIn().html('<div class = "alert alert-info text-center" > Reverted Successfully </div><br>');
        fetch_members();
        fetch_registered();
    });
    
    $(document).on('click', '.register_ft', function () {
        var id = $(this).attr("id");
        $.ajax({
            url: "operations/first_timers_present.php",
            method: "POST",
            data: { id: id},
            success: function (data) {
                $("#alert").fadeIn(3000, function () {
                    $("#alert").html('<div class="alert alert-success"> Registered Successfully </div><br>');
                    // fetch_first_timers();
                });
            }
        })
        fetch_first_timers();

    });

    function fetch_members() {
        $("#load").load('load/members_registration.php')
    }
    
    function fetch_first_timers() {
        $("#first_timers").load('load/first_timers_registration.php')
    }
    
    function fetch_registered() {
        $("#members_data").load('load/registered.php')
    }

});