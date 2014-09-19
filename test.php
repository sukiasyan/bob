<form  name="test" method="post">
    <input type="text" name="text">
    <input type="submit" name="press" value="AAA">
</form>

<?php
 if($_POST['press']==false)
     echo "fffffffffffffffff";
else echo $_POST['text'];
?>