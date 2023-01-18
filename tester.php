<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="/crest/js/jquery-1.10.2.min.js"></script>
    <script src="/crest/js/jquery-ui.js"></script>
    <script src="/crest/js/bootstrap.min.js"></script>
<script src="/crest/js/jquery-ui.js"></script>
<link href="/crest/css/jquery-ui.css" rel="stylesheet">
<link href="/crest/css/shop.css" rel="stylesheet">
</head>
<body>
    <div class="bg-light p-4 mb-30">
        <h3>Price</h3>
        <input type="hidden" id="hidden_minimum_price" value="0" />
        <input type="hidden" id="hidden_maximum_price" value="1000000" />
        <p id="price_show">&#8358;5000 - &#8358;1000000</p>
        <div id="price_range"></div>

</div>
<script>
                            $(document).ready(function() {
                                $('#price_range').slider({
                                range: true,
                                min: 5000,
                                max: 1000000,
                                values: [5000, 1000000],
                                step: 500,
                                stop: function(event, ui) {
                                    $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                                    $('#hidden_minimum_price').val(ui.values[0]);
                                    $('#hidden_maximum_price').val(ui.values[1]);
                                    filter_data();
                                }
                            });
                        })
</script>
</body>
</html>