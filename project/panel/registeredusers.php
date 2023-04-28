<?php
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('../MysqlConnection.php')
?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registered Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Registered Users </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- delete user -->
    <div class="modal fade" id="DeleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="code.php" method="POST" class="">
                                <div class="modal-body">
                                    <input type="hidden" name="delete_id" class="delete_user_id">
                                    <p>
                                        Are you sure,you waant to remove this user
                                    </p>

                                    

                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="DeleteUserbtn">Yes, Delete.!</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

    <div class="card">
       
       
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline collapsed"
                            aria-describedby="example1_info">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">id</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending">First Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending">Last Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">username
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending"
                                        style="display: none;">action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                               $query="SELECT * FROM user";
                               $query_run=mysqli_query($connection,$query);
                               if(mysqli_num_rows($query_run)>0)
                               {
                                foreach($query_run as $row)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['USER_ID'];?></td>
                                        <td><?php echo $row['FIRST_NAME'];?></td>
                                        <td><?php echo $row['LAST_NAME'];?></td>
                                        <td><?php echo $row['username'];?></td>
                                        <td>
                                            <a href="viewUser.php?user_id=<?php echo $row['USER_ID'];?>" class="btn btn-info btn-sm">view</a>
                                            <button type="button" value="<?php echo $row['USER_ID'];?>"  class="btn btn-danger btn-sm deletebtn">Delete</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                               }
                               ?>
                               
                            </tbody>
                            
                        </table>
                    </div>
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
<script>
    $(document).ready(function(){
      $('.deletebtn').click(function(e){
        e.preventDefault();
        var user_id=$(this).val();
        $('.delete_user_id').val(user_id);
        $('#DeleteModel').modal('show');
      });
    });
</script>