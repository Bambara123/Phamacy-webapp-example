<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    @auth
    <div class="container mt-5">
        <div class="head-container">

            <div class="topic">
                <h1 class="text-center">Prescriptions</h1>
            </div>
            <div class="icons">


                <form action = "/logout" method="post">
                    
                    @csrf
                    <button id="icon1" type="submit" style="background: none; border: none;">
                        <i class="fa fa-sign-out" style="font-size:32px;color:rgb(165, 195, 250)"></i>
                    </button>
                    

                </form>
            </div>
        </div>
    
        <div class="row">
    
            <div class="col-sm-6">


                <div class="mx-auto" style="width: 100%;">
                    <div id="carouselExample" class="carousel slide carousel23 p-3" style="width: 100%; height: 400px;">
                        <div class="carousel-inner d-flex align-items-center" style="height: 100%;">
                            <div class="carousel-item active" id="kk">
                                <img src="/images/ee.png" class="d-block" alt="Image 1" style="object-fit: contain">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                
            
            </div>
            <div class="col-sm-6">
                <div class="row mt-3">
                    <div class="col">
                        <form id="imageForm" method="post" action="/createPrescription" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control border" id="address" name="address">
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <textarea class="form-control border" id="note" name="note" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control border" id="images"  name="images[]" accept="image/*" multiple >
                            </div>
                            <button type="submit" class="btn btn-outline-primary mt-2">Submit</button>
                        </form>
                    </div>
                   
                </div>
            </div>
    
        </div>
    
    </div>    
    
    <div class="container mt-5">

        <div class="row">
            @foreach($prescriptions as $prescription)
            <div class="col-md-4">
                <a href="/userone/{{ $prescription->id }}" class="text-decoration-none text-dark">
                    <div class="card mb-4 card-element {{ $prescription->status == 'Accepted' ? 'border-success' : ($prescription->status == 'Rejected' ? 'border-danger' : 'border-primary') }}">
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
    
    <script>
        $(document).ready(function() {
            $('#images').on('change', function() {
                var files = $('#images')[0].files;
                console.log(files);
                if (files.length > 5) {
                    alert('You can only upload a maximum of 5 images');
                    return;
                }
        
                // $('.carousel-inner').empty();
                for (var i = 0; i < files.length; i++) {
                    console.log(files.length, i);
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var newCarouselItem = $('<div class="carousel-item active"><img src="' + e.target.result + '" class="d-block w-100 h-100 object-fit-cover" alt="New Image"></div>');
                        $('.carousel-inner').append(newCarouselItem);
                        if (i === files.length - 1) {
                            newCarouselItem.addClass('active');
                        }
                    };


                    reader.readAsDataURL(files[i]);
                }

                document.getElementById('kk').remove();

                console.log(files.length);

            });

    });
    
    </script>

    @else  

    <div class="container">
        <div class="form-container" id = "login">
            <form action="/login" method="post">

                @csrf
                <h2 class="text-center">Login</h2>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="loginemail" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="loginpassword" id="exampleInputPassword1">
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <p class="mb-0 me-2">Don't have an account?</p>
                    <a href="register.html" class="link-primary" id="showRegisterForm">Register</a>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-primary mx-auto">Submit</button>
                </div>
            </form>
        </div>


        <div class="form-container" id = "register">
            <form action="/register" method="post">
                @csrf
                <h2 class="text-center">Register</h2>
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="exampleInputName" name="name">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <div class="mb-3">
                    <label for="exampleInputContactNumber" class="form-label">Contact Number</label>
                    <input type="tel" class="form-control" id="exampleInputContactNumber">
                </div>
                <div class="mb-3">
                    <label for="exampleInputAddress" class="form-label">Address</label>
                    <input type="text" class="form-control" id="exampleInputContactNumber">
                </div>

                <div class="mb-3">
                    <label for="exampleInputDOB" class="form-label">Date Of Birth</label>
                    <input type="date" class="form-control" id="exampleInputContactNumber">
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <p class="mb-0 me-2">Already have an account?</p>
                    <a href="register.html" class="link-primary" id="showLoginForm">Login</a>
                </div>


                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-primary mx-auto mb-4">Submit</button>
                </div>
            </form>
        </div>

    </div>
        
    {{-- JS for show or hide the register or login --}}

    <script>

    document.getElementById('showRegisterForm').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('login').style.display = 'none';
        document.getElementById('register').style.display = 'block';
    });

    document.getElementById('showLoginForm').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('register').style.display = 'none';
        document.getElementById('login').style.display = 'block';
    });

    </script>
  

    @endauth

</body>

</html>