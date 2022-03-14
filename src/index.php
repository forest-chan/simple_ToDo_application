<?php 
    require 'script.php'; 
    
    if(isset($_GET['id'])){
        $edit_state = true;
        $id = $_GET['id'];
        
        $sql = "SELECT description FROM {$config['tablename']} WHERE id=?";
        $stmt =$db->prepare($sql);
        $stmt->execute(array($id));

        $description = $stmt->fetchColumn();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <div><h2>ToDo Application</h2></div>

    <?php if(isset($_SESSION['message'])){ ?>
            <div>
                <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
            </div>
    <?php } ?>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($fetched_data as $record) { ?>
                <tr>
                    <td>
                        <?php echo $record['description']; ?>
                    </td>
                    <td>
                        <a href="index.php?id=<?php echo $record['id']; ?>">Edit</a>
                    </td>
                    <td>
                        <a href="script.php?delete=<?php echo $record['id']?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <form action="script.php" method="post">
        <div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        </div>
        <div>
            <input type="text" name="task" placeholder="write a new task" value="<?php echo $description; ?>">
        </div>
        <?php if($edit_state == true) { ?>
            <div>
            <button type="submit" name="update">Update</button>
            </div>
        <?php } else { ?>
            <div>
           <button type="submit" name="submit">Add</button>
            </div>
        <?php } ?>
    </form>
</body>
</html>