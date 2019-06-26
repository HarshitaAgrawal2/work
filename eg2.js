$(document).ready(function(){
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