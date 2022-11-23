<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

if (!isset($_GET['do']) || $_GET['do'] != 1) {
    switch ($_GET['type']) {
    case 'people':
        echo 'Are you sure you want to delete this person?<br/>';
        break;
    } 
    echo '<a href="' . $_SERVER['REQUEST_URI'] . '&do=1">yes</a> '; 
    echo 'or <a href="people.php">no</a>';
} else {
    switch ($_GET['type']) {
    case 'people':
        $query = 'UPDATE movie SET
                movie_leadactor = 0 
            WHERE
                movie_leadactor = ' . $_GET['id'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));

        $query = 'DELETE FROM people 
            WHERE
                people_id = ' . $_GET['id'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
  

?>
<p style="text-align: center;">Your person has been deleted. <a href="people.php">Return to Index</a></p>
<?php
        break;
    }
}
?>