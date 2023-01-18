<?php
include "includes/nav.php";
include "includes/message.php";
include "includes/admin_auth.php";

?>



<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Customers</div>
                        <?php
                        $dash_category_query = $db->query("SELECT * FROM users WHERE verify_status = '1'");
                        if ($category_total = mysqli_num_rows($dash_category_query)) {
                            echo "<div class='h5 mb-0 font-weight-bold text-gray-800' onclick='window.location='users''>" . $category_total . " </div>";
                        } else {
                            echo '<div class="h5 mb-0 font-weight-bold text-gray-800" onclick="window.location="users">No Data</div>';
                        }
                        ?>

                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Items</div>
                        <?php
                        $dash_category_query = $db->query("SELECT * FROM stock WHERE status = '0'");
                        if ($category_total = mysqli_num_rows($dash_category_query)) {
                            echo "<div class='h5 mb-0 font-weight-bold text-gray-800' onclick='window.location='stock''>" . $category_total . " </div>";
                        } else {
                            echo '<div class="h5 mb-0 font-weight-bold text-gray-800" onclick="window.location="stock">No Data</div>';
                        }
                        ?>

                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            UnPaid Orders</div>
                        <?php
                        $dash_category_query = $db->query("SELECT * FROM orders WHERE status = '0'");
                        if ($category_total = mysqli_num_rows($dash_category_query)) {
                            echo "<div class='h5 mb-0 font-weight-bold text-gray-800' onclick='window.location='orders''>" . $category_total . " </div>";
                        } else {
                            echo '<div class="h5 mb-0 font-weight-bold text-gray-800" onclick="window.location="orders">No Data</div>';
                        }
                        ?>

                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Paid Orders</div>
                        <?php
                        $dash_category_query = $db->query("SELECT * FROM orders WHERE status = '1'");
                        if ($category_total = mysqli_num_rows($dash_category_query)) {
                            echo "<div class='h5 mb-0 font-weight-bold text-gray-800' onclick='window.location='orders''>" . $category_total . " </div>";
                        } else {
                            echo '<div class="h5 mb-0 font-weight-bold text-gray-800" onclick="window.location="orders">No Data</div>';
                        }
                        ?>

                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<!-- Content Row -->
<div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>


    </div>
</div>

<?php
include "includes/footer.php";
?>