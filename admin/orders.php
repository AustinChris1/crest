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
                                        <th>Product name</th>
                                            <th>User name</th>
                                            <th>Price(NGN)</th>
                                            <th>Quantity</th>
                                            <th>Size</th>
                                            <th>Sex</th>
                                            <th>Status</th>
                                            <th>Address</th>
                                            <th>Date</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>ID</th>
                                        <th>Product name</th>
                                            <th>User name</th>
                                            <th>Price(NGN)</th>
                                            <th>Quantity</th>
                                            <th>Size</th>
                                            <th>Sex</th>
                                            <th>Status</th>
                                            <th>Address</th>
                                            <th>Date</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $order = $db->query("SELECT * FROM orders");
                                        foreach($order as $orders){
                                            $product_id = $orders['product_id'];
                                            $user_id = $orders['user_id'];
                                            $products = $db->query("SELECT * FROM stock");
                                            $ex_prod = explode(",", $product_id);
                                            $product_name = '';
                                            $product_quant = '';
                                            $product_size ='';
                                            $product_color ='';
                                            $cart ='';

                                            foreach ($products as $p) {
                                                $pid = $p['id'];
                                                if (in_array($p['id'], $ex_prod)) {
                                                     $product_name .= $p['name'].', ';
                                                    // echo $pid;
                                                    $carts = $db->query("SELECT * FROM cart WHERE stock_id = '$pid' AND user_id = '$user_id'");
                                                    // $cart = $carts->fetch_array();
                                                     while ($cart = $carts->fetch_assoc()) {
                                                        $product_quant .= $cart['quantity'].' ';
                                                    $product_size .=$cart['size'].' ';
                                                    $product_color .=$cart['color'].' ';
                                                    }
                                                }
                                            }
                                            $user = $db->query("SELECT * FROM users WHERE id = '$user_id'");
                                            $users = $user->fetch_assoc();
                                            $name = $users['fname']. " ". $users['lname'];
                                            $phone = $users['phone'];
                                                                                ?>
                                        <tr>
                                            <td><?=$orders['id']?></td>
                                            <td><?=$product_name?></td>
                                            <td><?=$name?></td>
                                            <td><?=$orders['amount_paid']?></td>
                                            <td><?=$product_quant?></td>
                                            <td><?=$product_size?></td>
                                            <td><?=$product_color?></td>
                                            <td><?php if($orders['status'] == '0'){echo 'Pending';}elseif($orders['status'] == '2'){echo 'Deleted';}else{echo 'Paid';}?></td>
                                            <td><?=$orders['address']?></td>
                                            <td><?=$orders['date']?></td>
                                            <td><button class="btn btn-warning" onclick="window.location='orders_edit?id=<?=$orders['id']?>'">Edit</button></td>
                                            <td>
                                            <form action="code.php" method="POST">   
                                                        <button type="submit" name="orders_delete" value="<?= $orders[
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
