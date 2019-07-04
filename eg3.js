$(document).ready(function(){
    $('#ldata_table').Tabledit({
        url: 'livel.php',
        deleteButton: false,
        editButton: false,
        columns: {
            identifier: [0, 'username'],
            editable: [ [1, 'Namep'], [2, 'domain'], [3, 'dept']]
        }
    });
});