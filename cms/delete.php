<?php
    //Connect met DataBase
    include('connect.php');
    $id = $_GET['id'];

    //SQL voor delete
    $sql = "DELETE FROM scheldwoord WHERE id=$id";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    //Execute de SQL code
    if ($statement->execute()) {
        echo 'Word id ' . $id . ' was deleted successfully.';
        header('location: index.php');
    }
?>