<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
<nav aria-label="breadcrumb">
        <ol class="breadcrumb m-2">
            <li class="breadcrumb-item"><a href="../../../menu.html">Menú</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ejercicio 3</li>
        </ol>
    </nav>
<div class="container">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-5">Login Form</h2>
        <div class="card my-5">
          <form class="card-body cardbody-color p-lg-5" method="post" action="./Action/action.php" id="form">
            <div class="mb-3">
              <input type="text" class="form-control" id="user" aria-describedby="emailHelp"
                placeholder="User Name" name="user">
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" id="password" placeholder="password" name="password" id="password">
            </div>
            <div class="text-center"><button type="submit" class="btn btn-success px-5 mb-5 w-100">Login</button></div>
            <p id="error"></p>
          </form>
        </div>
      </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../Utils/validaciones.js"></script>
</body>
</html>