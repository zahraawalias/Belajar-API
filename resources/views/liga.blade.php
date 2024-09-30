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
                <div class="row">
                    @foreach ($data['data'] as $item)
                        <div class="col-md-3">
                            <div class="card rounded shadow-sm p-2 mb-3">
                                <div class="d-flex">
                                    <img src="{{ $item['team_logo'] }}" width="50" alt="">
                                    <div class="title">
                                        <h4>Nama Team</h4>
                                        <p>{{ $item['team_name'] }}</p>
                                        <p>{{ $item['team_venue'] }}</p>
                                    </div>
                                </div>

                                <hr>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-primary" id="getDetail"
                                        data-id="{{ $item['team_id'] }}">
                                        Detail Teams
                                    </button>
                                    <a href="{{ route('players', $item['team_id']) }}" class="btn btn-danger">Liat Pemain</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        <!-- Modal -->
        <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Detail Teams</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Team Name</td>
                                    <td>:</td>
                                    <td id="team_name"></td>
                                </tr>
                                <tr>
                                    <td>Team Founded</td>
                                    <td>:</td>
                                    <td id="team_founded"></td>
                                </tr>
                                <tr>
                                    <td>Team Vanue</td>
                                    <td>:</td>
                                    <td id="team_venue"></td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>:</td>
                                    <td id="description"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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

                            var team_name = $('#team_name').text(data.data.team_name);
                            var team_name = $('#team_founded').text(data.data.team_founded);
                            var team_name = $('#team_venue').text(data.data.team_venue);
                            var team_name = $('#description').text(data.data.description);
                        } else {
                            alert('Data Error :)');
                        }

                    });
                });
            });
        </script>
</body>

</html>