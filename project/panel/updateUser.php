<?php
session_start();
include('includes/header.php');

include("../MysqlConnection.php")
    ?>
<!-- Content Wrapper. Contains page content -->

<div class="">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid ">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="btn btn-warning" href="../Userpanel.php?user_id=<?php echo $_GET['user_id'] ?>">Back</a></li>
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
                if (isset($_SESSION['status'])) {
                    echo "<h1 class='text-center text-success' >" . $_SESSION['status'] . "</h1>";
                    unset($_SESSION['status']);
                }
                ?>
                <h2 class="title text-center">User Profile</h2>
                <form action="code.php" method="POST" class="">
                    <?php
                    if (isset($_GET['user_id'])) {
                        $user_id = $_GET['user_id'];
                        $query = "SELECT * FROM user WHERE USER_ID='$user_id' LIMIT 1";
                        $query_run = mysqli_query($connection, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                                ?>
                                <div class="modal-body">
                                    <input type="hidden" name="user_id" value="<?php echo $row['USER_ID'] ?>">
                                    <div class="row form-group">
                                        <div class="col-auto">
                                            <input type="text" value="<?php echo $row['FIRST_NAME'] ?>" class="form-control"
                                                name="firstname" placeholder="First name">
                                        </div>
                                        <div class="col-auto">
                                            <input type="text" value="<?php echo $row['LAST_NAME'] ?>" class="form-control"
                                                name="lastname" placeholder="Last name">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <input type="text" value="<?php echo $row['username'] ?>" class="form-control"
                                            id="exampleInputEmail1" name="username" aria-describedby="emailHelp"
                                            placeholder="username">
                                    </div>
                                    <div class="form-group ">
                                        <input type="password" value="<?php echo $row['password'] ?>" class="form-control"
                                            name="password" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <?php
                            }
                        } else {
                            echo "<h4>No Record Found</h4>";
                        }

                    }
                    ?>

                        <button type="submit" name="updateUser" class="btn btn-info">Update</button>
                    </div>
                </form>
            </div>

        </div>
        <div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                Add vehicle
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Vehicle Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="code.php" method="POST" class="">
                                <div class="modal-body">
                                    <input type="hidden" name="user_id" value="<?php echo $_GET['user_id'] ?>">
                                    <div class="row form-group">
                                        <div class="col-auto">
                                            <input type="text" class="form-control" name="platenumber"
                                                placeholder="Plate Number">
                                        </div>
                                        <div class="col-auto">
                                            <input type="text" class="form-control" name="color" placeholder="Color">
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                        </div>
                                        <select class="custom-select" id="inputGroupSelect01" name="type">
                                            <option selected>Choose...</option>
                                            <option value="Two-wheeler">Two-wheeler</option>
                                            <option value="Four-wheeler">Four-wheeler</option>
                                        </select>
                                    </div>

                                    <button type="submit" name="addVehicle" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Vehicle Owned</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Plate Number</th>
                                        <th>Color</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                               <?php
                               $user_id=$_GET['user_id'];
                               $query="SELECT * FROM owner NATURAL JOIN vehicle where USER_ID='$user_id'";
                               $query_run=mysqli_query($connection,$query);
                               if(mysqli_num_rows($query_run)>0)
                               {
                                foreach($query_run as $row)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['PLATE_NUMBER'];?></td>
                                        <td><?php echo $row['COLOR'];?></td>
                                        <td><?php echo $row['VEHICLE_TYPE'];?></td>
                                        
                                    </tr>
                                    <?php
                                }
                               }
                               ?>
                               
                            </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>
</section>
</div>
<?php
include('includes/footer.php');

?>