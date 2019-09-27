function search() {
    var search_data = $('#search_data').val();
    if (search_data != '') {
        $.ajax({
            type: 'post',
            url: 'operations/search.php',
            data: {
                search_data: search_data
            },
            success: function (response) {
                document.getElementById('results').innerHTML = response;
            }
        });
        return false;
    }
}