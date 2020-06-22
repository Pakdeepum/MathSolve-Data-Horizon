<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MathSolve</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
    <body>
        <style>
            .modal {
              position: fixed;
              left: 0;
              top: 0;
              width: 100%;
              height: 100%;
              background-color: rgba(0, 0, 0, 0.5);
              opacity: 0;
              display: flex;
              justify-content: center;
              align-items: center;
              visibility: hidden;
              transform: scale(1.1);
              transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
            }
            .modal-content {
              align-self: center;
              background-color: white;
              padding: 1rem 1.5rem;
              width: 24rem;
              border-radius: 0.5rem;
            }
            
            .btn-close {
              float: right;
              width: 1.5rem;
              line-height: 1.5rem;
              text-align: center;
              cursor: pointer;
              border-radius: 0.25rem;
              background-color: lightgray;
            }
            
            .show-modal {
              opacity: 1;
              visibility: visible;
              transform: scale(1);
              transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
            }
        </style>

        @include('inc.navbar')
        <p></p>
        <p></p>
        <p></p>
        <p></p>
        <div class="row">
            <div class="col-1">
            
            </div>
            <div class="col-10">
                @yield('content')
            </div>
            <div class="col">

            </div>   
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    </body>

    <script>
      $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        /*  When user click add user button */
        $('#create-new-user').click(function () {
            $('#btn-save').val("create-user");
            $('#userForm').trigger("reset");
            $('#userCrudModal').html("Add New User");
            $('#ajax-crud-modal').modal('show');
        });
     
       /* When click edit user */
        $('body').on('click', '#edit-user', function () {
          var user_id = $(this).data('id');
          $.get('ajax-crud/' + user_id +'/edit', function (data) {
             $('#userCrudModal').html("Edit User");
              $('#btn-save').val("edit-user");
              $('#ajax-crud-modal').modal('show');
              $('#user_id').val(data.id);
              $('#name').val(data.name);
              $('#email').val(data.email);
          })
       });
       //delete user login
        $('body').on('click', '.delete-user', function () {
            var user_id = $(this).data("id");
            confirm("Are You sure want to delete !");
     
            $.ajax({
                type: "DELETE",
                url: "{{ url('ajax-crud')}}"+'/'+user_id,
                success: function (data) {
                    $("#user_id_" + user_id).remove();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });   
      });
     
     if ($("#userForm").length > 0) {
          $("#userForm").validate({
     
         submitHandler: function(form) {
     
          var actionType = $('#btn-save').val();
          $('#btn-save').html('Sending..');
          
          $.ajax({
              data: $('#userForm').serialize(),
              url: "https://www.tutsmake.com/laravel-example/ajax-crud/store",
              type: "POST",
              dataType: 'json',
              success: function (data) {
                  var user = '<tr id="user_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td>';
                  user += '<td><a href="javascript:void(0)" id="edit-user" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
                  user += '<td><a href="javascript:void(0)" id="delete-user" data-id="' + data.id + '" class="btn btn-danger delete-user">Delete</a></td></tr>';
                   
                  
                  if (actionType == "create-user") {
                      $('#users-crud').prepend(user);
                  } else {
                      $("#user_id_" + data.id).replaceWith(user);
                  }
     
                  $('#userForm').trigger("reset");
                  $('#ajax-crud-modal').modal('hide');
                  $('#btn-save').html('Save Changes');
                  
              },
              error: function (data) {
                  console.log('Error:', data);
                  $('#btn-save').html('Save Changes');
              }
          });
        }
      })
    }
       
      
    </script>
</html>
