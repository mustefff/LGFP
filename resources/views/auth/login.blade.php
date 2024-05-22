<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Vos balises meta et liens ici -->
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Riho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Riho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Connectez-vous à votre compte</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fetch/3.6.2/fetch.min.js"></script>
    <style>
      

        .login-card {
           
            
           
            
             
        }

        .login-card .logo img {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .login-card h4 {
            color: #333;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }

        .login-card p {
            color: #666;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group label {
            color: #333;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #28a745;
            color: #FFF;
            padding: 10px;
            border: none;
          
            cursor: pointer;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0"">
        <div class="row m-0">
            <div class="col-12 p-0">    
                <div class="login-card login-dark ">
                    <div>
                        <div class="login-main bg-primary" style="border-radius: 10px 10px 0 0; ">
                            <div class="logo text-center"><a href="index.html"><img class="img-fluid for-dark" src="../assets/images/logo/logo.png" alt="looginpage"><img class="img-fluid for-light" src="../assets/images/logo/logo.png" alt="looginpage"></a></div>
                            <h4 style="color: #FFF;">Connectez-vous à votre compte</h4>
                            <p style="color: #FFF;">Entrez votre adresse E-mail et votre Mot de Passe pour vous connecter</p>
                        </div> 
                        <form class="theme-form" method="POST" id="loginForm" action="{{ route('login.custom') }}" style="background-color: white; border-radius: 0 0 10px 10px; height:340px; padding: 35px; border:1px solid #e4e0e0;">
                            @csrf
                            <!-- Votre formulaire ici -->
                            <div class="form-group">
                                <label class="col-form-label">Adresse E-mail</label>
                                <input class="form-control" type="email" name="email" required="" placeholder="Adresse E-mail">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Mot de Passe</label>
                                <div class="form-input position-relative">
                                    <input class="form-control" type="password" name="password" required="" placeholder="Mot de Passe">
                                    <div class="show-hide"> </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="text-end mt-3">
                                    <button class="btn btn-primary btn-block w-100" type="submit">Connectez-vous</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
          event.preventDefault();

          var form = this;

          fetch(form.action, {
            method: form.method,
            body: new FormData(form),
            headers: {
              'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              Swal.fire(
                'Succès!',
                data.message,
                'success'
              ).then(() => {
                window.location.href = data.redirect;
              });
            } else {
              Swal.fire(
                'Erreur!',
                data.message,
                'error'
              )
            }
          });
        });
    </script>
  </body>
</html>
