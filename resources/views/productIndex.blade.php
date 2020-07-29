<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products Listing</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #f8f8f8">
<div class="container">
    <h2 style="margin-top: 3%;
    margin-bottom: 3%;text-align: center">Products</h2>
    <div id="productDetail"></div>
</div>
<script>
    $(function(){

        var is_active = '{{Request::get("is_active")}}';
        var url = 'api/products?is_active=' + is_active;
        if(is_active != '0' && is_active != '1') {
            $('#productDetail').html('is_active can only be 0 or 1');
            return false;
        }

        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            data: '_token = <?php echo csrf_token() ?>',
            success: function (result) {
                $('#productDetail').html('');
                if(result.status == 1) {
                    var html = '', status = 'In-active', data = result.data;
                    data.forEach(function (product) {
                        if(product.is_active == 1) {
                            status = 'Active';
                        }
                        html += '<div class="card" style="margin: 10px">';
                        html += '<div class="card-body">';
                        html += '<h5 class="card-title">' + product.name + '</h5>';
                        html += '<h6 class="card-subtitle mb-2 text-muted">' + product.sku + '</h6>';
                        html += '<p class="card-text">' + product.description + '</p>';
                        html += '<p class="card-text"><strong>Price:</strong> ' + product.price + '</p>';
                        html += '<p class="card-text"><strong>Status:</strong> ' + status + '</p>';
                        html += '</div>';
                        html += '</div>';
                    });
                    $('#productDetail').html(html);
                }else{
                    $('#productDetail').html('No product found');
                }
            }
        });
    });
</script>
</body>
</html>
