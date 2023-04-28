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
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
          <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                        <?php
                            $query="SELECT extract(hour from ENTRY_TIME) as hr,count(*) from gate_log group by extract(hour from ENTRY_TIME)order by 1";
                            $query_run=mysqli_query($connection,$query);
                            if(mysqli_num_rows($query_run)>0){
                                foreach($query_run as $row)
                                {   
                                    $value=(int)$row['hr'];
                                    if($value>12)
                                    {
                                        $value=$value-12;
                                      $value=$value.":00 to ".($value+1)." :00 pm";
                                    }
                                    else
                                    $value=$value.":00 to ".($value+1)." :00 am";
                                    ?>
                                        
                                       <h5><?php echo $value?></h5>
                                    <?php   
                                }
                            }
                            ?>

                            <p>Peak hours of gate utilization</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                        <?php
                            $query="SELECT COUNT(*) AS COUNT  FROM gate_log WHERE ENTRY_TIME > DATE_SUB(NOW(), INTERVAL 24 HOUR)";
                            $query_run=mysqli_query($connection,$query);
                            if(mysqli_num_rows($query_run)>0){
                                foreach($query_run as $row)
                                {
                                    ?>
                                       <h5><?php echo $row['COUNT']?></h5>
                                    <?php   
                                }
                            }
                            ?>

                            <p>Number entries in last 24 hours</br></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                        <?php
                            $query="SELECT  COUNT(*) as COUNT from vehicle";
                            $query_run=mysqli_query($connection,$query);
                            if(mysqli_num_rows($query_run)>0){
                                foreach($query_run as $row)
                                {
                                    ?>
                                       <h5><?php echo $row['COUNT']?></h5>
                                    <?php   
                                }
                            }
                            ?>

                            <p>Vehicle Registerations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-model-s"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <?php
                            $query="SELECT  COUNT(*) as COUNT from user";
                            $query_run=mysqli_query($connection,$query);
                            if(mysqli_num_rows($query_run)>0){
                                foreach($query_run as $row)
                                {
                                    ?>
                                       <h5><?php echo $row['COUNT']?></h5>
                                    <?php   
                                }
                            }
                            ?>
                            

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
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
                                        aria-label="Rendering engine: activate to sort column descending">Plate Number</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending">First Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending">Last Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">Username
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">Entry Time</th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">Exit Time</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                               $query="SELECT * FROM user NATURAL JOIN owner NATURAL JOIN vehicle NATURAL JOIN gate_log ";
                               $query_run=mysqli_query($connection,$query);
                               if(mysqli_num_rows($query_run)>0)
                               {
                                foreach($query_run as $row)
                                {

                                    ?>
                                    <tr>
                                        <td><?php echo $row['PLATE_NUMBER'];?></td>
                                        <td><?php echo $row['FIRST_NAME'];?></td>
                                        <td><?php echo $row['LAST_NAME'];?></td>
                                        <td><?php echo $row['username'];?></td>
                                        <td><?php echo $row['ENTRY_TIME'];?></td>
                                        <td><?php echo $row['EXIT_TIME'];?></td>
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