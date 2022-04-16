<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Todo List App</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css"
      integrity="sha512-xX2rYBFJSj86W54Fyv1de80DWBq7zYLn2z0I9bIhQG+rxIF6XVJUpdGnsNHWRa6AvP89vtFupEPDP8eZAtu9qA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="wrapper">
      <h2 class="title">Todo List Apps</h2>
      <div class="input-fields">
        <input
          type="text"
          name="task-title"
          id="taskTitle"
          class="form-control"
          placeholder="Enter the Task Title"
        />
        <button type="submit" class="btn" id="btnSubmit"><i class="fas fa-plus"></i></button>
      </div>
      <div class="content">
        <ul id="tasksContent">
          
        </ul>
      </div>
    </div>

    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            function getAllTasks() {
                $.ajax({
                    url: "show_todo.php",
                    type: "POST",
                    success: function(res) {
                        $('#tasksContent').html(res)
                    }
                })
            }

            getAllTasks()

            $('#btnSubmit').on('click', function(e){
                e.preventDefault;

                let taskTitle = $('#taskTitle').val();

                if(taskTitle === "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please set task title!',
                    })
                    return;
                }
                
                $.ajax({
                    url: 'add_todo.php',
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        task_title: taskTitle
                    },
                    success: function(res) {
                       if(res.response == 200) {
                           getAllTasks();
                           Toast.fire({
                                icon: 'success',
                                title: res.message
                            })
                            $('#taskTitle').val("");
                       }
                    }
                })
            });

           $(document).on('click', '#btnDelete', function(e) {
                e.preventDefault;

                let taskId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You can't recover this task after deleted",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, no doubt!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "delete_todo.php",
                            type: "POST",
                            dataType: "JSON",
                            data: {
                                task_id: taskId
                            },
                            success: function(res) {
                               if(res.response == 200) {
                                   Swal.fire(
                                    'Deleted!',
                                    res.message,
                                    'success'
                                    )
                                    getAllTasks()
                               }
                                
                            }
                        })
                        
                    }
                })
           });
        });
    </script>
  </body>
</html>
