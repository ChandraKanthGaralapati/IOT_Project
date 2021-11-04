<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Styles -->
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Custom -->
        <link rel='stylesheet' href="#./style/home.css">

        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/footers/">

        <title>Home</title>
    </head>

    <body class="bg-image d-flex h-100 text-center text-white bg-dark" style=" background-image: url(./images/home.jpg); background-size: cover">
    
        <div class="cover-container d-flex  p-3 mx-auto flex-column-expand">
            <header class="mb-auto">
                <div>
                    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
                        <div class="container-fluid">
                            <a class="navbar-brand"  aria-current="page" href="index.php">Job Portal</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <div class="navbar-nav">
                                    <a class="nav-link" href="login.php">Login</a>
                                    <a class="nav-link" href="register.php">Register</a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>

            <main class="px-3">
                <h1 class='text-dark' style="padding-top: 9em;">Job Portal</h1>
            </main>
        </div>

        <div class="container fixed-bottom bg-dark">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-4 d-flex align-items-center">
                    <span class="text-muted">© 2021 Company, Inc</span>
                </div>

                <div class='md-3'>
                    <ul class="nav justify-content-end tedt-white bg-dark">
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.linkedin.com/in/gck31">Linkedin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://github.com/ChandraKanthGaralapati">GitHub</a>
                        </li>
                    </ul>
                </div>
            </footer>
        </div>

        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>