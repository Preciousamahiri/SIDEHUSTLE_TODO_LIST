<?php
  include "db.inc.php";
  
  if (isset ($_GET['edit-todo'])) {
      $e_id = $_GET['edit-todo'];
  }

  if (isset($_POST['edit_todo'])){
     $edit_todo = $_POST['todo'];

     $query = "UPDATE todo SET t_name = '$edit_todo' WHERE t_id = $e_id";
     $run = mysqli_query ($connection,$query);

     if (!$run){
         die("Failed");
     }else{
         header("Location: index.php?updated");
     }

  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO list with PHP and Mysql</title>
    <Link rel="stylesheet" href="css/style.css">
    <style>
        
    </style>
</head>
<body>
    <div class="heading">
       <h1> MY TODO LIST </h1>
    </div>

    <form method="post"
        action=""> 
        <?php
           $sql = "SELECT * FROM todo WHERE t_id = $e_id";
           $result = mysqli_query($connection, $sql);
           $data = mysqli_fetch_array($result);
        ?>

        <input type="text"  name="todo" class="task_input"
         placeholder="This field is required" value= "<?php echo $data['t_name'];?>"/>

    <button name = "edit_todo" type="submit" class="add_btn">Add Task &nbsp; <span>&#43;</span></button>
     </form>                         
     </div>

          

</body>
</html>