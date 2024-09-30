<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liga Team</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <main>
        <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-between">
                <a href="{{ route('liga') }}" class="btn btn-primary">Back</a>
            </div>
            <hr>
                <div class="row">
                    @foreach ($data['data'] as $players)
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <img src="{{ $players['player_photo'] }}" alt="{{ $players['player_name'] }}" class="img-fluid rounded mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                                <h5 class="card-title">{{ $players['player_number'] }} - {{ $players['player_name'] }}</h5>
                                <p class="card-text">{{ $players['position'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
    </main>

        <!-- Script Bootstrap dan JavaScript untuk Mengambil Detail Tim -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
            integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

        <script>
            $(document).ready(function() {
                $(".card #getDetail").click(function() {


                    var id = $(this).attr('data-id');
                    var url = `https://ligaindonesia-api.vercel.app/api/v1/team/profile/${id}`;

                    $.get(url, function(data, status) {

                        if (status == 'success') {
                            var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
                                keyboard: false
                            });
                            myModal.show();

                            var player_number = $('#player_number').text(data.data.player_number);
                            var player_number = $('#player_name').text(data.data.player_name);
                            var player_number = $('#position').text(data.data.[position]);
                        } else {
                            alert('Data Error :)');
                        }

                    });
                });
            });
        </script>
</body>

</html>