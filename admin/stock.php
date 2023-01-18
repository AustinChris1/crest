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
                                        <th>Name</th>
                                            <th>Category name</th>
                                            <th>Image</th>
                                            <th>Price(NGN)</th>
                                            <th>Amount</th>
                                            <th>Size</th>
                                            <th>Gender</th>
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
                                            <th>Category name</th>
                                            <th>Image</th>
                                            <th>Price(NGN)</th>
                                            <th>Amount</th>
                                            <th>Size</th>
                                            <th>Gender</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $getStocks = $db->query("SELECT * FROM stock ORDER BY id DESC");
                                        foreach($getStocks as $stock){
                                            $cat_id = $stock['category_id'];
                                            $getCat = $db->query("SELECT * FROM category WHERE id = '$cat_id'");
                                            if($getCat->num_rows > 0){
                                            $category = $getCat->fetch_assoc();
                                                $cat_name = $category['name'];
                                            }else{
                                                $cat_name = "No Category Availble for this";
                                            }
                                        ?>
                                        <tr>
                                            <td><?=$stock['id']?></td>
                                            <td><?=$stock['name']?></td>
                                            <td><?=$cat_name?></td>
                                            <td><img class="w-50 h-50" src="../uploads/items/<?=$stock['image']?>" alt="<?=$stock['name']?>"></td>
                                            <td><?=$stock['price']?></td>
                                            <td><?=$stock['amount']?></td>
                                            <td><?=$stock['size']?></td>
                                            <td><?=$stock['gender']?></td>
                                            <td><?php if($stock['status'] == '0'){echo 'Active';}else{echo 'Unactive';}?></td>
                                            <td><?=$stock['date']?></td>
                                            <td><button class="btn btn-warning" onclick="window.location='stock_edit?id=<?=$stock['id']?>'">Edit</button></td>
                                            <td>
                                            <form action="code.php" method="POST">   
                                                        <button type="submit" name="stock_delete" value="<?= $stock[
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
