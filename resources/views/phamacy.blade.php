<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescriptions</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/phamacy.css" rel="stylesheet">

</head>
<body>
    <div class="container mt-5">

        <div class="topic">
            <h1>Prescriptions</h1>
        </div>
        <div class="row">
            @foreach($prescriptions as $prescription)
            <div class="col-md-4">
                <a href="/onepres/{{ $prescription->id }}" class="text-decoration-none text-dark">
                    <div class="card mb-4 border-primary card-element">
                        <div class="card-body">
                            <h5 class="card-title">Prescription ID: {{ $prescription->id }}</h5>
                            <p class="card-text">Status: {{ $prescription->status }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>