<?php

if (!empty($_FILES['files']['name'][0])) {

    $files = $_FILES['files'];

    $uploaded = array();
    $failed = array();

    $allowed = ['jpg' , 'png', 'gif'];


    foreach ($files['name'] as $key => $file_name) {

        $file_tmp = $files['tmp_name'][$key];
        $file_size = $files['size'][$key];
        $file_error = $files['error'][$key];

        $file_ext = pathinfo($_FILES['files']['name'][$key], PATHINFO_EXTENSION);


        if(in_array($file_ext,$allowed)) {

            if($file_error === 0 ) {

                if (($file_size <= 1000000)) {

                    $uploadDir = 'assets/img/';
                    $uploadFile = $uploadDir . uniqid('image') . '.' . $file_ext;

                    if (move_uploaded_file($file_tmp, $uploadFile)) {
                        $isSend = 'Les fichiers on bien été envoyé !';
                        header('Location: index.php');
                    } else {
                        echo 'Echec du téléchargement !';
                    }

                } else {
                    $failed[$key] = $file_name . ' is too large.';
                }
            }
        } else {
            $failed[$key] = $file_name . 'file extension' . $file_ext . 'is not allowed.';
        }
    }
}
?>

<a class="btn btn-primary" href="index.php" role="button">Back home</a>
