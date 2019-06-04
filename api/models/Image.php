<?php

class Image {
    private $conn;

    public $img_name;
    public $img_save_name;
    public $img_size;
    public $img_type;
    public $img_path;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function get_images() {
        $query = 'SELECT * FROM images';

        $stmt = $this->conn->execute($query);

        return $stmt;
    }

    public function get_image_details($data) {

        $this->img_name = $data['name'];
        $this->img_size = $data['size'];
        $this->img_type = $data['type'];
        $this->img_path = $data['local_path'];

        echo 'Image name is : ' . $this->img_name . '<br>';
        echo 'Image path is : ' . $this->img_path . '<br>';
    }

    public function save_images($data) {
        
        // initialize empty var to store values to be inserted in DB
        $params = [];
        
        // loop through data array
        foreach ($data as $value) {
            $this->img_name = $value['name'];
            $this->img_save_name = $value['save_name'];
            $this->img_size = $value['size'];
            $this->img_type = $value['type'];
            $this->img_path = $value['local_path'];

            // build associative array to store image attributes
            $img_array = [
                'name' => $this->img_name,
                'save_name' => $this->img_save_name,
                'size' => $this->img_size,
                'type' => $this->img_type,
                'local_path' => $this->img_path
            ];

            // push image array to params array
            array_push($params, $img_array);
        }

        // build query
        $query = 'INSERT INTO images (name, save_name, size,type, local_path) VALUES (:name, :save_name, :size, :type, :local_path);';

        // prepare query
        $stmt = $this->conn->prepare($query);

        // for each image execute query
        foreach ($params as $value) {
            $stmt->execute($value);
        }

        if ($stmt->rowCount() > 0) {
            $stmt = null;
            $this->conn = null;
            return true;
        } else {
            $stmt = null;
            $this->conn = null;
            return false;
        }

    }
}