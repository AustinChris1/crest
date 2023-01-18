<?php
include "includes/nav.php";
include "includes/message.php";
include "includes/admin_auth.php";

?>




<!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Users</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Registered Users</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>ID</th>
                                        <th>First name</th>
                                            <th>Last name</th>
                                            <th>Email</th>
                                            <th>Phone number</th>
                                            <th>Status</th>
                                            <th>Usertype</th>
                                            <th>Registration Date</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>ID</th>
                                        <th>First name</th>
                                            <th>Last name</th>
                                            <th>Email</th>
                                            <th>Phone number</th>
                                            <th>Status</th>
                                            <th>Usertype</th>
                                            <th>Registration Date</th>
                                            <th>Edit</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $getUsers = $db->query("SELECT * FROM users");
                                        foreach($getUsers as $user){
                                        ?>
                                        <tr>
                                            <td><?=$user['id']?></td>
                                            <td><?=$user['fname']?></td>
                                            <td><?=$user['lname']?></td>
                                            <td><?=$user['email']?></td>
                                            <td><?=$user['phone']?></td>
                                            <td><?php if($user['verify_status'] == '1'){echo 'Verified';}else{echo 'Unverified';}?></td>
                                            <td><?php if($user['usertype'] == '1'){echo 'Admin';}else{echo 'User';}?></td>
                                            <td><?=$user['date']?></td>
                                            <td><button class="btn btn-warning" onclick="window.location='user_edit?id=<?=$user['id']?>'">Edit</button></td>
                                 </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php
include "includes/footer.php";
?>
