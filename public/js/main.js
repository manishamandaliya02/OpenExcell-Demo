$(document).ready(function() {

     // posts datatable
     $('#posts').DataTable();

    // users datatable
    $('#users').DataTable();

    // form validation
    $("#regForm").validate({
               rules: {
                   name: {
                       required: true,
                       maxlength: 20,
                   },
                   email: {
                       required: true,
                       email: true,
                       maxlength: 50
                   },
                   password: {
                       required: true,
                       minlength: 5
                   },
                   confirmPassword: {
                       required: true,
                       equalTo: "#password"
                   }
               },
               messages: {
                   name: {
                       required: "Name is required",
                       maxlength: "Name cannot be more than 20 characters"
                   },
                   email: {
                       required: "Email is required",
                       email: "Email must be a valid email address",
                       maxlength: "Email cannot be more than 50 characters",
                   },
                   password: {
                       required: "Password is required",
                       minlength: "Password must be at least 5 characters"
                   },
                   confirmPassword: {
                       required:  "Confirm password is required",
                       equalTo: "Password and confirm password should same"
                   }
               }
           });
       });
