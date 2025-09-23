<?php
include './config/connection.php';
include './common_service/common_functions.php';






try {

$query = "SELECT `id`, `patient_name`, `address`, 
`cnic`, date_format(`date_of_birth`, '%d %b %Y') as `date_of_birth`, 
`phone_number`, `gender` 
FROM `patients` order by `patient_name` asc;";

  $stmtPatient1 = $con->prepare($query);
  $stmtPatient1->execute();

} catch(PDOException $ex) {
  echo $ex->getMessage();
  echo $ex->getTraceAsString();
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './config/site_css_links.php';?>

    <?php include './config/data_tables_css.php';?>

    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <title>Patients - Olalomi Patient Management System</title>

</head>

<body class="hold-transition sidebar-mini dark-mode layout-fixed layout-navbar-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php include './config/header.php';
include './config/sidebar.php';?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Patients</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->

            <section class="content">
                <!-- Default box -->
                <div class="card card-outline card-primary rounded-0 shadow">
                    <div class="card-header">
                        <h3 class="card-title">Total Patients</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row table-responsive">
                            <table id="all_patients" class="table table-striped dataTable table-bordered dtr-inline"
                                role="grid" aria-describedby="all_patients_info">

                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Patient Name</th>
                                        <th>Address</th>
                                        <th>CNIC</th>
                                        <th>Date Of Birth</th>
                                        <th>Phone Number</th>
                                        <th>Gender</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                  $count = 0;
                  while($row =$stmtPatient1->fetch(PDO::FETCH_ASSOC)){
                    $count++;
                  ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['patient_name'];?></td>
                                        <td><?php echo $row['address'];?></td>
                                        <td><?php echo $row['cnic'];?></td>
                                        <td><?php echo $row['date_of_birth'];?></td>
                                        <td><?php echo $row['phone_number'];?></td>
                                        <td><?php echo $row['gender'];?></td>
                                        <td>
                                            <a href="update_patient.php?id=<?php echo $row['id'];?>"
                                                class="btn btn-primary btn-sm btn-flat">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>

                                    </tr>
                                    <?php
                }
                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->


            </section>
        </div>
        <!-- /.content -->

        <!-- /.content-wrapper -->
        <?php 
 include './config/footer.php';

  $message = '';
  if(isset($_GET['message'])) {
    $message = $_GET['message'];
  }
?>
        <!-- /.control-sidebar -->


        <?php include './config/site_js_links.php'; ?>
        <?php include './config/data_tables_js.php'; ?>


        <script src="plugins/moment/moment.min.js"></script>
        <script src="plugins/daterangepicker/daterangepicker.js"></script>
        <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

        <script>
        showMenuSelected("#mnu_patients", "#mi_patients");

        var message = '<?php echo $message;?>';

        if (message !== '') {
            showCustomMessage(message);
        }
        $('#date_of_birth').datetimepicker({
            format: 'L'
        });


        $(function() {
            $("#all_patients").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#all_patients_wrapper .col-md-6:eq(0)');

        });
        </script>
</body>

</html>