<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/home.css">


</head>
<body>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    
    <div class="container">
        <div class="form-container" id = "login">
            <form>
                <h2 class="text-center">Login</h2>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <p class="mb-0 me-2">Don't have an account?</p>
                    <a href="register.html" class="link-primary" id="showRegisterForm">Register</a>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary mx-auto">Submit</button>
                </div>
            </form>
        </div>


        <div class="form-container" id = "register">
            <form>
                <h2 class="text-center">Register</h2>
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="exampleInputName">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputContactNumber" class="form-label">Contact Number</label>
                    <input type="tel" class="form-control" id="exampleInputContactNumber">
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <p class="mb-0 me-2">Already have an account?</p>
                    <a href="register.html" class="link-primary" id="showLoginForm">Login</a>
                </div>


                <div class="d-grid">
                    <button type="submit" class="btn btn-primary mx-auto">Submit</button>
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
  

</body>
</html>