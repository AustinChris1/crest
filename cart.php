<?php


include "includes/nav.php";
include "includes/auth.php";

require_once __DIR__ . "/models/Cart.php";
require_once __DIR__ . "/models/Product.php";

use Models\Cart;
use Models\Product;

$cartItems = array_map(function ($item) {
    $item->product = Product::where('id', 'stock_id')->getOne()->toArray();
    return $item->toArray();
}, Cart::where('status', 0)::where('user_id', $user_id)->get());

?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Cart Start -->
<div class="container-fluid" x-data='{
    items: <?php echo json_encode($cartItems); ?>
}'>
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php
                    $prod = $db->query("SELECT s.*, c.status AS cstatus, c.stock_id AS cstockid, c.user_id AS cuid, c.id AS cid FROM stock s, cart c WHERE c.stock_id = s.id AND c.user_id = '$user_id' AND c.status = '0'");
                    $add_price = null;
                    $num = null;
                    $total_price = null;
                    $total_total = null;
                    if ($prod->num_rows > 0) {
                        foreach ($prod as $showProd) {
                            $cart_id = $showProd['cid'];
                            $amCart = $db->query("SELECT * FROM cart WHERE user_id = '$user_id' AND status = '0' AND id = '$cart_id'");
                            $count_amCart = $amCart->fetch_assoc();
                            $add_price += $showProd['price'];
                            $total_price += $showProd['price'] * $count_amCart['quantity'];
                            $total_total = $total_price + 2000;
                    ?>
                            <tr data-id="<?php echo $cart_id; ?>">
                                <input type="hidden" value="<?= $showProd['price']; ?>" class="prodPrice">
                                <input type="hidden" value="<?= $showProd['cid']; ?>" class="prodId">
                                <td class="align-middle"><img src="uploads/items/<?= $showProd['image']; ?>" alt="" style="width: 50px;"><?= $showProd['name']; ?></td>
                                <td class="align-middle">&#8358;<?= $showProd['price']; ?></td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="number" class="form-control form-control-sm bg-secondary border-0 text-center quant" value="<?= $count_amCart['quantity']; ?>">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle mult"></td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger del"><i class="fa fa-times"></i></button></td>
                                <script>
                                    var inputValue
                                    var multiple
                                    var price
                                    var quant
                                    quant = document.querySelector('[data-id="<?php echo $showProd['cid']; ?>"] .quant');
                                    // inputValue = document.querySelector('[data-id="<?php echo $showProd['cid']; ?>"] .prodPrice').value;
                                    // multiple = document.querySelector('[data-id="<?php echo $showProd['cid']; ?>"] .mult');
                                    // window.onload = ()=> {
                                    // price = parseFloat(inputValue * quant.value)
                                    // price = "&#8358; " + price
                                    // multiple.innerHTML = price;
                                    // }
                                    document.querySelector('[data-id="<?php echo $showProd['cid']; ?>"] .quant').addEventListener('change', function() {
                                        inputValue = this.closest('[data-id="<?php echo $showProd['cid']; ?>"]').querySelector('.prodPrice').value;
                                        price = parseFloat(inputValue * quant.value)
                                        price = "&#8358; " + price
                                        multiple = this.closest('[data-id="<?php echo $showProd['cid']; ?>"]').querySelector('.mult');
                                        multiple.innerHTML = price;

                                    });

                                    document.querySelector('[data-id="<?php echo $showProd['cid']; ?>"] .del').addEventListener('click', function() {
                                        prod_id = this.closest('[data-id="<?php echo $showProd['cid']; ?>"]').querySelector('.prodId').value;
                                        var user_id = document.getElementById('uid').value
                                        // alert(user_id+' '+prod_id)

                                        swal({
                                                title: "Are you sure?",
                                                text: "Do you want to delete this cart?",
                                                icon: "warning",
                                                buttons: true,
                                                dangerMode: true,
                                            })
                                            .then((willDelete) => {
                                                if (willDelete) {
                                                    var formdata = new FormData();
                                                    formdata.append("cart_id", prod_id);
                                                    formdata.append("user_id", user_id);
                                                    fetch("php/deletecart.php", {
                                                        method: 'POST',
                                                        body: formdata,

                                                    }).then(() => {
                                                        swal({
                                                            title: "Success",
                                                            text: "Item deleted!",
                                                            icon: "success",
                                                            buttons: true,
                                                            dangerMode: false,
                                                        })
                                                        location.href = ''
                                                    })
                                                } else {}
                                            });

                                    })
                                </script>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr>Nothing available in cart</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <form class="mb-30" action="">
                <div class="input-group">
                    <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Apply Coupon</button>
                    </div>
                </div>
            </form>
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6>&#8358; <?= $total_price ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery</h6>
                        <h6 class="font-weight-medium">&#8358; 2000</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>&#8358; <?= $total_total ?></h5>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" onclick="window.location='checkout'">Proceed To Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<?php
include "includes/footer.php";
?>