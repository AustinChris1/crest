<?php
include "includes/nav.php";
include "includes/auth.php";
?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Checkout</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<?php
$user_details = $db->query("SELECT * FROM users WHERE id = '$user_id' LIMIT 1");
if ($user_details->num_rows > 0) {
    $user = $user_details->fetch_assoc();
}
$prod = $db->query("SELECT s.*, c.status AS cstatus, c.stock_id AS cstockid, c.user_id AS cuid, c.id AS cid FROM stock s, cart c WHERE c.stock_id = s.id AND c.user_id = '$user_id' AND c.status = '0'");
$c_id = null;
$add_price = null;
$num = null;
$t_price = null;
$total_price = null;
$total_total = null;
$prod_id = array();
while ($row = $prod->fetch_assoc()) {
    $prod_id[] = $row['id'];
    $c_id[] = $row['cid'];
}
// $prod_id = json_encode($prod_id);
if ($prod->num_rows > 0) {
    $s_fee = 2000;
$prod_id = implode(",", $prod_id);
$c_id = implode(",", $c_id);
    foreach ($prod as $showProd) {
        $add_price += $showProd['price'];
        $cart_id = $showProd['cid'];
        $amCart = $db->query("SELECT * FROM cart WHERE user_id = '$user_id' AND status = '0' AND id = '$cart_id'");
        $count_amCart = $amCart->fetch_assoc();
        $total_price += $showProd['price'] * $count_amCart['quantity'];
        $total_total = $total_price + $s_fee;
        // $num = $prod->num_rows;
        // $total_price = $add_price;
        // $total_total = $total_price + 2000;
    }
} else {
    $t_price = 0;
    $total_price = 0;
    $total_total = 0;
    $s_fee = 0;
    $t_total = 0;
    $c_id = '';
    $prod_id = '';
}
?>
<style>
    #success,
    #error {
        display: none;
    }
