<?php
require ('functions.php');
// request method post
if($_SERVER['REQUEST_METHOD'] == "POST"){
    //Sign up
    if (isset($_POST['registerSubmit']) && ($_POST['registerPassword'] == $_POST['registerRepeatPassword'])){

        $SignUp->addCustomer(
                $_POST['registerFName'],
                $_POST['registerLName'],
                $_POST['registerEmail'],
                $_POST['registerPNum'],
                $_POST['registerAdd1'],
                $_POST['registerAdd2'],
                $_POST['registerAdd3'],
                $_POST['registerPassword']
        );


    }else{
        $passwordMatchError="Passwords are not match!";
    }
    //Sign in
    if (isset($_POST['signin'])){

        $SignIn ->Login(
                $_POST['loginEmail'],
                $_POST['loginPassword']
        );
    }


}

?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
            rel="stylesheet"
    />
    <!-- MDB -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css"
            rel="stylesheet"
    />

   <!-- MDB -->
    <script
            type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"
    ></script>

    <!-- Custom CSS file -->
    <link href="sign-in.css" rel="stylesheet">

    <script>
        function validateForm() {
            var passwordInput = document.getElementById('registerPassword').value;
            var repeatPasswordInput = document.getElementById('registerRepeatPassword').value;
            var passwordWarning = document.getElementById('passwordWarning');

            if (passwordInput !== repeatPasswordInput) {
                passwordWarning.textContent = "Passwords do not match.";
                return false; // Prevent form submission
            } else {
                passwordWarning.textContent = "";
                return true; // Allow form submission
            }
        }
    </script>

</head>

<body>
<div class="main-wrap align-items-center justify-content-center d-flex ">
<div class="col-md-6  ">
<!-- Pills navs -->
<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
           aria-controls="pills-login" aria-selected="true">Login</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab"
           aria-controls="pills-register" aria-selected="false">Register</a>
    </li>
</ul>
<!-- Pills navs -->

<!-- Pills content -->
<div class="tab-content">
    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        <form method="post">
            <div class="text-center mb-3">
                <p>Sign in with:</p>
                <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-facebook-f"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-google"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-twitter"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-github"></i>
                </button>
            </div>

            <p class="text-center">or:</p>

            <!-- Email input -->
            <div class="form-group mb-4">
                <label class="form-label" for="loginName" >Email</label>
                <input type="email" name="loginEmail" id="loginName" placeholder="Enter email" class="form-control" required/>
            </div>

            <!-- Password input -->
            <div class="form-group mb-4">
                <label class="form-label" for="loginPassword">Password</label>
                <input type="password" name="loginPassword" placeholder="Password" id="loginPassword" class="form-control" required/>
            </div>

            <!-- 2 column grid layout -->
            <div class="row mb-4">
                <div class="col-md-6 d-flex justify-content-center">
                    <!-- Checkbox -->
                    <div class="form-check mb-3 mb-md-0">
                        <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                        <label class="form-check-label" for="loginCheck"> Remember me </label>
                    </div>
                </div>

                <div class="col-md-6 d-flex justify-content-center">
                    <!-- Simple link -->
                    <a href="#!">Forgot password?</a>
                </div>
            </div>

            <!-- Submit button -->
            <button type="submit" name="signin" class="btn btn-primary btn-block mb-4">Sign in</button>
            <button type="submit" name="guestsignin" onclick="window.open('index.php')" class="btn btn-primary btn-block mb-4">Sign In as Guest</button>
            <!-- Register buttons -->
            <div class="text-center">
                <p>Not a member? <a  href="#pills-register" role="tab" aria-selected="false" >Register</a></p>
            </div>
        </form>
    </div>
    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
        <form method="post" onsubmit="return validateForm();">
            <div class="text-center mb-3">
                <p>Sign up with:</p>
                <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-facebook-f"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-google"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-twitter"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-github"></i>
                </button>
            </div>

            <p class="text-center">or:</p>

            <!-- Name input -->
            <div class="form-group mb-4">
                <label class="form-label" for="registerName">First Name</label>
                <input type="text" name="registerFName" id="registerFName" class="form-control" required/>

            </div>
            <div class="form-group mb-4">
                <label class="form-label" for="registerName">Last Name</label>
                <input type="text" name="registerLName" id="registerLName" class="form-control" />

            </div>
            <!-- Email input -->
            <div class="form-group mb-4">
                <label class="form-label" for="registerEmail">Email</label>
                <input type="email" name="registerEmail" id="registerEmail" class="form-control" required/>

            </div>
            <!-- Phone Number input -->
            <div class="form-group mb-4">
                <label class="form-label" for="registerPNum">Mobile Number</label>
                <input type="text" name="registerPNum" id="registerPNum" class="form-control" required/>

            </div>
            <!-- Address Line1 -->
            <div class="form-group mb-4">
                <label class="form-label" for="registerAdd1">Address Line1</label>
                <input type="text" name="registerAdd1" id="registerAdd1" class="form-control" required/>

            </div>
            <!-- Address Line2 -->
            <div class="form-group mb-4">
                <label class="form-label" for="registerAdd2">Address Line2</label>
                <input type="text" name="registerAdd2" id="registerAdd2" class="form-control" />

            </div>
            <!-- Address Line2-->
            <div class="form-group mb-4">
                <label class="form-label" for="registerAdd3">Address Line3</label>
                <input type="text" name="registerAdd3" id="registerAdd3" class="form-control" />

            </div>

            <!-- Password input -->
            <div class="form-group mb-4">
                <label class="form-label" for="registerPassword">Password</label>
                <input type="password" name="registerPassword" id="registerPassword" class="form-control" required/>

            </div>

            <!-- Repeat Password input -->
            <div class="form-group mb-4">
                <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                <input type="password" name="registerRepeatPassword" id="registerRepeatPassword" class="form-control" required />
                <div id="passwordWarning" class="text-danger"></div>
            </div>

            <!-- Checkbox -->
            <div class="form-check d-flex justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked
                       aria-describedby="registerCheckHelpText" />
                <label class="form-check-label" for="registerCheck">
                    I have read and agree to the terms
                </label>
            </div>

            <!-- Submit button -->

            <button type="submit" name="registerSubmit" class="btn btn-primary btn-block mb-3" >Register</button>
        </form>
    </div>
</div>
<!-- Pills content -->
</div>
</div>
</body>
