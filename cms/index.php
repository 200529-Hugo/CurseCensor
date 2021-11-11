<?php

//Connect met DataBase
require ('connect.php');

//Checkt dat iemand op submit heeft geklikt
if (isset($_POST['submit'])) {
    //Verbind de input gegevens aan een var
    $bad = $_POST['bad'];
    $good = $_POST['good'];
    $lvl = $_POST['lvl'];
    $active = $_POST['active'];

    //SQL voor insert
    $sql = "INSERT INTO scheldwoord (badword, goodword, level, active) VALUES (:bad, :good, :lvl, :active)";
    $statement = $conn->prepare($sql);

    //Execute SQL
    $statement->execute([':bad' => $bad,':good' => $good,':lvl' => $lvl,':active' => $active]);
    $publisher_id = $conn->lastInsertId();
}

//Pakt alle gegevens van de DataBase
try {
    $sql = 'SELECT id, badword, goodword, level, active FROM scheldwoord ORDER BY id';
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
        Form voor woord toevoegen
    -->
    <form action="index.php" method="post">
        <label>Words</label>
        <input type="text" name="bad" placeholder="Bad input" required>
        <input type="text" name="good" placeholder="Good input" required>

        <label>
            <input type="radio" name="lvl" value="1">
            Level - 1
        </label>
        <label>
            <input type="radio" name="lvl" value="2">
            Level - 2
        </label>

        <label>
            <input type="radio" name="active" value="1">
            Activate
        </label>
        <label>
            <input type="radio" name="active" value="0">
            Not Activate
        </label>

        <input type="submit" name="submit" value="Submit">

    </form>

    <!--Tabel met alle woorden-->
    <table>
        <thead>
            <tr>
                <th><abbr>ID:</abbr></th>
                <th><abbr>Bad</abbr></th>
                <th><abbr>Good</abbr></th>
                <th><abbr>Level</abbr></th>
                <th><abbr>Active</abbr></th>
                <th><abbr>Update</abbr></th>
                <th><abbr>Delete</abbr></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $q->fetch()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']) ?></td>
                    <td><?php echo htmlspecialchars($row['badword']); ?></td>
                    <td><?php echo htmlspecialchars($row['goodword']); ?></td>
                    <td><?php echo htmlspecialchars($row['level']); ?></td>
                    <td><?php echo htmlspecialchars($row['active']); ?></td>
                    <td><a href="update.php?id=<?php echo htmlspecialchars($row['id']); ?>" >Update</a></td>
                    <td><a href="delete.php?id=<?php echo htmlspecialchars($row['id']); ?>" >Delete</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>