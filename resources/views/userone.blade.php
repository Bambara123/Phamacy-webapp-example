<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Image Viewer</title>
    <!-- Bootstrap CSS -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/onepres.css" rel= "stylesheet">
    <link href="/css/userone.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <div class="container mt-5">
        <div class="head-container">
            <div class="topic">
                <h1 class="text-center">Prescription Status</h1>
            </div>
            <div class="icons">


                {{-- head section --}}

                <a href="/">
                    <button id="icon1" style="background: none; border: none;">
                        <i class="fa fa-home" style="font-size:30px;color:rgb(165, 195, 250)"></i>
                        
                    </button>
                </a>
                <form action = "/logout" method="post">
                    
                    @csrf
                    <button id="icon1" type="submit" style="background: none; border: none;">
                        <i class="fa fa-sign-out" style="font-size:32px;color:rgb(165, 195, 250)"></i>
                    </button>
                    

                </form>
                
            </div>
        </div>

        <div class="row">

            {{-- image preview for user --}}


            <div class="col-sm-5 image-show d-flex flex-column align-items-center pt-4 pb-4 mt-sm-0">
                <div class="row d-flex flex-column align-items-center">
                    <div class="col-10">
                        <div class="card mb-4 main-image-container" style="width: 100%; height: 300px; overflow: hidden;">
                            @if ($prescription->images)
                                <img src="{{ asset('images/' . $prescription->images[0]->name) }}" class="card-img-top main-image" alt="Large Image" style="object-fit: cover; width: 100%; height: 100%;">
                            @endif
                        </div>
                    </div>  
                </div>
            
                <div class="row d-flex justify-content-center">
                    @if ($prescription->images)
                        @foreach ($prescription->images as $image)
                            <div class="col-2">
                                <img src="{{ asset('images/' . $image->name) }}" class="img-thumbnail thumbnail" alt="Thumbnail" style="object-fit: cover; width: 100%; height: 100%;">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <script>
                document.querySelectorAll('.thumbnail').forEach(function(thumbnail) {
                    thumbnail.addEventListener('click', function() {
                        document.querySelector('.main-image').src = thumbnail.src;
                    });
                });

                var mainImage = document.querySelector('.main-image');
                mainImage.addEventListener('mouseover', function() {
           
       
                    mainImage.style.zIndex = '3';
                });
                mainImage.addEventListener('mouseout', function() {
                    mainImage.style.transform = 'scale(1)';
                });
            </script>

        {{-- card element --}}


        <div class="col-sm-7 details mt-4 mt-sm-0">
            <div class="card card-comp">
                <div class="card-body">
                  
                    <div class="row mb-3">
                        <div class="col-5"><strong>Drug</strong></div>
                        <div class="col-4" ><strong>Quantity</strong></div>
                        <div class="col-3 text-end"><strong>Amount</strong></div>
                    </div>

                    @foreach($medicines as $medicine)
                        <div class="row mb-3">
                            <div class="col-5">{{ $medicine->drug_name }}</div>
                            <div class="col-4">{{ $medicine->amount}}</div>
                            <div class="col-3 text-end">{{ $medicine->total_price }}</div>
                        </div>
                    @endforeach

                    
                </div>
            </div>

            {{-- quotation detaials --}}
            <div class="d-flex flex-row justify-content-between">
                <p class="font-weight-bold">Total Price</p>
                <p id="total_price">{{$prescription->total_price}}</p>
            </div>

            <div class="d-flex flex-row justify-content-between">
                <p class="font-weight-bold">Address</p>
                <p id="total_price">{{$prescription->address}}</p>
            </div>

            <div class="d-flex flex-row justify-content-between">
                <p class="font-weight-bold">Note</p>
                <p id="total_price">{{$prescription->note}}</p>
            </div>

     
        </div>  
        </div>

        <div class="row line mt-4">
        </div>

        {{-- buttons for accept and reject --}}
        
            <div class="row d-flex justify-content-end">
                <div class="col-sm-4 d-flex justify-content-between">

                    <form action="/reject/{{$prescription->id}}" method="POST">
                        @csrf
                        <button type="submit" id="submit-button" class="btn btn-outline-danger  mt-1 mb-4">Reject Quotation</button>
                    </form>

                    <form action="/accept/{{$prescription->id}}" method="POST">
                        @csrf
                        <button type="submit" id="submit-button" class="btn btn-outline-primary mt-1 mb-4 ">Accpet Quotation</button>
                    </form> 
                    

                              
                </div>    


        </form>

     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
    