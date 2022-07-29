<?php
require('config.php');
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if(!empty($_POST)) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if($username == '' || $email=='' || $password ==''){
    echo "<script>alert('try agin')</script>";
  }else {
    $pdo_stement = $pdo->prepare("SELECT COUNT(email) AS num FROM users WHERE email=:email");
    $pdo_stement->bindValue(':email',$email);
    $pdo_stement->execute();
    $row = $pdo_stement->fetch(PDO::FETCH_ASSOC);
    if($row['num'] > 0) {
      echo "<script>alert('This email has alrady exit,please try again?')</script>";
    }else {
      $passwordHash = password_hash($password,PASSWORD_BCRYPT);
      $pdo_stement = $pdo->prepare("INSERT INTO users (username,email,password) VALUES (:username,:email,:password)");
      $pdo_stement->bindValue(':username',$username);
      $pdo_stement->bindValue(':email',$email);
      $pdo_stement->bindValue(':password',$passwordHash);

      $result = $pdo_stement->execute();
      $_SESSION['user_id'] = 1;
    }
  }
  
}

?>
<?php require_once('layout/content_header.php')?>
</head>
<body>
    <!-- header -->
    <?php require_once('layout/header.php')?>
    <!-- header -->
    
   <div class="container">
    <h1 class="text-center my-3 text-primary">Register</h1>
    <?php if(@$result): ?> 
      <div class="alert col-md-6 mx-auto alert-success">
        <strong>Success! </strong> Thank for your registration. Please Login in to continue !!.
        <a href="login.php">login</a>
      </div>
    <?php endif; ?>
  
    <div class="card" id="singup_card">
      <div class="card-body">
      <form class="mx-1 mx-md-4" action="" method="post">

        <div class="d-flex flex-row align-items-center mb-4">
          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
          <div class="form-outline flex-fill mb-0">
            <input type="text" id="form3Example1c" name="username" class="form-control" required />
            <label class="form-label" for="form3Example1c">Your Name</label>
          </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
          <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
          <div class="form-outline flex-fill mb-0">
            <input type="email" id="form3Example3c" name="email" class="form-control" required />
            <label class="form-label" for="form3Example3c">Your Email</label>
          </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
          <div class="form-outline flex-fill mb-0">
            <input type="password" id="form3Example4c" name="password" class="form-control" required/>
            <label class="form-label" for="form3Example4c">Password</label>
          </div>
        </div>

        <div class="form-check d-flex justify-content-center mb-5">
          <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
          <label class="form-check-label" for="form2Example3">
            I agree all statements in <a href="#!">Terms of service</a>
          </label>
        </div>

        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
          <button type="submit" class="btn btn-primary btn-lg">Register</button>
        </div>

    </form>

      </div>
    </div>
   </div>



    <!-- footer -->
        <?php require_once('layout/content_footer.php')?>
    <!-- /footer -->
</body>
</html>