<?php
include 'classes/Gallery.php';
session_start();
$gallery = new Gallery();
$message = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $category = $_POST['category'];
    $result = $gallery->uploadImage($_FILES['image'], $category);
    if($result == true){
        $message = 'File uploaded successfully';
    }else{
        $message = 'There is some error in uploading file';
    }
}

if (isset($_GET['delete'])) {
    $imageId = (int)$_GET['delete'];
    $deleteMessage = $gallery->deleteImage($imageId);
    if($deleteMessage == true){
        $message = 'File deleted successfully';
    }else{
        $deleteMessage = 'There is some error in deleting file';
    }
}

$limit = 6; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$category = isset($_GET['category']) ? $_GET['category'] : 'all';

$images = $gallery->getImages($category, $limit, $offset);
$totalImages = $gallery->getTotalImages($category);
$totalPages = ceil($totalImages / $limit);

$categories = $gallery->getCategories();
?>

<?php

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>
<?php
    include_once('includes/header.php')
?>

        <!-- Hero Start -->
        <div class="container-fluid hero-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="hero-header-inner animated zoomIn">
                            <h1 class="display-1 text-dark">Upload</h1>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item text-dark" aria-current="page">Upload</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->


        <!-- Contact Start -->
        <form method="post" enctype="multipart/form-data">
            <div class="container-fluid contact py-5">
                <div class="container py-5 login-container">
                    <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                        <h1 class="display-3">Upload</h1>
                        <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
                    </div>
                    <div class="row g-4 wow fadeIn" data-wow-delay="0.3s">
                        <div class="col-sm-12">
                            <input class="form-control bg-transparent p-3" placeholder="Select image" type="file" name="image" id="image"  required  accept="image/*">
                        </div>
                        <div class="col-12">
                            <select class="form-select form-control bg-transparent p-3" aria-label="Default select example" name="category" id="category" required placeholder="Select category">
                                <option value="" selected disabled>Select category</option>    
                                <?php foreach($categories as $row){ ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary border-0 py-3 px-5" type="submit">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Contact Start -->
         
        <div class="row">
            

                <div class="container">
                    <div class="col-md-12">
                        <table class="table image-listing-table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 1;
                                foreach ($images as $image): ?>
                                        <tr>
                                        <th scope="row"><?=$i++;?></th>
                                        <td><?php echo $image['category']; ?></td>
                                        <td><img src="uploads/<?php echo $image['image_name']; ?>" class='table-image' alt="<?php echo $image['category']; ?>"></td>
                                        <td><a href="?delete=<?php echo $image['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this image?');">Delete</a></td>
                                        </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
            </div>
                <!-- <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="uploads/<?php echo $image['image_name']; ?>" class="card-img-top" alt="<?php echo $image['category']; ?>">
                        <div class="card-body text-center">
                            <a href="?delete=<?php echo $image['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this image?');">Delete</a>
                        </div>
                    </div>
                </div> -->
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&category=<?php echo $category; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
<?php
    include_once('includes/footer.php')
?>