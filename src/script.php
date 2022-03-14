<?php 

require 'config.php';

ini_set('display_errors', 1); // вывод ошибок на экран
error_reporting(E_ALL); // выводим все ошибки

session_start();

$edit_state = false;
$description = '';
$id = 0;

if(isset($_POST["submit"])){
    if(isset($_POST["task"])){
        $description = $_POST['task'];
        
        $sql = "INSERT INTO {$config['tablename']} VALUES (NULL, ?)";
        $stmt = $db->prepare($sql);

        try{
            $db->beginTransaction();
            $stmt->execute(array($description));
            $db->commit();
        } catch(PDOException $e){
            $db->rollBack();
        }

        $_SESSION['message'] = 'Task added successfully';

        header("location: /");
    }
} elseif(isset($_POST['update'])){
    $description = $_POST['task'];
    $id = $_POST['id']; 

    $sql = "UPDATE {$config['tablename']} SET description=? WHERE id=?"; //update
    $stmt =$db->prepare($sql);
    $stmt->execute(array($description, $id));
    
    header("location: /");
    
}

if(isset($_GET['delete'])){    
    $id = $_GET['delete']; 

    $sql = "DELETE FROM {$config['tablename']} WHERE id=?";
    $stmt =$db->prepare($sql);
    $stmt->execute(array($id));
 
    header("location: /");
}


$sql = "SELECT * FROM {$config['tablename']}";
$stmt = $db->query($sql);
$fetched_data = $stmt->fetchAll();

?>