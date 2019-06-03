<?php
ini_set('errors_display', 1);
error_reporting(E_ALL);

// import Database object
require_once '../config/Database.php';

// import Image object
require_once '../models/Image.php';

// instantiate new Database object && connect to db
$db = new Database();
$conn = $db->connect();

// Instantiate new Image object
$image = new Image($conn);

// set destination folder for uploads
$target_dir = 'uploads/';

// set authorized file extensions
$extensions = [
    'jpg',
    'jpeg',
    'png',
    'gif'
];

// check if files sent
if (isset($_FILES) && !empty($_FILES['image'])) {

    // count files uploaded
    $file_count = count($_FILES['image']['name']);

    // create empty arrays to store files details and errors
    $images = [];
    $errors = [];

    for ($i=0; $i < $file_count; $i++) {

        // get file extension
        // ref strtolower() : https://www.php.net/manual/en/function.strtolower.php
        // ref pathinfo() : https://www.php.net/manual/en/function.pathinfo.php
        $file_ext = strtolower(pathinfo($_FILES['image']['name'][$i],PATHINFO_EXTENSION));

        // if extension matches authorized extensions
        if (in_array($file_ext, $extensions)) {

            // generate unique name for image
            $save_name = time() . uniqid(rand()) . '.' . $file_ext;

            // create array for each single file
            $image_array = [
                'name' => $_FILES['image']['name'][$i],
                'save_name' => $save_name,
                'size' => $_FILES['image']['size'][$i],
                'type' => $file_ext,
                'tmp_name' => $_FILES['image']['tmp_name'][$i],
                'local_path' => $target_dir . $save_name
            ];
    
            // push single file array to images array
            array_push($images, $image_array);
        } else {
            // if file submitted does not match athorized extensions
            array_push($errors, $_FILES['image']['name'][$i]);
        }
    }

    // for each file in images save to uploads/ directory
    foreach ($images as $value) {
        move_uploaded_file($value['tmp_name'], '../../' . $target_dir . $value['save_name']);
    }

    // call save_images() and store response
    $response = $image->save_images($images);

    // check if response
    if($response) {
        echo json_encode([
            "success" => true,
            "data" => $images,
            "message" => (count($errors) > 0) ? count($errors) . ' image(s) could not be inserted in database' : 'Images successfully inserted in database',
            "errors" => (count($errors) > 0) ? $errors : null
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Image(s) could not be inserted in database",
            "FILES" => $_FILES
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "No files submitted",
    ]);
}

    // get file infos
    // $img_name = $_FILES['image']['name'];
    // $img_path = $_FILES['image']['tmp_name'];
    // $$img_size = $_FILES['image']['size'];
    // $img_type = $_FILES['image']['type'];
    // $img_ext = preg_match('#.*\.[jpg|jpeg|png|gif]#', $img_name);
    // $img_ext = explode('.', $img_name);
    // print_r($img_ext);

    // echo 'File ' . $img_name . ' successfully uploaded';
