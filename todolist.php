<?php 
session_start();
$title = 'Student Page';
include 'header.php';
require 'todolist_crud.php';
bind_table();

?>

<!--script src for jquery-->
        <?php if(isset($_SESSION['validation_err'])): ?>
        <!--script for keeping the modal open-->
        <script>
            $(document).ready(function () {
            $("#createModal").modal('show');
            });
        </script>
        <?php endif; ?>

    <!--ALERT MESSAGE SUCCESS-->
    <?php if(!empty($_SESSION['message'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['message']; ?>
        </div>
        <?php unset($_SESSION['message']); //unset to reset it after displaying the msg if you do not do this, the content of the session will remain as it is?>
        <?php endif; ?>
    <!--ALERT MESSAGE ERROR-->
        <?php if(!empty($_SESSION['err_message'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['err_message'];?>
        </div>
        <?php unset($_SESSION['err_message']); ?>
        <?php endif; ?>
<!--------------------SEARCH-------------------------------------->
<form method="POST" action = "<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>"><br>

        <div class="container-sm">
		<div class="input-group mb-4">
			<input type="text" name="txtsearch" class="form-control" placeholder="Enter a task here" aria-label="search" aria-describedby="search">
			<button class="btn btn-light text-bg-dark" type="submit" name="search" id="search">search</button>
            </div>
		</div>
        </form>

<!--TABLE--->

    <div class="card mt-5">
        <div class="card-header">
        <h2 class="h2 text-center mt-3 mb-2 pb-2 display-3">THINGS I NEED TO DO:</h2>
        </div>

        <!--TRIGGER MODAL--->

        <div class="container">
        <div class="text-center">
    <button type="button" class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#createModal">
        Add a task
        </i></button>
        <a href="pdf.php" class="btn btn-danger mt-3" role="button">Print PDF</a>
    </div>
</div>


        <div class="container">
        <div class="card-body">
        <table class="table table-bordered table-warning" id="tableStudent">
            <tr>
        <thead class="table-dark">
            <th>ID</th>
            <th>To do list</th>
            <th></th>
            </tr>
            </thead>
 
            <?php foreach($todolists as $i): ?>
            <tr>
                <td><?= $i->id; ?></td>
                <td><?= $i->todolist;?></td>
                <td></div>
                <!--button for update modal-->
                <a href="#edit_<?= $i->id;?>" class="btn btn-warning" data-bs-toggle="modal">Edit</a>
                <?php require "todolist_update.php"; ?>
                <!--button for delete modal-->
                <a onclick="return confirm('Are you sure you want to delete this record?')" href="todolist_crud.php?delete_id=<?= $i->id;?>" class='btn btn-dark'>Delete</a>
                </td>
            </tr></div>
            <?php endforeach; ?>
        </table>
        </div>
    </div>

    <?php include 'footer.php';?>

<!--------MODAL---------->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createModalLabel">Add Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
        </div>

        <div class="modal-body">
        <form method="POST" id="createForm" name="createForm">

        <!--fname-->
            <div class="form-group">
            <label for="todolist">TO DO LIST</label>
            <input type="text" name="todolist" class="form-control"
            value="<?= $todolist; ?>">
            <span class="error"><?= $todolist_err; ?></span>
            </div>
        
            <div class="form-group float-right">
        </br>
            <button type="submit" class="btn btn-dark" name="create">
                Save Record
            </button>
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
            <!--button name is important it will be used to check if the user triggered create-->
            </div>
        </form>
        </div>
        </div>
    </div>
    </div>
