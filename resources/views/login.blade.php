<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @vite(['resources/css/app.css'])
    
</head>

<body>
    <div class="container vh-100 d-flex align-items-center">
        <div class="row justify-content-end w-100">
            <div class="col-12 col-lg-6">
                <div class="card p-4">
                    <img style="width: 150px; height: 170px;" src="{{ asset('images/LOGO-DARk.png') }}" alt="logo">
                    <h3 class="text-center mb-3">Login</h3>
                    <input type="text" class="form-control mb-3" placeholder="Username">
                    <input type="password" class="form-control mb-3" placeholder="Password">
                    <button class="btn btn-primary w-100">Login</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>