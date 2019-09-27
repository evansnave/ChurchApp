 $(document).ready(function () {

     $('#assign_button').click(function () {
         $('#assign').modal('show');
         $('#action').val("Assign Senior Cell");
         $('#btn_action1').val("Edit");
     });

     $(document).on('click', '#assign_button', function (e) {
         var first_timer_id = $(this).data('id');
         submitForm(first_timer_id);
     });

     function submitForm(first_timer_id) {
         $(document).on('submit', '#assignSeniorCellForm', function (event) {
             event.preventDefault();
             $('#action').attr('disabled', 'disabled');
             var form_data = $(this).serialize();
             $.ajax({
                 url: "operations/first_timers.php?id=" + first_timer_id,
                 method: "POST",
                 data: form_data,
                 success: function (data) {
                     $('#alert').fadeIn().html(data);
                     location.reload();

                 }
             })
         });
     }

 });