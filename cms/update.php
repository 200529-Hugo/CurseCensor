<?php
    //connect met de DataBase
    include('connect.php');

    //Kijkt dat het update
    if(isset($_POST['update'])){
        //Input word gekoppeld aan een var
        $id=$_POST['id'];
        $bad=$_POST['bad'];
        $good=$_POST['good'];
        $level=$_POST['lvl'];
        $active=$_POST['active'];

        //Dit is de update query
        $query="UPDATE scheldwoord SET badword=?,goodword=?,level=?,active=? WHERE id=?";
        $conn->prepare($query)->execute([$bad, $good, $level,$active, $id]);

        //Gaat terug naar index
        header('location: index.php');
    }

    try {
        //Pakt alle gegevens van het gekozen woord
        $id = $_GET['id'];
        $sql = "SELECT * FROM scheldwoord WHERE id=$id";

        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Could not connect to the database $db :" . $e->getMessage());
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
</head>
<body>
    <!--
        Dit is de update form met de method post
    -->
    <form action="update.php" method="post">
        <label class="label">Old Settings</label>
        <?php while ($row = $q->fetch()): ?>
            <label>Word:</label><br>
            <input class="input" type="text" name="bad" id="words" value="<?php echo htmlspecialchars($row['badword']) ?>" placeholder="Bad input" ></td>
            <input class="input" type="text" name="good" id="words" value="<?php echo htmlspecialchars($row['goodword']) ?>" placeholder="Good input" ></td>
            <br><br>
            <label>Level: </label><br>
            <label>
                <input type="radio" name="lvl" value="1" required>
                Level - 1
            </label>
            <label>
                <input type="radio" name="lvl" value="2" required>
                Level - 2
            </label>
            <br><br>
            <label>Active: </label><br>
            <label>
                <input type="radio" name="active" value="1" required>
                Activate
            </label>
            <label>
                <input type="radio" name="active" value="0" required>
                Not Activate
            </label>
            <br><br>
            <label>ID:</label><br>
            <input class="input" readonly type="text" name="id" id="id" value="<?php echo htmlspecialchars($row['id']) ?>" placeholder="Text input" ></td>
            <br><br>      
        <?php endwhile; ?>
        <input type="submit" id="update" name="update" class="button is-warning" value="update">
    </form>
</body>
</html>