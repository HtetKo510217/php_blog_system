<?php
require('config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!empty($_POST)) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
  $stmt->bindValue(':email',$email);
  $stmt->execute();
  $realUser = $stmt->fetch(PDO::FETCH_ASSOC);

  if(empty($realUser)) {
    echo "<script>alert('Incorrect credentials, Try again !!')</script>";
    }else {
        $validPassword = password_verify($password,$realUser['password']);
        if($validPassword) {
            $_SESSION['user_id'] = $realUser['id'];
            $_SESSION['logged_in'] = time();
            header('location:index.php');
            exit();
        }else {
            echo "<script>alert('Incorrect credentials, Try again !!')</script>";
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
    <h1 class="text-center my-3 text-primary">Login</h1>
  
    <div class="card" id="singup_card">
      <div class="card-body">
      <form class="mx-1 mx-md-4" action="" method="post">

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
        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
          <button type="submit" class="btn btn-primary btn-lg">Login</button>
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