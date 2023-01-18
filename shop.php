<?php
include "includes/nav.php";
?>
    <script src="/crest/js/jquery-1.10.2.min.js"></script>
    <script src="/crest/js/jquery-ui.js"></script>
    <script src="/crest/js/bootstrap.min.js"></script>
<script src="/crest/js/jquery-ui.js"></script>
<link href="/crest/css/jquery-ui.css" rel="stylesheet">
<link href="/crest/css/shop.css" rel="stylesheet">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="/crest/">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shop List</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                    <h3>Price</h3>
                    <input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="300000" />
                    <p id="price_show">&#8358;2000 - &#8358;300000</p>
                    <div id="price_range"></div>

            </div>
            <!-- Price End -->

            <!-- Shop Sidebar End -->
            <?php
            if (isset($_GET['category'])) {
                $url = $_GET['category'];

                $url = $db->real_escape_string($url);
                $count_stock = null;
                $cat_id = null;
                $stock_id = null;
                $category = $db->query("SELECT * FROM category WHERE url = '$url'");

                if ($category->num_rows > 0) {
                    $categorys = $category->fetch_assoc();
                    $cat_id = $categorys['id'];
            ?>

        </div>
        <!-- Shop category Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">10</a>
                                    <a class="dropdown-item" href="#">20</a>
                                    <a class="dropdown-item" href="#">30</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $stock = $db->query("SELECT * FROM stock WHERE status = '0' AND category_id = '$cat_id'");
                    if ($stock->num_rows > 0) {
                        // $count_stock = $stock->fetch_assoc();
                        foreach ($stock as $stocks) {

                ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden" onclick="window.location='/crest/detail/<?= $stocks['url'] ?>'">
                                    <img class="img-fluid w-100" src="/crest/uploads/items/<?= $stocks['image'] ?>" alt="<?= $stocks['name'] ?>">
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href=""><?= $stocks['name'] ?></a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>&#8358;<?= $stocks['price'] ?></h5>
                                        <h6 class="text-muted ml-2"><del>&#8358;<?= $stocks['price'] ?></del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small><?= $stocks['amount'] ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php
                        }
                    }
                }
            } else {
            ?>
            <!-- gender Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by category</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="category-all">
                        <label class="custom-control-label" for="category-all">All Category</label>
                        <!-- <span class="badge border font-weight-normal">1000</span> -->
                    </div>
                    <?php
                    $query = $db->query("SELECT DISTINCT(category_id) FROM stock WHERE status = '0' ORDER BY id DESC");
                    foreach ($query as $row) {
                        $cate_id = $row['category_id'];
                        $query = $db->query("SELECT DISTINCT(name) FROM category WHERE status = '0' AND id = '$cate_id' ORDER BY id DESC");
                        $catt = $query->fetch_assoc();
                        $catt_name = $catt['name'];

                    ?>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input common_selector brand" id="cat-<?= $row['category_id'] ?>" value="<?php echo $row['category_id']; ?>">
                            <label class="custom-control-label" for="cat-<?= $row['category_id'] ?>"><?php echo $catt_name; ?></label>
                        </div>
                    <?php
                    }

                    ?>

                </form>
            </div>
            <!-- gender End -->

            <!-- Size Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by size</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="size-all">
                        <label class="custom-control-label" for="size-all">All Size</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <?php
                    $query = $db->query("SELECT DISTINCT(size) FROM stock WHERE status = '0' ORDER BY id DESC");
                    foreach ($query as $row) {
                    ?>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input common_selector size" id="size-<?= $row['size'] ?>" value="<?php echo $row['size']; ?>">
                            <label class="custom-control-label" for="size-<?= $row['size'] ?>"><?php echo $row['size']; ?></label>
                        </div>
                    <?php
                    }

                    ?>

                </form>
            </div>
            <!-- Size End -->
            <!-- Gender Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by sex</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="sex-all">
                        <label class="custom-control-label" for="sex-all">All Sex</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <?php
                    $query = $db->query("SELECT DISTINCT(gender) FROM stock WHERE status = '0' ORDER BY id DESC");
                    foreach ($query as $row) {
                    ?>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input common_selector gender" id="sex-<?= $row['gender'] ?>" value="<?php echo $row['gender']; ?>">
                            <label class="custom-control-label" for="sex-<?= $row['gender'] ?>"><?php echo $row['gender']; ?></label>
                        </div>
                    <?php
                    }

                    ?>

                </form>
            </div>
            <!-- Gender End -->
            </div>
            <!-- Shop category Start -->
            <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">10</a>
                                    <a class="dropdown-item" href="#">20</a>
                                    <a class="dropdown-item" href="#">30</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            <div class="row filter_data">

                            </div>
                    <style>
                        #loading {
                            text-align: center;
                            background: url('/crest/loader.gif') no-repeat center;
                            height: 150px;
                        }
                    </style>

                    <script>
                        $(document).ready(function() {

                            filter_data();

                            function filter_data() {
                                $('.filter_data').html('<div id="loading" style="" ></div>');
                                var action = 'fetch_data';
                                var minimum_price = $('#hidden_minimum_price').val();
                                var maximum_price = $('#hidden_maximum_price').val();
                                var brand = get_filter('brand');
                                var gender = get_filter('gender');
                                var size = get_filter('size');
                                $.ajax({
                                    url: "/crest/php/filter_data.php",
                                    method: "POST",
                                    data: {
                                        action: action,
                                        minimum_price: minimum_price,
                                        maximum_price: maximum_price,
                                        brand: brand,
                                        gender: gender,
                                        size: size
                                    },
                                    success: function(data) {
                                        $('.filter_data').html(data);
                                    }
                                });
                            }

                            function get_filter(class_name) {
                                var filter = [];
                                $('.' + class_name + ':checked').each(function() {
                                    filter.push($(this).val());
                                });
                                return filter;
                            }

                            $('.common_selector').click(function() {
                                filter_data();
                            });

                            $('#price_range').slider({
                                range: true,
                                min: 2000,
                                max: 300000,
                                values: [2000, 300000],
                                step: 500,
                                stop: function(event, ui) {
                                    $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                                    $('#hidden_minimum_price').val(ui.values[0]);
                                    $('#hidden_maximum_price').val(ui.values[1]);
                                    filter_data();
                                }
                            });

                        });
                    </script>


                <?php
            } ?>
                </div>
            </div>




            <div class="col-12">
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</span></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Shop Product End -->
</div>
</div>
<!-- Shop End -->


<?php
include "includes/footer.php";
?>