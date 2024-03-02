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

</head>
<body>
    <div class="container mt-5">

        <div class="topic">
            <h1>Make Quotetion</h1>
        </div>

        <div class="row">


            <div class="col-sm-5 image-show d-flex flex-column align-items-center pt-4 pb-4">
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
            <div class="card">
                <div class="card-body">
                  
                    <div class="row mb-3">
                        <div class="col-5"><strong>Drug</strong></div>
                        <div class="col-4" ><strong>Quantity</strong></div>
                        <div class="col-3 text-end"><strong>Amount</strong></div>
                    </div>

                    <div class="row mb-4 ">
                        <div class="col-5 drug" >MiDLMFDSF</div>
                        <div class="col-4 quantity" >343SDV</div>
                        <div class="col-3 text-end total_price_1">200 LKR</div>
                    </div>

                    <div class="d-flex flex-row justify-content-between">
                        <p class="font-weight-bold">Total Price</p>
                        <p id="total_price">0 LKR</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <form>
                    <div class="mb-3 row">
                        <label for="drug" class="col-sm-4 col-form-label">Drug</label>
                        <div class="col-sm-6 ms-auto">
                            <input type="text" class="form-control" id="drug" placeholder="Enter drug name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="quantity" class="col-sm-4 col-form-label">Quantity</label>
                        <div class="col-sm-6 ms-auto">
                            <input type="number" class="form-control" id="quantity" placeholder="Enter quantity">
                        </div>
                    </div>
                    <button type="submit"  id="add-button" class="btn btn-primary ms-auto">Add</button>
                </form>
            </div> 
     
        </div>  
        </div>

        <script>    
        
            var drugValues = {
                'Drug1': 100, 
                'Drug2': 200,
                
            };

            document.getElementById('add-button').addEventListener('click', function(event) {
            event.preventDefault();

            var drug = document.getElementById('drug').value;
            var quantity = parseInt(document.getElementById('quantity').value);
            var amount = drugValues[drug] * quantity;  // Replace this with your amount calculation

            var cardBody = document.querySelector('.card-body');

            var newRow = document.createElement('div');
            newRow.classList.add('row', 'mb-4');

            var drugCol = document.createElement('div');
            drugCol.classList.add('col-5');
            drugCol.classList.add('drug');
            drugCol.textContent = drug;

            var quantityCol = document.createElement('div');
            quantityCol.classList.add('col-4');
            quantityCol.classList.add('quantity');
            quantityCol.textContent = quantity;

            var amountCol = document.createElement('div');
            amountCol.classList.add('col-3', 'text-end',  'total_price_1');
            amountCol.textContent = amount + ' LKR';

            newRow.appendChild(drugCol);
            newRow.appendChild(quantityCol);
            newRow.appendChild(amountCol);

            cardBody.insertBefore(newRow, cardBody.querySelector('.d-flex'));

            var p = document.getElementById('total_price'); 
            var text = p.textContent;
            var total = parseInt(text.replace(' LKR', ''));
            total += amount;

            p.textContent = total + ' LKR';

            var total_price_input = document.getElementById('total_price_input');
            total_price_input.value = total;


        });
                
        </script>

        <div class="row line mt-4">
        </div>

        <form id="quotation-form" action="/updatePrescriptions" method="POST">

            @csrf
            <input type="hidden" id="total_price_input" name="total_price">
            <input type="hidden" name="prescription_id" value="{{ $prescription->id }}">
            <div class="row d-flex justify-content-end">
                <div class="col-3 d-flex justify-content-end">
                    <button type="submit" id="submit-button" class="btn btn-primary mt-1 mb-4">Submit</button>
                </div>
                
            </div>

        </form>

        <script>document.getElementById('submit-button').addEventListener('click', function(event) {
            event.preventDefault();
        
            var drugElements = document.getElementsByClassName('drug');
            var quantityElements = document.getElementsByClassName('quantity');
            var total_price_1s = document.getElementsByClassName('total_price_1');
        
            var medicines = [];
        
            for (var i = 0; i < drugElements.length; i++) {
                var drug = drugElements[i].textContent;
                var quantity = quantityElements[i].textContent;
                var total_price_1 = total_price_1s[i].textContent;

                console.log(drug, quantity, total_price_1);
        
                medicines.push({
                    name: drug,
                    quantity: quantity,
                    total_price : total_price_1
                });
            }
        
            var requestBody = {
                prescription_id: "{{ $prescription->id }}",
                total_price: document.getElementById('total_price_input').value,
                medicines: medicines
            };

            console.log(requestBody);
        
            fetch('/createDrugs', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    // Add Laravel CSRF token header
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(requestBody)
            }).then(response => {
                if (response.ok) {
                    // Handle successful submission
                    console.log('Submission successful');
                } else {
                    // Handle errors
                    console.log('Submission failed');
                }
            });
        });

        </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
    