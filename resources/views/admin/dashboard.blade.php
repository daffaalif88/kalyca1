<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    @include('layout.sidebar')

    <!-- Konten yang akan berubah -->
    <div class="p-4 flex-grow-1" style="margin-left: 250px">
        @include('layout.nav')

        <div id="content">
            @yield('content')
        </div>
    </div>
</div>

<script>
<script>
$(document).ready(function(){
    $(".load-page").click(function(e){
        e.preventDefault();
        var url = $(this).attr("href");

        // Ubah URL di address bar tanpa reload
        history.pushState(null, '', url);

        $.get(url, function(data){
            $("#content").html($(data).find("#content").html());
            
            // Perbarui class active pada sidebar
            $(".load-page").removeClass("active bg-primary");
            $('a[href="' + url + '"]').addClass("active bg-primary");
        });
    });

    // Tangani navigasi menggunakan tombol 'Back' atau 'Forward' di browser
    window.onpopstate = function() {
        var url = window.location.pathname;
        $.get(url, function(data){
            $("#content").html($(data).find("#content").html());

            // Perbarui class active pada sidebar
            $(".load-page").removeClass("active bg-primary");
            $('a[href="' + url + '"]').addClass("active bg-primary");
        });
    };
});
</script>

</script>

</body>
</html>
