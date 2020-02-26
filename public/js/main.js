$( document ).ready(function(){

    $('#add_new_task').on('click', function (){
        document.getElementById("add_task_box").style.display="block";
        document.getElementById("add_new_task").style.display="none";
    });

    $('#user_name').on('change', function (){
        var email = $('#user_name option:selected').attr('data-email');
        $('#add_task_user_email').val(email);
    });

});







