$(document).ready(function(){
    console.log("eg2 enter");
    $('.project_table').Tabledit({
        url: 'live2.php',
        deleteButton: false,
        editButton: false,
        columns: {
        identifier: [0, 'inc'],
        editable: [ [1, 'name'],[2, 'hours']]
        },
        hideIdentifier:true
    });
    $('#myModal').on('show.bs.modal', function () {
        console.log("inside");
        $('.project_table').Tabledit({
            url: 'live2.php',
            deleteButton: false,
            editButton: false,
            columns: {
            identifier: [0, 'inc'],
            editable: [ [1, 'name'],[2, 'hours']]
            },
            hideIdentifier:true
        });
    });
});



