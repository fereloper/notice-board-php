<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <title>Notice Board</title>
</head>
<body>


<div class="container pt-5">
    <div class="row">
        <div class="col-md-12 mb-3">
            <h1>Notices</h1>
        </div>
        <div class="col-md-8">
            <ul id="notices" class="list-group">
            </ul>
        </div>
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
    var timeout = 1000;

    // this method contain your ajax request
    function ajaxRequest() {
        $.ajax({
            url: "/action.php?type=get_notices",
            dataType: 'json'
        }).done(function(data) {
            $('#notices').html('');
            for (var row of data) {
                $('#notices').append('<li class="list-group-item"><h2>' + row.title + '</h2><div>' + row.description+ '</div></li>');
            }
        });
    }
    
    (function() {
        setInterval(ajaxRequest, timeout);
    })();
</script>

</body>
</html>
