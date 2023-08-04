<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Observer Design Pattern</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row offset-md-4 col-md-4 bg-light border-radius mt-5 p-2">
            <h2 class="d-block m-auto text-color"><b>Observer Design Pattern</b></h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="height-auto">
                    <h1 class="text-color" style="font-family: 'Bebas Neue', sans-serif;">Number System</h1>
                    <form method="post" action="javascript:void(0)">
                        <div class="form-group">
                            <label for="title">Enter the Number:</label>
                            <input type="text" name="input" id="input" class="form-control" pattern="^[0-9]+$" title="Please enter only digit numbers." required>
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="height-auto">
                    <h1 class="text-center text-color" style="font-family: 'Bebas Neue', sans-serif;">Number System RESULT</h1>
                    <div class='bookshelf'>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Hexa-decimal Number</th>
                                    <th scope="col" class="text-center">Octal Number</th>
                                    <th scope="col" class="text-center">Binary Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center" colspan="3">No Number Found</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('input', 'input[name="input"]', function() {
                $('tbody tr').empty();
                $('tbody tr').append('<td class="text-center" colspan="3">No Number Found</td>');
            });

            $(document).on('submit', 'form', function(e) {
                $.ajax({
                    type: "POST",
                    url: "response.php",
                    data: {
                        input: $('input[name="input"]').val()
                    },
                    success: function(response) {
                        $('tbody tr').empty();
                        $('tbody tr').append(response);
                    }
                })
            });
        });
    </script>
</body>

</html>