$(document).ready(function(){
    $('#data_table').Tabledit({
        url: 'live.php',
        deleteButton: false,
        editButton: false,
        columns: {
        identifier: [0, 'username'],
        editable: [ [1, 'Namep']]
        }
    });
});