<?php
require('config.php');
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if(!empty($_POST)) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $id = $_POST['id'];
  
 if($_FILES['image']['size'] !=0) {
  $targetFile = $_FILES['image']['name'];
  $fileType = pathinfo($targetFile,PATHINFO_EXTENSION);
  if($fileType !='png' && $fileType !='jpg' && $fileType !='jpeg') { 
    echo "<script>alert('Image file type must be png or jpg or jpeg')</script>";
  }else {
    $mov = move_uploaded_file($_FILES['image']['tmp_name'],'images/'.$targetFile);
    $stmt = $pdo->prepare("UPDATE posts SET title='$title',image='$targetFile',description='$description' WHERE id='$id'");

    $result = $stmt->execute();
  }
 }else {
    $stmt = $pdo->prepare("UPDATE posts SET title='$title',description='$description' WHERE id='$id'");
    $result = $stmt->execute();
 }

 if($result) {
  echo "<script>alert('record is updated');window.location.href='index.php'</script>";
 }

}


$stmt = $pdo->prepare("SELECT * FROM posts WHERE id=".$_GET['id']);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<?php require_once('layout/content_header.php')?>
</head>
<body>
    <!-- header -->
    <?php require_once('layout/header.php')?>
    <!-- header -->
    
   <div class="container">
    <h1 class="text-center my-3 text-primary">Edit Post</h1>
  
    <div class="card" id="singup_card">
      <div class="card-body">
      <form class="mx-1 mx-md-4" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $result['id']?>">
        <div class="d-flex flex-row align-items-center mb-4">
          <i class="fas fa-pencil fa-lg me-3 fa-fw"></i>
          <div class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Post Title</label>
            <input type="text" id="form3Example1c" name="title" class="form-control" value="<?= $result['title']?>"/>
          </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
          <i class="fas fa-file fa-lg me-3 fa-fw"></i>
          <div class="form-outline flex-fill mb-0">
            <img src="images/<?= $result['image']?>" style="width: 100px;"><br>
            <label class="form-label" for="form3Example1c">Old Image</label>
            <input type="file" id="form3Example1c" name="image" class="form-control" />
          </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
          <i class="fas fa-comments fa-lg me-3 fa-fw"></i>
          <div class="form-outline flex-fill mb-0">
            <textarea name="description" id="" cols="65" rows="10"><?= $result['description']?></textarea>
          </div>
        </div>

        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
          <a href="/php_blog_system/" class="btn btn-info mx-5">Back</a>
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