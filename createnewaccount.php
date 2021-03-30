<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Workout Wizard</title>

        <!-- Bootstrap core CSS -->
        <link href="WorkoutWizard/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="WorkoutWizard/css/modern-business.css" rel="stylesheet">
        <style>
            #home{
                /*background-color: black;*/
                margin-top: 50px;
                text-align: center;
            }

            .labelColor{
                /*color: white;*/
            }

            .error{
                color: red;
                text-transform: capitalize;
            }

        </style>
    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top navbar-custom">
            <div class="container">
                <a class="navbar-brand" id="title" href="index.php">WORKOUT WIZARD</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="createnewaccount.php">Create Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.html">LOGIN</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <header>
            <div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="container">

            <!--login goes here-->
            <div class='jumbotron' id="home">
                <h4 class="display-4" id="title">Create Account</h4>
                <hr class="my-4">
                <div class="col-md-10 mx-auto">
                    <!--in form tag, action = URL of php file-->
                    <form name="myForm" action="createaccountresults.php" method="post" role="form">
                        <div class='form-group row justify-content-center'>
                            <div class='col-sm-6'>
                                <label class="labelColor" id="firstLabel">First Name:</label>
                                <input type='text' class='form-control' id='firstName' name="firstName"  >
                                <small id="firstNameError" class="error"></small>
                            </div>


                            <div class='col-sm-6'>
                                <label class="labelColor" id="lastLabel"> Last Name:</label>
                                <input type='text' class='form-control' id='lastName' name="lastName" >
                                <small id="lastNameError" class="error"></small>
                            </div>
                        </div>
                        <div class='form-group row justify-content-center'>
                            <div class='col-sm-6'>
                                <label class="labelColor">Password:</label>
                                <input type='password' class='form-control' id='password' name="password" >
                                <small id="passwordError" class="error"></small>
                            </div>
                            <div class='col-sm-6'>
                                <label class="labelColor">Confirm Password:</label>
                                <input type='password' class='form-control' id='password2' name="password2" >
                                <small id="password2Error" class="error"></small>

                            </div>

                            <div class='col-sm-6'>
                                <label class="labelColor">Username:</label>
                                <input type='text' class='form-control' id='userName' name="userName" >
                                <small id="userNameError" class="error"></small>
                            </div>
                            <div class='col-sm-6'>
                                <label class="labelColor">eMail Address:</label>
                                <input type='text' class='form-control' id='email' name="email" >
                                <small id="emailError" class="error"></small>
                            </div>
                        </div>
                        <div class='form-group row justify-content-center'>
                            <div class='col-sm-3'>
                                <label class="labelColor">Height (feet):</label>
                                <input type='text' class='form-control' id='heightFeet' name="heightFeet">
                                <small id="heightFeetError" class="error"></small>
                            </div>
                            <div class='col-sm-3'>
                                <label class="labelColor">Height (inches):</label>
                                <input type='text' class='form-control' id='heightInches' name="heightInches" >
                                <small id="heightInchesError" class="error"></small>
                            </div>
                            <div class='col-sm-3'>
                                <label class="labelColor">Weight:</label>
                                <input type='text' class='form-control' id='weight' name="weight" >
                                <small id="weightError" class="error"></small>
                            </div>
                            <div class='col-sm-3'>
                                <label class="labelColor">Date of Birth:</label>
                                <input type='date' class='form-control' id='DOB' name="DOB" >
                                <small id="DOBError" class="error"></small>
                            </div>

                        </div>
                        <div class='form-group row justify-content-center'>
                            <div class='col-lg-6'>
                                <input type="submit" value="Create Account" name='action' class = "btn btn-primary px-3" onclick="return(validate())">
                                <!--onclick="return(validate())-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
        <!-- /.container -->

        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
            </div>
            <!-- /.container -->
        </footer>

        <!-- Bootstrap core JavaScript -->
        <script src="WorkoutWizard/vendor/jquery/jquery.min.js"></script>
        <script src="WorkoutWizard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script>
            //function to hold validation functions 
            function validate()
            {
                validateFirstName();

                if (validateFirstName() === true)
                {
                    validateLastName();
                } else
                {
                    return false;
                }

                if (validateLastName() === true)
                {
                    validatePassword();
                } else
                {
                    return false;
                }
                
                if(validatePassword() === true)
                {
                    matchPasswords();
                } else
                {
                    return false;
                }
                
                if(matchPasswords() === true)
                {
                    validateUserName();
                } else
                {
                    return false;
                }
                
                if(validateUserName() === true)
                {
                    validateEmail();
                }else
                {
                    return false;
                }
                
                if(validateEmail() === true)
                {
                    validateHeightFeet();
                }else
                {
                    return false;
                }
                
                if(validateHeightFeet() === true)
                {
                    validateHeightInches();
                }else
                {
                    return false;
                }
                
                if(validateHeightInches() === true)
                {
                    validateWeight();
                }else
                {
                    return false;
                }
                
                if(validateWeight() === true)
                {
                    validateBirthday();
                }
                else
                {
                    return false;
                }
                
                if(ValidateBirthday() === true)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }

            function validateFirstName()
            {

                if (document.myForm.firstName.value == "")
                {
                    document.myForm.firstName.focus();
                    document.getElementById("firstNameError").innerHTML = "Please enter First Name.";
                    return false;

                }
                //regular expression to validate value contains letters only
                if (!/^[A-Za-z]+$/.test(document.myForm.firstName.value))
                {
                    document.myForm.firstName.focus();
                    document.getElementById("firstNameError").innerHTML = "Please enter only letters in First Name.";
                    return false;
                }
                //removes the innerHTML error once the field has been populated and validated
                if (document.myForm.firstName.value != "")
                {
                    document.getElementById("firstNameError").innerHTML = "";

                }
                return true;
            }

            function validateLastName()
            {
                console.log("we are validating");
                console.log("document.myForm.lastName.value");
                

                if (document.myForm.lastName.value == "")
                {
                    document.myForm.lastName.focus();
                    document.getElementById("lastNameError").innerHTML = "Please enter Last Name.";
                    return false;
                    //regular expression to validate value contains letters only
                } else if (!/^[A-Za-z]+$/.test(document.myForm.lastName.value))
                {
                    document.myForm.lastName.focus();
                    document.getElementById("lastNameError").innerHTML = "Please enter only letters in Last Name."
                    return false;
                    //removes the innerHTML error once the field has been populated and validated    
                } else if (document.myForm.firstName.value != "")
                {
                    document.getElementById("lastNameError").innerHTML = ""
                }
                return true;
            }


            function validateUserName()
            {
                console.log("we are validating");
                console.log("document.myForm.userName.value");

                if (document.myForm.userName.value == "")
                {
                    document.myForm.userName.focus();
                    document.getElementById("userNameError").innerHTML = "User Name is required."
                    return false;
                    //removes the innerHTML error once the field has been populated and validated
                } 
                else if (document.myForm.userName.value != "")
                {
                    document.getElementById("userNameError").innerHTML = "";
                }
                return true;
            }
            function validateEmail()
            {
                var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

                if (document.myForm.email.value == "")
                {
                    document.myForm.email.focus();
                    document.getElementById("emailError").innerHTML = "Email address is required."
                    return false;
                    //removes the innerHTML error once the field has been populated and validated
                }
                else if(!mailformat.test(document.myForm.email.value))
                {
                    document.myForm.email.focus();
                    document.getElementById("emailError").innerHTML = "Email must include a period and @ symbol";
                    return false;
                    
                }else if (document.myForm.email.value != "")
                {
                    document.getElementById("emailError").innerHTML = "";
                }
                return true;
            }
            function validatePassword()
            {
                console.log("we are validating");
                console.log("document.myForm.password.value");

                if (document.myForm.password.value == "")
                {
                    document.myForm.password.focus();
                    document.getElementById("passwordError").innerHTML = "Password is required."
                    return false;
                    //removes the innerHTML error once the field has been populated and validated
                } else if (document.myForm.password.value != "")
                {
                    document.getElementById("passwordError").innerHTML = "";
                }
                return true;
            }
            
            function matchPasswords()
            {
                if(document.myForm.password.value != document.myForm.password2.value)
                {
                    document.getElementById("password2Error").innerHTML = "Passwords do not match";
                    return false;
                }
                else if(document.myForm.password2.value != "")
                {
                    document.getElementById("password2Error").innerHTML = "";
                }
                return true;
            }
            
            function validateHeightFeet()
            {
                var numOnly = /^[0-9]*$/;
                
                if(document.myForm.heightFeet.value == "")
                {
                    document.myForm.heightFeet.focus();
                    document.getElementById("heightFeetError").innerHTML = "Height(ft) is required";
                    return false;
                }
                else if(document.myForm.heightFeet.value > 9)
                {
                    document.myForm.heightFeet.focus();
                    document.getElementById("heightFeetError").innerHTML = "Height(ft) mus be less than 9";
                    return false;
                }
                else if(!numOnly.test(document.myForm.heightFeet.value))
                {
                    document.myForm.heightFeet.focus();
                    document.getElementById("heightFeetError").innerHTML = "Enter a numeric value only";
                    return false;
                }
                else if(document.myForm.password2.value != "")
                {
                    document.getElementById("heightFeetError").innerHTML = "";
                }
                return true;
            }
            function validateHeightInches()
            {
                
                var numOnly = /^[0-9]*$/;
                
                if(document.myForm.heightInches.value == "")
                {
                    document.myForm.heightInches.focus();
                    document.getElementById("heightInchesError").innerHTML = "Height(in) is required";
                    return false;
                }
                else if(document.myForm.heightInches.value > 12)
                {
                    document.myForm.heightInches.focus();
                    document.getElementById("heightInchesError").innerHTML = "Height(in) must be less than 12";
                    return false;
                }
                else if(!numOnly.test(document.myForm.heightInches.value))
                {
                    document.myForm.heightInches.focus();
                    document.getElementById("heightInchesError").innerHTML = "Enter a numeric value only";
                    return false;
                }
                
                else if(document.myForm.password2.value != "")
                {
                    document.getElementById("heightInchesError").innerHTML = "";
                }
                return true;
            }
            
            function validateWeight()
            {
                var numOnly = /^[0-9]*$/;
                
                if(document.myForm.weight.value == "")
                {
                    document.myForm.weight.focus();
                    document.getElementById("weightError").innerHTML = "Weight is required";
                    return false;
                }
                else if(!numOnly.test(document.myForm.weight.value))
                {
                    document.myForm.weight.focus();
                    document.getElementById("weightError").innerHTML = "Enter a numeric value only";
                    return false;
                }
                else if(document.myForm.weight.value != "")
                {
                    document.getElementById("weightsError").innerHTML = "";
                }
                return true;
            }

            function validateBirthday()
            {

                if (document.myForm.DOB.value == "")
                {
                    document.myForm.birthday.focus();
                    document.getElementById("DOBError").innerHTML = "Please enter a Birthday";
                    return false;
                    //removes the innerHTML error once the field has been populated and validated
                } else if (document.myForm.DOB.value != "")
                {
                    document.getElementById("DOBError").innerHTML = "";
                }
                return true;
            }
        </script>
    </body>

</html>
