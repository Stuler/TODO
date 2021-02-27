<?php

    require 'config.php';

    $id = $database->insert('items', [
        'text' => $_POST['message']
    ]);

    if ($id) {
        header('Location: ../');
        die();
    }