</style>
<script src="js/checkout.js" defer></script>
<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
            <div class="bg-light p-30 mb-5">
                <div id="success" class="alert alert-success" role="alert">
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                </div>
                <div id="error" class="alert alert-danger" role="alert">
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                </div>
                <form method="POST" action="#" class="row checkoutForm">

                    <div class="col-md-6 form-group">
                        <label>First Name</label>
                        <input type="hidden" name="user_id" value="<?= $user_id ?>">
                        <input type="hidden" name="cart_id" value="<?= $c_id ?>">
                        <input type="hidden" name="product_id" value="<?= $prod_id ?>">
                        <input type="hidden" name="amount" value="<?= $total_total ?>">
                        <input class="form-control" name="fname" type="text" value="<?= $user['fname'] ?>" readonly placeholder="John">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Last Name</label>
                        <input class="form-control" name="lname" type="text" value="<?= $user['lname'] ?>" readonly placeholder="Doe">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input class="form-control" name="email" type="email" value="<?= $user['email'] ?>" readonly placeholder="example@email.com">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Mobile No</label>
                        <input class="form-control" name="phone" type="tel" value="<?= $user['phone'] ?>" readonly placeholder="+123 456 789">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Address</label>
                        <input class="form-control" name="address" type="text" placeholder="123 Street Owerri West LGA">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Country</label>
                        <input class="form-control" name="country" type="text" value="Nigeria" readonly placeholder="Nigeria">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>City</label>
                        <input class="form-control" name="city" type="text" placeholder="Owerri">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>State</label>
                        <select class="custom-select" name="state" required>
                            <option disabled selected>--Select State--</option>
                            <option value="Abia">Abia</option>
                            <option value="Adamawa">Adamawa</option>
                            <option value="Akwa Ibom">Akwa Ibom</option>
                            <option value="Anambra">Anambra</option>
                            <option value="Bauchi">Bauchi</option>
                            <option value="Bayelsa">Bayelsa</option>
                            <option value="Benue">Benue</option>
                            <option value="Borno">Borno</option>
                            <option value="Cross River">Cross River</option>
                            <option value="Delta">Delta</option>
                            <option value="Ebonyi">Ebonyi</option>
                            <option value="Edo">Edo</option>
                            <option value="Ekiti">Ekiti</option>
                            <option value="Enugu">Enugu</option>
                            <option value="FCT">Federal Capital Territory</option>
                            <option value="Gombe">Gombe</option>
                            <option value="Imo">Imo</option>
                            <option value="Jigawa">Jigawa</option>
                            <option value="Kaduna">Kaduna</option>
                            <option value="Kano">Kano</option>
                            <option value="Katsina">Katsina</option>
                            <option value="Kebbi">Kebbi</option>
                            <option value="Kogi">Kogi</option>
                            <option value="Kwara">Kwara</option>
                            <option value="Lagos">Lagos</option>
                            <option value="Nasarawa">Nasarawa</option>
                            <option value="Niger">Niger</option>
                            <option value="Ogun">Ogun</option>
                            <option value="Ondo">Ondo</option>
                            <option value="Osun">Osun</option>
                            <option value="Oyo">Oyo</option>
                            <option value="Plateau">Plateau</option>
                            <option value="Rivers">Rivers</option>
                            <option value="Sokoto">Sokoto</option>
                            <option value="Taraba">Taraba</option>
                            <option value="Yobe">Yobe</option>
                            <option value="Zamfara">Zamfara</option>
                        </select>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold py-3" id="checkout" type="submit">Place Order</button>

                </form>
            </div>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom">
                    <h6 class="mb-3">Products</h6>
                    <?php
                    $prod = $db->query("SELECT s.*, c.status AS cstatus, c.stock_id AS cstockid, c.user_id AS cuid, c.id AS cid FROM stock s, cart c WHERE c.stock_id = s.id AND c.user_id = '$user_id' AND c.status = '0'");
                    if ($prod->num_rows > 0) {
                        foreach ($prod as $showProd) {
                            $num = $prod->num_rows;
                            $cart_id = $showProd['cid'];
                            $amCart = $db->query("SELECT * FROM cart WHERE user_id = '$user_id' AND status = '0' AND id = '$cart_id'");
                            $count_amCart = $amCart->fetch_assoc();
                            $t_price += $showProd['price'] * $count_amCart['quantity'];
                            $t_total = $t_price + 2000;
                    ?>
                            <div class="d-flex justify-content-between">
                                <p><?= $showProd['name'] ?>(<?= $count_amCart['quantity'] ?>)</p>
                                <p><?= $showProd['price'] * $count_amCart['quantity'] ?></p>
                            </div>
                    <?php
                        }
                    }

                    ?>
                </div>
                <div class="border-bottom pt-3 pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6>&#8358;<?= $t_price ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">&#8358;<?= $s_fee ?></h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>&#8358;<?= $t_total ?></h5>
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                <?php
$order = $db->query("SELECT * FROM orders WHERE user_id = '$user_id' AND status = '0' ORDER BY id DESC LIMIT 1");
if($order->num_rows<=0){
    echo "No pending order";
}else{

                ?>
                <div class="bg-light p-30">
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="crypto">
                            <label class="custom-control-label" for="crypto" data-toggle="collapse" data-target="#cryptodiv">Pay with crypto</label>
                            <div class="collapse mb-5" id="cryptodiv">
                                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Crypto</span></h5>
                                <div class="bg-light p-30">
                                    <?php
                                    $base_amount = intval(file_get_contents("php/rate.txt"));
                                    $value = $total_total / $base_amount;
                                    $rounded_value = round($value, 2);
                                    ?>
                                    <form method="POST" action="#" class="row cryptoForm">
                                        <input type="hidden" name="uid" value="<?= $user_id ?>">
                                        <input type="hidden" name="prod_id" value="<?= $prod_id ?>">
                                        <input type="hidden" name="rate" value="<?= $rounded_value ?>">
                                        <input type="hidden" name="email" value="<?= $user['email'] ?>">
                                        <div class="col-md-12 mb-4">
                                            <label>Send <?= $rounded_value ?> USDT [BEP20] to this address</label>
                                            <input type="text" class="form-control" id="copyText" readonly value="0x2b0afddfb1e34888847c52396e6757ffd60f4729">
                                            <button class="btn btn-primary copyBtn" data-clipboard-target="#inputId">Copy <i class="fa fa-clipboard" aria-hidden="true"></i></button>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <label>Your wallet address</label>
                                            <input type="text" name="wallet_address" class="form-control">
                                        </div>
                                        <button class="btn btn-block btn-primary font-weight-bold py-3 cryptoBtn" type="submit">Pay</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                            <label class="custom-control-label" for="banktransfer" data-toggle="collapse" data-target="#banktransferdiv">Pay with bank</label>
                            <div class="collapse mb-5" id="banktransferdiv">
                                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Bank</span></h5>
                                <div class="bg-light p-30">
                                    <div class="row">
                                    <?php
                                                function random_strings($length_of_string)
                                                {
                                        
                                                    // String of all alphanumeric character
                                                    $str_result = '0123456789abcdefghijklmnopqrstuvwxyz';
                                        
                                                    // Shuffle the $str_result and returns substring
                                                    // of specified length
                                                    return substr(
                                                        str_shuffle($str_result),
                                                        0,
                                                        $length_of_string
                                                    );
                                                }
                                                $ref_code = random_strings(6);

                                        ?>

                                        <form class="col-md-12 mb-3" id="paymentForm" method="POST">
                                            <h5>Hello! <?= $user['email'] ?></h5>
                                            You are about to make a payment of &#8358;<?= $total_total ?>
                                            <input type="hidden" name="uid" id="payId" value="<?= $user['id'] ?>">
                                            <input type="hidden" name="prod_id" id="payProd" value="<?= $prod_id ?>">
                                            <input type="hidden" name="email" id="payEmail" value="<?= $user['email'] ?>">
                                            <input type="hidden" name="phone" id="payPhone" value="<?= $user['phone'] ?>">
                                            <input type="hidden" name="amount" id="payAmount" value="<?= $total_total ?>">
                                            <input type="hidden" name="reference" id="reference">
                                        <script>
                                            var ref = document.getElementById('reference');
                                            ref.value = "<?php echo $ref_code?>";
                                        </script>
                                            <script src="https://js.paystack.co/v1/inline.js"></script>
                                            <button class="btn btn-block btn-primary font-weight-bold py-3 bankBtn" type="button" onclick="payWithPaystack()">Proceed</button>
                                        </form>
                                    </div>
                                    <script src="/crest/js/paystack.js"></script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
}
?>
            </div>
        </div>
    </div>
</div>
<!-- Checkout End -->
<script src="js/crypto.js"></script>
<script>
    var copyText = document.querySelector("#copyText");
    var copyBtn = document.querySelector(".copyBtn");
    copyBtn.onclick = () => {
        copyText.select();
        document.execCommand("Copy");
        swal({
                    title: "Success",
                    text: "Address copied to clipboard",
                    icon: "success",
                    buttons: true,
                    dangerMode: false,
                })
    }

    let ws = new WebSocket('wss://stream.binance.com:9443/ws/usdtngn@trade')

    ws.onmessage = (event) => {
        let stockObject = JSON.parse(event.data)
        let price = parseFloat(stockObject.p).toFixed(2)

        var formdata = new FormData();
        formdata.append("price", price);
        fetch("php/rate.php", {
            method: 'POST',
            body: formdata,

        }).then(() => {})

    }
</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<?php
include "includes/footer.php";
?>