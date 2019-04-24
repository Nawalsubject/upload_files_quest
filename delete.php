<?php

if ($_SERVER['REQUEST_METHOD']==='POST') {

    if (file_exists('assets/img/'. $_POST['file_name'])) {
        var_dump($_POST);
        unlink('assets/img/'.$_POST['file_name']);
        header('Location: index.php');
    }
}

