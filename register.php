<?php

      //connection to database
      require_once 'connection/dbconnect.php';

      $errors = ['fullname' => '', 'serial' => '', 'pin' => ''];

      $fullname = '';
      $serial = '';
      $pin = '';

      //Registration Logic
      if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //form validation

        //check for fullname
        if(empty($_POST['fullname'])){
          $errors['fullname'] = 'Fullname is required';
        }
        else{
          $fullname =  htmlspecialchars($_POST['fullname']);
        }

        //check for serial
        if(empty($_POST['serial'])){
          $errors['serial'] = 'Login ID / Serial # is required';
        }
        else{
          $serial = htmlspecialchars($_POST['serial']);
        }
        
        //check for pin
        if(empty($_POST['pin'])){
          $errors['pin'] = 'Pin is required';
        }
        else{
          $pin = htmlspecialchars($_POST['pin']);
        }
        

        //if form is passed
        if(!array_filter($errors)){

          //check if serial number exits
          $sql = 'SELECT * FROM usersform WHERE serial=:serial LIMIT 1';
          $statement = $conn->prepare($sql);
          $statement->execute(['serial' => $serial]);

          if($statement->rowCount()){
            $errors['serial'] = 'Login ID / Serial already exits';
          }
          else{

            $pin = md5($pin);

            //Insert into the database
            $sql = 'INSERT INTO usersform(fullname, serial, pin) VALUES(:fullname, :serial, :pin)';
            $statement = $conn->prepare($sql);
            $statement->execute([
              'fullname' => $fullname,
              'serial' => $serial,
              'pin' => $pin
            ]);

            $lastId = $conn->lastInsertId();

            //Select the newly registered user and store in the database
            $sql = 'SELECT * FROM usersform WHERE id=:id';
            $statement = $conn->prepare($sql);
            $run = $statement->execute(['id' => $lastId]);
            $usersform = $statement->fetch();
            
            if($run){

              $_SESSION['usersform'] = $usersform;
              header('Location: dashboard/index.php');

            }

          }
          

        }

      }

      if(isset($_SESSION['usersform'])){
        header('Location: dashboard/index.php');
      }

?>


<!doctype html>
<html lang="en">
  <head>
    <title>STU APP | Register</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>


    <!-- Header -->
    <div class="navigation p-3">
        <div class="container d-flex justify-content-between">
            <a href="index.php"><div class="side1 d-flex">
                <img src="images/knust-logo_reference.jpg">&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="logo-icon">
                    <p class="mb-1">Kwame Nkrumah University of Science and Technology</p>
                    <h6><strong>Admissions Portal</strong></h6>
                </div>
            </div></a>
            <div class="side2">
                <ul class="tech-links">
                    <li class="small"><a href="index.php">Home</a></li>
                    <li class="small"><a href="http://knust.edu.gh/">KNUST Website</a></li>
                    <li class="small"><a href="https://www.knust.edu.gh/about/contacts">Contact Us</a></li>
                    <li class="small"><a href="register.php">Register</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Header -->

    <!-- Section -->
    <div class="section mt-3">
        <div class="container">

            <div class="section-header text-center">
                <p class="mb-1"><i class="fas fa-user"></i> Applicant Register</p>
                <p class="small">Login with your credentials below</p>
            </div>

            <form action="register.php" method="POST">
                <div class="mb-5">
                    <input type="text" class="form-control" name="fullname" placeholder="Fullname" value="<?php echo $fullname ?>">
                    <div class="text-danger">
                      <?php echo $errors['fullname']; ?>
                    </div>
                  </div>
                <div class="mb-5">
                  <input type="text" class="form-control" name="serial" placeholder="Login ID / Serial #" value="<?php echo $serial ?>">
                  <div class="text-danger">
                      <?php echo $errors['serial']; ?>
                  </div>
                </div>
                <div class="mb-4">
                  <input type="password" class="form-control" name="pin" id="exampleInputPassword1" placeholder="Pin" value="<?php echo $pin ?>">
                  <div class="text-danger">
                      <?php echo $errors['pin']; ?>
                  </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Register</button>
            </form>

            <div class="section-footer text-center mt-3">
              <p>Lost your Pin?</p>
            </div>

            <hr>
            <p class="text-center mt-2">Do you have urgent questions to ask? Contact us through the<br> following:</p>

            <div class="distance-learning-contact text-center">
              <p class="small fw-bold">Institute of Distance Learning:</p>
              <div class="distance-contact">
                <p class="mb-2"><i class="fas fa-phone-alt"></i> +233 54 020 6262</p>
                <p class="mb-2"><i class="fas fa-phone-alt"></i> +233 50 048 2885</p>
                <p><i class="fas fa-phone-alt"></i> +233 24 727 4661</p>
              </div>
              <p class="mt-4 small">Recommended Browsers: Mozilla FireFox and Google Chrome</p>
            </div>

            <div class="footer-end">
              <div class="row g-4">
                
                <div class="col-md-3">
                  <p class="mb-1">Undergraduate-Ghanaian</p>
                  <ul>
                    <li class="small"><a href="#">General Information for Applicants</a></li>
                    <li class="small"><a href="#">Undergraduate Programmes</a></li>
                    <li class="small"><a href="#">Cut Off Points</a></li>
                  </ul>
                </div>
                
                <div class="col-md-3">
                  <p class="mb-1">Postgraduate-Ghanaian</p>
                  <ul>
                    <li class="small"><a href="#">General Information for Applicants</a></li>
                    <li class="small"><a href="#">Information for Masters Programmes</a></li>
                    <li class="small"><a href="#">Information for PhD Programmes</a></li>
                    <li class="small"><a href="#">Postgraduate Programmes</a></li>
                  </ul>
                </div>
                
                <div class="col-md-3">
                  <p class="mb-1">Distance Learning</p>
                  <ul>
                    <li class="small"><a href="#">General Information for Applicants</a></li>
                  </ul>
                </div>
                
                <div class="col-md-3">
                  <p class="mb-1">International Applicants</p>
                  <ul>
                    <li class="small"><a href="#">General Information for Applicants</a></li>
                    <li class="small"><a href="#">Undergraduate Programmes</a></li>
                    <li class="small"><a href="#">Postgraduate Programmes</a></li>
                    <li class="small"><a href="#">Accommodation for Applicants</a></li>
                  </ul>
                </div>
              
              </div>
            </div>

            <p class="text-center small mt-5 mb-0">&copy 2015 Kwame Nkrumah University of Science & Technology.</p>
    
        </div>
    </div>
    <!-- End Section -->
    

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  </body>
</html>