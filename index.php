<?php
  include "db.inc.php";

  $query = "SELECT * FROM todo";
  $result = mysqli_query($connection, $query);

  
  
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $todo = $_POST["todo"];
      $date = date("l dS F\, Y");
      
    if (empty($todo)){
        $error = "Field is required";
    }
    
    
      else {
      $sql = "INSERT INTO todo(t_name,t_date) VALUES ('$todo','$date');";
      $results = mysqli_query($connection, $sql);

      if (!$results){
          die  ("Failed");
        }else{
            header("Location:index.php?todo-added");
        }
  }      
  }
   
  if (isset($_GET['delete_todo'])){
      $dtl_todo = $_GET['delete_todo'];
      $sqli = "DELETE FROM todo WHERE t_id = $dtl_todo";
      $res = mysqli_query($connection,$sqli);
      
      if (!$res){
        die  ("Failed");
      }else{
          header("Location:index.php?todo-deleted");
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
       <?php
          if (isset ($error)){
              echo $error;
          }
       ?>
    </div>

    <form method="post"
        action="index.php"> <input type="text"  name="todo" class="task_input"
         placeholder="Add New Task "/>

    <button type="submit" class="add_btn">Add Task &nbsp; <span>&#43;</span></button>
     </form>                       
           
           <div class="table-responsive">
               <table class="table, table-bordered, table-striped, table-hover">
                   <thead>
                       <th>ID</th>
                       <th>Task</th>
                       <th>Date Added</th>
                       <th>Edit Task</th>
                       <th>Delete Task</th>
                   </thead>
                  <tbody>
                        <?php
                          while ($row = mysqli_fetch_assoc($result)){
                              $t_id = $row["t_id"];
                              $t_name = $row["t_name"];
                              $t_date = $row["t_date"];

                              ?>
                        <tr>
                            <td><?php echo $t_id; ?></td>
                            <td><?php echo $t_name;?></td>
                            <td><?php echo $t_date;?></td>
                            <td><a href="edit.php?edit-todo=<?php echo $t_id;?>" class="btn btn-primary">Edit Task</a> </td>
                            <td> <a href="index.php?delete_todo=<?php echo $t_id ?>" class="btn btn-danger">Delete Task</a> </td>
                        </tr>



                         <?php }
                                        
                        ?>
                            </tbody>
                </table>
        </div> 
</body>
</html>