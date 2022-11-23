<?php

$db = mysqli_connect('localhost', 'root', 'root') or die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db,'moviesite') or die(mysqli_error($db));

$name = $_POST['people_name']; 
$people_email = $_POST['people_email'];

if(isset($_POST['people_actor'])){
    $actor = 1;

}else if(empty($_POST['people_actor']) == "false"){
    $actor = 0;

}else{
    echo "ERROR FATAL 404";
    
}

if(isset($_POST['people_director'])){
    $director = 1;

}else if(empty($_POST['people_director']) == "false"){
    $director = 0;

}else{
    echo "ERROR FATAL 404";

}

switch ($_GET['action']) {
    case 'add':
        switch ($_GET['type']) {
        case 'people':
            $error = array();
            $people_fullname = isset($_POST['people_fullname']) ?
                trim($_POST['people_fullname']) : '';
            if (empty($people_fullname)) {
                $error[] = urlencode('Please enter a people name.');
            }
            $people_isactor = isset($_POST['people_isactor']) ?
                trim($_POST['people_isactor']) : '';
            if (empty($people_isactor)) {
                $error[] = urlencode('Please select a lead actor.');
            }
            $people_isdirector = isset($_POST['people_isdirector']) ?
                trim($_POST['people_isdirector']) : '';
            if (empty($people_isdirector)) {
                $error[] = urlencode('Please select if is a director.');
            }
            $people_email = isset($_POST['people_email']) ?
                trim($_POST['people_email']) : '';
            if (empty($people_email)) {
                $error[] = urlencode('Please enter a email.');
            }
            if (empty($error)) {
                $query = 'INSERT INTO people
                
                (people_fullname, people_isactor, people_isdirector, people_email)
                
                VALUES
                ("' . $name . '",
                 ' . $actor . ',
                 ' . $director . ',
                 "' . $email . '")';
            } else {
              header('Location:peopleEditAdd.php?action=add' .
                  '&error=' . join(urlencode('<br/>'), $error));
            }
            break;
        }
        break;
    case 'edit':
        switch ($_GET['type']) {
        case 'people':
            $error = array();
            $people_fullname = isset($_POST['people_fullname']) ?
                trim($_POST['people_fullname']) : '';
            if (empty($people_fullname)) {
                $error[] = urlencode('Please enter a movie name.');
            }
            $people_isactor = isset($_POST['people_isactor']) ?
                trim($_POST['people_isactor']) : '';
            if (empty($people_isactor)) {
                $error[] = urlencode('Please select it is a lead actor.');
            }
            $people_isdirector = isset($_POST['people_isdirector']) ?
                trim($_POST['people_isdirector']) : '';
            if (empty($people_isdirector)) {
                $error[] = urlencode('Please select it is a director.');
            }
            $people_email = isset($_POST['people_email']) ?
                trim($_POST['people_email']) : '';
            if (empty($people_email)) {
                $error[] = urlencode('Please enter a email.');
            }
            if (empty($error)) {
                $query = 'UPDATE people
        
                SET people_fullname = "'. $name .'", people_isactor = '. $actor .', people_isdirector = '. $director .', people_email = '. $people_email .'
        
                WHERE people_id = '. $id .'';
            } else {
              header('Location:peopleEditAdd.php?action=edit&id=' . $_POST['movie_id'] .
                  '&error=' . join(urlencode('<br/>'), $error));
            }
            break;
        }
        break;
    }
    
if (isset($query)) {
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
}

?>

<p style="text-align: center;">Your person has been updated. <a href="people.php">Return to Index</a></p>