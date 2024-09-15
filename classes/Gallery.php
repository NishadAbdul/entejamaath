<?php
include 'Database.php';

class Gallery {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function uploadImage($file, $category) {
        $targetDir = "uploads/";
        $file_name = time(). basename($file["name"]);
        $targetFile = $targetDir . $file_name;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($file["tmp_name"]);
        if ($check !== false && move_uploaded_file($file["tmp_name"], $targetFile)) {
            $sql = "INSERT INTO gallery (image_name, category_id) VALUES (?, ?)";
            $this->db->query($sql, [$file_name, $category], 'si');
            return true;
        } else {
            return false;
        }
    }

    public function getImages($category = 'all', $limit = 6, $offset = 0) {
        if ($category === 'all') {
            $sql = "SELECT g.id as id, category_id, image_name,c.category_name as category FROM gallery g LEFT JOIN categories c on g.category_id =  c.id ORDER BY upload_time DESC LIMIT ? OFFSET ?";
            return $this->db->fetchAll($sql, [$limit, $offset], 'ii');
        } else {
            $sql = "SELECT * FROM gallery WHERE category = ? ORDER BY upload_time DESC LIMIT ? OFFSET ?";
            return $this->db->fetchAll($sql, [$category, $limit, $offset], 'sii');
        }
    }

    public function getAllImages() {
            $sql = "SELECT g.id as id, category_id, image_name,c.category_name as category FROM gallery g LEFT JOIN categories c on g.category_id =  c.id ORDER BY upload_time DESC ";
            return $this->db->fetchAll($sql);
    }

    public function getTotalImages($category = 'all') {
        if ($category === 'all') {
            $sql = "SELECT COUNT(*) as count FROM gallery";
            $result = $this->db->fetchOne($sql);
        } else {
            $sql = "SELECT COUNT(*) as count FROM gallery WHERE category = ?";
            $result = $this->db->fetchOne($sql, [$category], 's');
        }

        return $result['count'];
    }

    public function getCategories($category = 'all', $limit = 6, $offset = 0) {
        $sql = "SELECT * FROM categories ORDER BY category_name";
        return $this->db->fetchAll($sql);
    }

    public function deleteImage($imageId) {
        $sql = "SELECT image_name FROM gallery WHERE id = ?";
        $image = $this->db->fetchOne($sql, [$imageId], 'i');

        if ($image) {
             $imagePath = 'uploads/' . $image['image_name'];

            if (file_exists($imagePath)) {
                unlink($imagePath);
            } 

            $sql = "DELETE FROM gallery WHERE id = ?";
            $this->db->query($sql, [$imageId], 'i');

            return true;
        } else {
            return false;
        }
    }
}
