<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

if ($_GET['action'] == 'edit') {

    $query = 'SELECT
            people_fullname, people_isactor, people_isdirector, people_email
        FROM
            people
        WHERE
            people_id = ' . $_GET['id'];

    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    extract(mysqli_fetch_assoc($result));

} else {
    //set values to blank
    $people_fullname = '';
    $people_isactor = '';
    $people_isdirector = '';
    $people_email = '';
}

    $check_actor=($people_isactor)? "checked": " " ;
    $check_director =($people_isdirector)? "checked":" ";

?>
<html>
 <head>
  <title><?php echo ucfirst($_GET['action']); ?> People</title>
  <style type="text/css">
<!--
#error { background-color: #600; border: 1px solid #FF0; color: #FFF;
 text-align: center; margin: 10px; padding: 10px; }
-->
  </style>
 </head>
 <body>
<?php
if (isset($_GET['error']) && $_GET['error'] != '') {
    echo '<div id="error">' . $_GET['error'] . '</div>';
}
?>
<form action="PeopleCommit.php?action=<?php echo $_GET['action']; ?>&type=people"
   method="post">
   <table>
    <tr>
<?php

if ($_GET['action'] == 'edit') {
    echo '<input type="hidden" value="' . $_GET['id'] . '" name="people_id" />';

    echo '<td>People Name</td>';
    echo '<td><input type="text" name="people_name" value="'. $people_fullname .'"/></td>';
    echo '</tr><tr>';
    echo '<td>People is actor?</td>';
    echo '<td><input type="checkbox" '. $check_actor .' name="people_actor">';
    echo '</tr><tr>';
    echo '<td>People is director?</td>';
    echo '<td><input type="checkbox" '. $check_director .' name="people_director">';
    echo '<td>People Email</td>';
    echo '<td><input type="text" name="people_email" value="'. $people_email .'"/></td>';

}else{
    echo '<td>People Name</td>';
    echo '<td><input type="text" name="people_name" value=" "/></td>';
    echo '</tr><tr>';
    echo '<td>People is actor?</td>';
    echo '<td><input type="checkbox" name="people_actor">';
    echo '</tr><tr>';
    echo '<td>People is director?</td>';
    echo '<td><input type="checkbox" name="people_director">';
    echo '</tr><tr>';
    echo '<td>People email?</td>';
    echo '<td><input type="text" name="people_email" value=" "></td>';
}
?>
      <input type="submit" name="submit"
       value="<?php echo ucfirst($_GET['action']); ?>" />
     </td>
    </tr>
   </table>
  </form>
 </body>
</html>
