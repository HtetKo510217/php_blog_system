<?php
require('config.php');

$stmt = $pdo->prepare("SELECT * FROM posts ORDER BY ID DESC");
$stmt->execute();
$posts = $stmt->fetchAll();

// die(var_dump($posts));

?>
<?php require_once('layout/content_header.php')?>
</head>
<body>
    <!-- header -->
    <?php require_once('layout/header.php')?>
    <!-- header -->

   <div class="container">
    <h1 class="text-center my-3 text-primary">Blogs Post</h1>
    <?php @$del_post=$_SESSION['delete_post']; if(@$del_post): ?> 
    <div class="alert alert-success" id="success-alert">
        <strong>Success! </strong> Your post has been deleted !!.
    </div>
    <?php
    unset($_SESSION['delete_post']);
    ?>    
    <?php endif; ?>
   <div class="row d-flex justify-content-around">
    <?php 
    if($posts) {
        foreach($posts as $post) {
            ?>

            <div class="card col-md-4" style="width: 350px;">
                <img src="images/<?= $post['image']?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?= $post['title']?></h5>
                    <p class="card-text"><?= $post['description']?></p>
                    <div class="d-flex justify-content-between">
                        <a href="edit.php?id=<?= $post['id']?>" class="btn btn-info">Edit</a>
                        <a href="delete.php?id=<?= $post['id']?>" class="btn btn-danger" onclick="confirm('Are you sure you want to delete?')">Delete</a>
                    </div>
                </div>
            </div>

            <?php
        }
    }
    ?>
    </div>
   </div>



    <!-- footer -->
        <?php require_once('layout/content_footer.php')?>
    <!-- /footer -->
    <script>
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("#success-alert").slideUp(500);
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>
</html>