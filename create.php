<?php
require('config.php');

if(!empty($_POST)) {
  $title = $_POST['title'];
  $targetFile = $_FILES['image']['name'];
  $description = $_POST['description'];

  $fileType = pathinfo($targetFile,PATHINFO_EXTENSION);
  
  if($fileType != 'png' && $fileType != 'jpg' && $fileType != 'jpeg') {
    echo "<script>alert('Image file type must be png or jpg or jpeg');</script>";
  }else {
    $move = move_uploaded_file($_FILES['image']['tmp_name'],'images/'.$targetFile);
    $stmt = $pdo->prepare("INSERT INTO posts (title,image,description) VALUES (:title,:image,:description)");

    $stmt->bindValue(':title',$title);
    $stmt->bindValue(':image',$targetFile);
    $stmt->bindValue(':description',$description);

    $result = $stmt->execute();
    if($result) {
        echo "<script>alert('Your post is success');window.location.href='index.php'</script>";
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
    <h1 class="text-center my-3 text-primary">Create Post</h1>
  
    <div class="card" id="singup_card">
      <div class="card-body">
      <form class="mx-1 mx-md-4" action="" method="post" enctype="multipart/form-data">

        <div class="d-flex flex-row align-items-center mb-4">
          <i class="fas fa-pencil fa-lg me-3 fa-fw"></i>
          <div class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Post Title</label>
            <input type="text" id="form3Example1c" name="title" class="form-control" />
          </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
          <i class="fas fa-file fa-lg me-3 fa-fw"></i>
          <div class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Post Image</label>
            <input type="file" id="form3Example1c" name="image" class="form-control" />
          </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
          <i class="fas fa-comments fa-lg me-3 fa-fw"></i>
          <div class="form-outline flex-fill mb-0">
            <textarea name="description" id="" cols="65" rows="10"></textarea>
          </div>
        </div>

        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
          <button type="submit" class="btn btn-primary btn-lg">Post</button>
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