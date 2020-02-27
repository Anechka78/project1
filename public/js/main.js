$( document ).ready(function(){

    $('#add_new_task').on('click', function (){
        document.getElementById("add_task_box").style.display="block";
        document.getElementById("add_new_task").style.display="none";
    });


    $('#task_checkbox').on('click', function (){
        var id = $(this).val();
        if($(this).prop("checked")){
            var check = 1;
        }else{
            var check = 0;
        }

        $.ajax({
            type: 'POST',
            url: "/task/update-check",
            data: {'status': check, 'id': id},
            dataType: 'json',
            success: function(data){
                if(data['warning'] == 1){
                    alert(data['message']);
                    window.location.href = '/user/index';
                }
                alert(data['message']);
            },
            error: function(data) {
                console.log('Error...');
            }
        });
    });




});







