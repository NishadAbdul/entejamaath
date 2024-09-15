<?php
include 'classes/Gallery.php';
session_start();
$gallery = new Gallery();

$images = $gallery->getAllImages();

$categories = $gallery->getCategories();
?>
<?php
    include_once('includes/header.php')
?>


        <!-- Hero Start -->
        <div class="sub-header">
            <h1>Our Gallery</h1>
        </div>
        <!-- Hero End -->

        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-3.2.1.min.js"></script>
        <link rel="stylesheet" href="css/magnific-popup.css" />
        <script src="js/isotope.pkgd.js"></script>
        <script src="js/jquery.magnific-popup.js"></script>
        <div class="container">
        
         <div class="portfolio-menu mt-2 mb-4">
            <ul>
               <li class="btn btn-outline-dark active" data-filter="*">All</li>

               <?php foreach($categories as $row){ ?>
                    <li class="btn btn-outline-dark" data-filter=".<?php echo $row['category_name']; ?>"><?php echo $row['category_name']; ?></li>
                <?php } ?>
            </ul>
         </div>
         <div class="portfolio-item row">

         <?php foreach ($images as $image): ?>
                
            <div class="item <?php echo $image['category']; ?> col-lg-3 col-md-4 col-6 col-sm">
               <a href="uploads/<?php echo $image['image_name']; ?>" class="fancylight popup-btn" data-fancybox-group="light"> 
               <img class="img-fluid" src="uploads/<?php echo $image['image_name']; ?>" alt="">
               </a>
            </div>
            <?php endforeach; ?>
         </div>
      </div>
<?php
include_once('includes/footer-gallery.php');
?>