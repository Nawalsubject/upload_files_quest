<?php
if (!empty($_FILES['files']['name'][0])) {

    $files = $_FILES['files'];

    $uploaded = array();
    $error = array();

    $allowed = ['jpg', 'png', 'gif'];


    foreach ($files['name'] as $key => $file_name) {

        $file_tmp = $files['tmp_name'][$key];
        $file_size = $files['size'][$key];
        $file_error = $files['error'][$key];

        $file_ext = pathinfo($_FILES['files']['name'][$key], PATHINFO_EXTENSION);


        if (in_array($file_ext, $allowed)) {

            if ($file_size <= 1000000) {

                if ($file_error === 0) {

                    $uploadDir = 'assets/img/';
                    $uploadFile = $uploadDir . uniqid('image') . '.' . $file_ext;

                    if (move_uploaded_file($file_tmp, $uploadFile)) {
                        $isSend = 'Les fichiers on bien été envoyé !';
                        header('Location: index.php');
                    } else {
                        echo 'Echec du téléchargement !';
                    }
                }

            } else {
                $error['size'] = $file_name . ' is too large.';
            }

        } else {
            $error['ext'] = $file_name . ' file extension' . $file_ext . ' is not allowed.';
        }
    }
}

$directory = 'assets/img';
$files = array_diff(scandir($directory), array('..', '.'));

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <title>Upload multiple files</title>
</head>
<body>
<h1 class="text-center">Hello, wilders!</h1>


<form action="#" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="files[]" multiple/>
        <input type="submit" value="Envoyer"/>
        <p class="text-danger"><?= $error['size'] ?? $error['ext'] ?? '' ?></p>

    </div>
</form>

<div class="row">
    <?php foreach ($files as $file) : ?>
        <div class="card col-2">
            <img src="assets/img/<?= $file ?>" alt="..." class="img-thumbnail">
            <div class="card-body">
                <h5 class="card-title"><?= $file ?></h5>
                <form action="delete.php" method="post">
                    <button type="submit" class="btn btn-primary" value="<?= $file ?>" name="file_name">Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>
