<?php
include "includes/nav.php";
?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shop Detail</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<?php
if (isset($_GET['product'])) {
    $url = $_GET['product'];

    $url = $db->real_escape_string($url);
    $count_cart = null;
    $cat_id = null;
    $cart_id = null;
    $stock = $db->query("SELECT * FROM stock WHERE url = '$url'");

    if ($stock->num_rows > 0) {
        $stocks = $stock->fetch_assoc();
        $cart_id = $stocks['id'];
        $cat_id = $stocks['category_id'];
        $cart = $db->query("SELECT * FROM cart WHERE user_id = '$user_id' AND status = '0' AND stock_id = '$cart_id'");
        if ($cart->num_rows > 0) {
            $count_cart = $cart->fetch_assoc();
            $quant = $count_cart['quantity'];
        } else {
            $quant = 0;
        }

?>
        <!-- Shop Detail Start -->
        <div class="container-fluid pb-5">
            <div class="row px-xl-5">
                <div class="col-lg-5 mb-30">
                    <div id="product-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner bg-light">
                            <div class="carousel-item active">
                                <img class="w-100 h-100" src="/crest/uploads/items/<?= $stocks['image'] ?>" alt="<?= $stocks['name'] ?>">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="/crest/uploads/items2/<?= $stocks['image2'] ?>" alt="">
                            </div>
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="/crest/uploads/items3/<?= $stocks['image3'] ?>" alt="">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-7 h-auto mb-30">
                    <div class="h-100 bg-light p-30">
                        <h3><?= $stocks['name'] ?></h3>
                        <div class="d-flex mb-3">
                            <div class="text-primary mr-2">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star-half-alt"></small>
                                <small class="far fa-star"></small>
                            </div>
                            <small class="pt-1">(99 Reviews)</small>
                        </div>
                        <h3 class="font-weight-semi-bold mb-4">&#8358;<?= $stocks['price'] ?></h3>
                        <p class="mb-4">Volup erat ipsum diam elitr rebum et dolor. Est nonumy elitr erat diam stet sit
                            clita ea. Sanc ipsum et, labore clita lorem magna duo dolor no sea
                            Nonumy</p>
                        <form action="#" method="POST" class="cartForm">
                            <input type="hidden" name="product_id" value="<?= $cart_id ?>">
                            <input type="hidden" name="user_id" value="<?= $user_id ?>">
                            <div class="d-flex mb-3">
                                <strong class="text-dark mr-3">Sex:</strong>
                                <strong class="text-dark mr-3"><?= $stocks['gender'] ?></strong>
                            </div>
                            <div class="d-flex mb-3">
                                <strong class="text-dark mr-3">Sizes:</strong>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="size-1" value="XS" name="size">
                                    <label class="custom-control-label" for="size-1">XS</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="size-2" value="S" name="size">
                                    <label class="custom-control-label" for="size-2">S</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="size-3" value="M" name="size">
                                    <label class="custom-control-label" for="size-3">M</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="size-4" value="L" name="size">
                                    <label class="custom-control-label" for="size-4">L</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="size-5" value="XL" name="size">
                                    <label class="custom-control-label" for="size-5">XL</label>
                                </div>
                            </div>
                            <div class="d-flex mb-4">
                                <strong class="text-dark mr-3">Colors:</strong>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="color-1" value="Black" name="color">
                                    <label class="custom-control-label" for="color-1">Black</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="color-2" value="White" name="color">
                                    <label class="custom-control-label" for="color-2">White</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="color-3" value="Red" name="color">
                                    <label class="custom-control-label" for="color-3">Red</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="color-4" value="Blue" name="color">
                                    <label class="custom-control-label" for="color-4">Blue</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="color-5" value="Green" name="color">
                                    <label class="custom-control-label" for="color-5">Green</label>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-4 pt-2">
                                <div class="input-group quantity mr-3" style="width: 130px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary btn-minus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control bg-secondary border-0 text-center" name="quantity" value="<?= $quant ?>">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <button class="btn btn-primary px-3 cartBtn" type="submit"><i class="fa fa-shopping-cart mr-1"></i> Add To
                                    Cart</button>
                            </div>
                        </form>
                        <div class="d-flex pt-2">
                            <strong class="text-dark mr-2">Share on:</strong>
                            <div class="d-inline-flex">
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row px-xl-5">
                <div class="col">
                    <div class="bg-light p-30">
                        <div class="nav nav-tabs mb-4">
                            <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                            <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                            <?php
                            $rev = $db->query("SELECT * FROM review_table WHERE product_id = '$cart_id'");
                            $rev_row = $rev->num_rows;
                            ?>
                            <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (<?=$rev_row?>)</a>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-pane-1">
                                <h4 class="mb-3">Product Description</h4>
                                <p><?= $stocks['description'] ?></p>
                            </div>
                            <div class="tab-pane fade" id="tab-pane-2">
                                <h4 class="mb-3">Additional Information</h4>
                                <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item px-0">
                                                Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item px-0">
                                                Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-pane-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="media mb-4">
                                            <div class="media-body">
                                                <div class="text-primary mb-2">
                                                    <div class="col-sm-4 text-center">
                                                        <h1 class="text-warning mt-4 mb-4">
                                                            <b><span id="average_rating">0.0</span> / 5</b>
                                                        </h1>
                                                        <div class="mb-3">
                                                            <i class="fas fa-star star-light mr-1 main_star"></i>
                                                            <i class="fas fa-star star-light mr-1 main_star"></i>
                                                            <i class="fas fa-star star-light mr-1 main_star"></i>
                                                            <i class="fas fa-star star-light mr-1 main_star"></i>
                                                            <i class="fas fa-star star-light mr-1 main_star"></i>
                                                        </div>
                                                        <h3><span id="total_review">0</span> Review</h3>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <p>
                                                    <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                                                    <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                                    </div>
                                                    </p>
                                                    <p>
                                                    <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                                                    <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                                                    </div>
                                                    </p>
                                                    <p>
                                                    <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                                                    <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                                                    </div>
                                                    </p>
                                                    <p>
                                                    <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                                                    <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                                                    </div>
                                                    </p>
                                                    <p>
                                                    <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                                                    <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                                                    </div>
                                                    </p>
                                                </div>
                                                    <div class="mt-5" id="review_content"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <form method="POST" action="#" class="reviewForm">
                                            <h4 class="mb-4">Leave a review</h4>
                                            <small>Your email address will not be published. Required fields are marked *</small>
                                            <div class="d-flex my-3">
                                                <p class="mb-0 mr-2">Your Rating * :</p>
                                                <div class="text-primary">
                                                    <h5 class="text-center mt-2 mb-4">
                                                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                                                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                                                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                                                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                                                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                                                    </h5>
                                                </div>
                                            </div>
                                            <input type="hidden" name="user_id" value="<?=$user_id?>" id="user_id">
                                            <input type="hidden" name="product_id"value="<?=$cart_id?>"  id="product_id">
                                            <div class="form-group">
                                                <label for="message">Your Review *</label>
                                                <textarea id="message" name="message" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Your Name *</label>
                                                <input type="text" name="name" class="form-control" id="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Your Email *</label>
                                                <input type="email" name="email" class="form-control" id="email">
                                            </div>
                                            <div class="form-group mb-0">
                                                <button type="submit" id="save_review" class="btn btn-primary px-3">Leave Your Review</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop Detail End -->


        <!-- Products Start -->
        <div class="container-fluid py-5">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
            <div class="row px-xl-5">
                <div class="col">
                    <div class="owl-carousel related-carousel">
                        <?php
                        $cat_query = $db->query("SELECT * FROM stock WHERE category_id = '$cat_id' AND id != '$cart_id'");
                        foreach ($cat_query as $cat) {
                        ?>
                            <div class="product-item bg-light">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="/crest/uploads/items/<?= $cat['image'] ?>" alt="<?= $cat['name'] ?>">
                                    <div class="product-action">
                                        <!-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a> -->
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" onclick="window.location='/crest/detail/<?= $cat['url'] ?>'"><i class="fa fa-sync-alt"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href=""><?= $cat['name'] ?></a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5><?= $cat['price'] ?></h5>
                                        <h6 class="text-muted ml-2"><del><?= $cat['price'] ?></del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small><?= $cat['amount'] ?></small>
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

        <!-- Products End -->
        <style>
            .progress-label-left {
                float: left;
                margin-right: 0.5em;
                line-height: 1em;
            }

            .progress-label-right {
                float: right;
                margin-left: 0.3em;
                line-height: 1em;
            }

            .star-light {
                color: #e9ecef;
            }
        </style>
        <script src="/crest/js/review.js"></script>
        <script src="/crest/js/cart.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<?php
    }
}

include "includes/footer.php";
?>