<?php
include "includes/nav.php";
include "includes/message.php";
include "includes/admin_auth.php";

?>




<!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Stock Category</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">View Stock Category</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $getStocks = $db->query("SELECT * FROM category ORDER BY id DESC");
                                        foreach($getStocks as $stock){
                                        ?>
                                        <tr>
                                            <td><?=$stock['id']?></td>
                                            <td><?=$stock['name']?></td>
                                            <td><img class="w-50 h-50" src="../uploads/category/<?=$stock['image']?>" alt="<?=$stock['name']?>"></td>
                                            <td><?php if($stock['status'] == '0'){echo 'Active';}else{echo 'Unactive';}?></td>
                                            <td><?=$stock['date']?></td>
                                            <td><button class="btn btn-warning" onclick="window.location='category_edit?id=<?=$stock['id']?>'">Edit</button></td>
                                            <td>
                                            <form action="code.php" method="POST">   
                                                        <button type="submit" name="category_delete" value="<?= $stock[
                                                            "id"
                                                        ] ?>" class="btn btn-danger">Delete</a>
                                                    
                                                    </form>

                                            </td>
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
