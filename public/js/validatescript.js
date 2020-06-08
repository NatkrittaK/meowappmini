function validateEmail(sEmail) {
  var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;

  if(!sEmail.match(reEmail)) {
    alert("Invalid email address");
    return false;
  }

  return true;

}

$().ready(function() {
    

    // validate signup form on keyup and submit
    $("#myform").validate({
        rules: {
            fname: "required",
            lname: "required",
            address: "required",
            phone: "required",

            pass: {
                required: true,
                minlength: 5
            },
            passconf: {
                required: true,
                minlength: 5,
                equalTo: "#pass"
            },
            password: {
                required: true,
                minlength: 5
            },
            confirmpassword: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            },
            
            email: {
                required: true,
                email: true
            },
            phone:{
                required: true,
                minlength: 10,
                phoneUS: true
            }

        },
        messages: {
            fname: "Please enter your first name",
            lname: "Please enter your last name",
            phone: "Please enter your phone number",
            address: "Please enter your address",
           
            pass: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            passconf: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                equalTo: "Please enter the same password as above"
            },
            email: "Please enter a valid email address",
            
        }
        
    });

});
