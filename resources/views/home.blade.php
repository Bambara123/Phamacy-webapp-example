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

    {{-- <div>
        @foreach($prescriptions as $prescription)
        <div>
            <h5>{{$prescription->note}}</h5>
            <p>{{$prescription->address}}</p>
        </div>
        @endforeach
    </div> --}}

    @auth
    

    <div class="container">
        <div class="head-container">

            <div class="topic">
                <h1 class="text-center">Prescriptions</h1>
            </div>
            <div class="icons">

                <button id="icon1" style="background: none; border: none;">
                    <i class="fa fa-bell" style="font-size:30px;color:rgb(165, 195, 250)"></i>
                </button>

                <form action = "/logout" method="post">
                    
                    @csrf
                    <button id="icon1" type="submit" style="background: none; border: none;">
                        <i class="fa fa-sign-out" style="font-size:32px;color:rgb(165, 195, 250)"></i>
                    </button>
                    

                </form>
            </div>
        </div>


        {{-- <h1 class="text-center">Prescriptions</h1>
        <form action = "/logout" method="post">
            @csrf
            <i class="fa fa-sign-out" style="font-size:48px;color:red"></i>
            <button>Logout</button>
        </form> --}}
    
        <div class="row">
    
            <div class="col-sm-6">
                <div class="mx-auto" style="width: 100%;">
                    <div id="carouselExample" class="carousel slide carousel23 p-3" style="width: 100%; height: 400px;">
                        <div class="carousel-inner d-flex align-items-center" style="height: 100%;">
                            <div class="carousel-item active">
                                <img src="/images/ss1.png" class="d-block w-100 h-100 object-fit-cover" alt="Image 1">
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
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="images"  name="images[]" accept="image/*" multiple >
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                   
                </div>
            </div>
    
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
                        var newCarouselItem = $('<div class="carousel-item"><img src="' + e.target.result + '" class="d-block w-100 h-100 object-fit-cover" alt="New Image"></div>');
                        $('.carousel-inner').append(newCarouselItem);
                        if (i === files.length - 1) {
                            newCarouselItem.addClass('active');
                        }
                    };
                    reader.readAsDataURL(files[i]);
                }

                console.log(files.length);

            });

    });
    
    </script>

    @else  
    <form action="/register" method="post">

        @csrf
        <input type="text" placeholder="name" name="name">
        <input type="text" placeholder="email" name="email">
        <input type="password" placeholder="password" name="password">

        <button type="submit">Register</button>

    </form>  


    <form action="/login" method="post">

        @csrf
        <input type="text" placeholder="email" name="loginemail">
        <input type="password" placeholder="password" name="loginpassword">
        <button type="submit">Log in</button>

    </form> 

    @endauth

</body>

</html>