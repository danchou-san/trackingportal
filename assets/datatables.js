$(document).ready(function() {
    $('#datatable').DataTable( {
         "searching": false,
         "paging": true,
         "info": false,
         "lengthChange":false,
         "columnDefs": [ {
             "targets": 'no-sort',
             "orderable": false,
        } ]
    } );
} );

$(document).ready(function(){
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
