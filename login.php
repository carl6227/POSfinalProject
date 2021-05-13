
<?php
session_start();
$_SESSION['username']="";
$_SESSION['errorMsg']="";
$_SESSION['isAdded']=false;

    include_once('restruant.php');
    include_once('header.php');
?>

<?php
    $myRestruant->login();
?>
<style>
body {
    display: table-cell;
    vertical-align: middle;
}

html {
    display: table;
    margin: auto;
}

html,
body {
    height: 100%;
}

.medium-small {
    font-size: 0.9rem;
    margin: 0;
    padding: 0;
}

.login-form {
    width: 280px;
}

.login-form-text {
    text-transform: uppercase;
    letter-spacing: 2px;
    font-size: 0.8rem;
}

.login-text {
    margin-top: -6px;
    margin-left: -6px !important;
}

.margin {
    margin: 0 !important;
}

.pointer-events {
    pointer-events: auto !important;
}

.input-field>.material-icons {
    padding-top: 10px;
}

.input-field div.error {
    position: relative;
    top: -1rem;
    left: 3rem;
    font-size: 0.8rem;
    color: #FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
}
</style>

<body>
    <div id="login" class="row">
        <div class="col s12 z-depth-4 card-panel">
            <form  class="login-form" method="post">
                <div class="row">
                    <div class="input-field col s12 center">
                        <!-- <img src="images/login-logo.png" alt="" class="circle responsive-img valign profile-image-login"/> -->
                        <p class="center login-form-text">LOGIN</p>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <!-- <i class="mdi-social-person-outline prefix"></i> -->
                        <i class="material-icons prefix">account_circle</i>
                        <input id="username" name="email" type="text"
                            style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGP6zwAAAgcBApocMXEAAAAASUVORK5CYII=&quot;); cursor: auto;" />
                        <label for="username" data-error="wrong" class="center-align"
                            data-success="right">Email</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <!-- <i class="mdi-action-lock-outline prefix"></i> -->
                        <i class="material-icons prefix">vpn_key</i>
                        <input id="password" name="password" type="password"
                            style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGP6zwAAAgcBApocMXEAAAAASUVORK5CYII=&quot;);" />
                        <label for="password">Password</label>
                    </div>
                </div>

            
                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" name="login" class="btn waves-effect waves-light col s12">Login</button>
                    </div>

                </div>

                <div class="row">
                    <div class="input-field col s6 m6 l6">
                        <p class="margin medium-small"><a href="page-register.html">Register Now!</a></p>
                    </div>
                    <div class="input-field col s6 m6 l6">
                        <p class="margin right-align medium-small"><a href="page-forgot-password.html">Forgot password
                                ?</a></p>
                    </div>
                </div>
            </form>
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