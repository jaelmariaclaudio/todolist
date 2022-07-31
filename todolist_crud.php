<?php 
//CRUD with search
//BIND TABLE WITH SEARCH
function bind_table(){
    require 'connection.php';
    if(isset($_POST['search'])){
      $search_key = $_POST['txtsearch']."%";
      $sql = "SELECT * FROM list WHERE todolist LIKE :search";
      $stmt = $conn->prepare($sql);
      $stmt->execute([':search'=>$search_key]);
    //search for name->fname,lname,mname
    //has where condition
    }
    else{
      $sql = "SELECT * FROM list ";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    $GLOBALS['todolists'] = $stmt->fetchAll(PDO::FETCH_OBJ);
   
  }
//////////INSERT
//Initilaze/unset validation err session first:
unset($_SESSION['validation_err']);
//Require validation:
require "validation.php";

//FOR INSERT [CREATE]:
    //define variables:
    $todolist=$todolist_err = '';
    
    if(isset($_POST['create'])){
//execute_add is the name of the save button in form
//validation and clean data:
    ///validate
        //validateInput("First name", $_POST['fname'], "", $isRequired, $hasPattern)
    $todolist_err=validateInput("task", $_POST['todolist'], TRUE);
    ///clean data
    $todolist=cleandata($_POST['todolist']);

        try{
        require "connection.php";
    //check if $_SESSION['validation_err'] is not set;
        if(!isset($_SESSION['validation_err'])){
            $sql = 'INSERT INTO list (todolist) VALUES (:todolist)';
            $stmt = $conn->prepare($sql);
            if ($stmt->execute([
                ':todolist'=>$todolist
            ])) {
            $_SESSION['message'] = 'Data Inserted Successfully';
            //header("Refresh:0"); //refresh the page to display changes but the drawback is that it also refreshes the alert message
            bind_table(); //solution is to bind the table again after tbl changes
            $todolist="";

            }
        }
    }
        catch(PDOException $e){
        $_SESSION['err_message'] = $e->getMessage();
        }//end of try catch
    
    }//end of insert
    
//FOR UPDATE:
if(isset($_POST['edit'])){
    try{
      require "connection.php";
      $todolist=$_POST['todolist'];
      $id=$_GET['id'];
      //UPDATE tblname SET col1=val1, col2=val2 WHERE condition;
      $sql = "UPDATE list SET todolist=:todolist WHERE id=:id";
      $stmt = $conn->prepare($sql);
      if($stmt -> execute([
        ':todolist'=>$todolist,
        ':id'=>$id
      ])){
        $_SESSION['message'] = 'Data Updated Successfully';
        //header("Refresh:0");
        bind_table();
      }
    }catch(PDOException $e){
      $_SESSION['err_message'] = $e->getMessage();
    }
  }

///DELETE      
    if(isset($_GET['delete_id'])){
      try{
        require "connection.php";
        $id = $_GET['delete_id'];
        //DELETE FROM tblname WHERE condition;
        $sql = "DELETE FROM list WHERE id=:id";
        $stmt = $conn->prepare($sql);
        if($stmt->execute([':id'=>$id])){

            header("Location: todolist.php");
            header("Refresh:0");
            $_SESSION['message'] = "successfully deleted record id: $id";
        }
        }catch(PDOException $e){
            $_SESSION['err_message'] = "you cannot delete this record";
            //either a db error or constraint error
        }
    }
  

?>