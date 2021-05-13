<?php
session_start();
$_SESSION['username']="";
$_SESSION['errorMsg']="";

    include_once('restruant.php');
    include_once('header.php');
?>

<?php
    $myRestruant->login();
?>
<style>

* {
    box-sizing: border-box;
}

*:focus {
    outline: none;
}

body {
    font-family: Arial;
    padding: 50px;
}

.login {
    margin: 20px auto;
    width: 300px;
}

.login-screen {
    background-color: #FFF;
    padding: 20px;
    border-radius: 5px
}

.app-title {
    text-align: center;
    color: #777;
}

.login-form {
    text-align: center;
}

form {
    border-radius: 20px;
    padding: 1.3rem;
    width: 500px;
    margin: 2rem auto;


}

.control-group {
    margin-bottom: 10px;
}

input {
    text-align: center;
    background-color: #ECF0F1;
    border: 2px solid transparent;
    border-radius: 3px;
    font-size: 16px;
    font-weight: 200;
    padding: 10px 0;
    width: 250px;
    transition: border .5s;
}

input:focus {
    border: 2px solid #3498DB;
    box-shadow: none;
}

.btn {
    border: 2px solid transparent;
    background: #3498DB;
    color: #ffffff;
    font-size: 16px;
    line-height: 25px;
    padding: 10px 0;
    text-decoration: none;
    text-shadow: none;
    border-radius: 10px;
    box-shadow: none;
    transition: 0.25s;
    display: block;
    width: 200px;
    margin: 0 auto;
}

.btn:hover {
    background-color: #2980B9;
}

.login-link {
    font-size: 12px;
    color: #444;
    display: block;
    margin-top: 12px;
}
</style>

<body>

    <div class="container mt-5 mb-5" style=" box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
        <div class="row">
            <div class="col-sm">
                <img src="https://img.freepik.com/free-vector/account-log-page_41910-263.jpg?size=626&ext=jpg" alt="..."
                    class="" style="height:100%; width:100%;">
            </div>
            <div class="col-sm">
                <form method="post">
                    <h3 class="mt-3 text-center mb-3 text-dark mb-4">
                        JPG Restaurant Login Form
                    </h3>
                    <small
                        class="text-danger"><?php echo isset($_SESSION['errorMsg'])?$_SESSION['errorMsg']:"";?></small>
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light text-dark  px-4 border-md border-right-0">
                                <i class="fa fa-envelope text-primary" style=" font-size:25px;padding:10px;"></i>
                            </span>
                        </div>
                        <input id="name" type="text" name="email" placeholder="Email Address"
                            class="form-control bg-light text-dark border-left-0 border-md text-left"
                            style="padding:10px;" required>
                    </div>

                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light text-dark  px-4 border-md border-right-0">
                                <i class="fa fa-key text-primary" style=" font-size:25px;padding:10px;"></i>
                            </span>
                        </div>
                        <input id="name" type="password" name="password" placeholder="Password"
                            class="form-control bg-light text-dark border-left-0 border-md text-left"
                            style="padding:10px" required>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary mb-2" name="login" value="Save Data">
                            <h4><i class="fa fa-sign-in" aria-hidden="true">
                                </i> Login</h4>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
    <script>
    $(".login-form").validate({
        rules: {
            username: {
                required: true,
                minlength: 4
            },
            password: {
                required: true,
                minlength: 5
            }
        },
        //For custom messages
        messages: {
            username: {
                required: "Enter a username",
                minlength: "Enter at least 4 characters"
            }
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    </script>
</body>