<!--
    Dit is de form met de method POST
-->
<form action="check.php" method="post">
    Level:  <select name="level">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select><br>
    Sentice: <textarea name="sentice" required></textarea><br>
    <input type="submit" name="submit" value="Insert">
</form>