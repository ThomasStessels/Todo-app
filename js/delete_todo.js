$(document).ready(function(){
    $('#delete').click(function(){
        var todoId = $(this).data("todoId");
            $.ajax({
                url: 'ajax/delete_todo.php',
                type: 'POST',
                data: { todoId: todoId }
            });
    });
});