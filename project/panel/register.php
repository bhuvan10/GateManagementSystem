<?php
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Register User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Register User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
    <div class="card w-75 mb-3">


        <div class="card-body">
            <?php
            if(isset($_SESSION['status']))
            {
                echo "<h1 class='text-center text-success' >".$_SESSION['status']."</h1>";
                unset($_SESSION['status']);
            }
            ?>
            <h2 class="title text-center">Registration Form</h2>
            <form action="code.php" method="POST" class="">
                <div class="modal-body">
                <div class="row form-group">
                    <div class="col-auto">
                        <input type="text" class="form-control" name="firstname" placeholder="First name">
                    </div>
                    <div class="col-auto">
                        <input type="text" class="form-control" name="lastname" placeholder="Last name">
                    </div>
                </div>
                <div class="form-group ">
                    <input type="text" class="form-control" id="exampleInputEmail1" name="username" aria-describedby="emailHelp" placeholder="username">
                </div>
                <div class="form-group ">
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1"  placeholder="Password">
                </div>
                <button type="submit" name="addUser" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

    </div>
    </div>
</div>
</section>
</div>
<?php
include('includes/footer.php');

?>