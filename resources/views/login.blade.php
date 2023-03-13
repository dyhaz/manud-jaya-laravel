<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
<div class="container mt-5">
    <h1>Login</h1>
    <form id="login-form">
        @csrf
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <div id="message"></div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#login-form').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ url('/api/login') }}",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function(data) {
                    $('#message').html('<div class="alert alert-success">'+data.message+'</div>');
                    window.location.href = "{{ url('/') }}";
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    $('#message').html('<div class="alert alert-danger">'+err.error+'</div>');
                }
            });
        });
    });
</script>
</body>
</html>
