<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
    @$user_id = $_SESSION['user_id'];
    @$logged_in = $_SESSION['logged_in'];
    if(empty(@$user_id || @$logged_in)) {
        echo "<script>
            alert('Please login to continue');
            window.location.href='login.php';
        </script>";
        
    }
}
 
?>
<header>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/php_blog_system/">Blog</a>
    <div class="row g-0 text-center">
        <div class="col-sm-8 col-md-12">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php if(@$user_id && @$logged_in): ?> 
                <li class="nav-item">
                  <a class="nav-link btn btn-primary mx-4" href="create.php">Create Post</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link btn btn-danger" href="logout.php">Logout</a>
                </li>
            <?php else: ?> 
                <li class="nav-item  mx-3">
                <a class="nav-link btn btn-info" href="register.php">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-success" href="login.php">Login In</a>
            </li>
            <?php endif; ?> 

        </ul>
        </div>
    </div>
  </div>
</nav>
</header>

