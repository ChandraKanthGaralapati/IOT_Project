<?php  session_start();?>
<!DOCTYPE html>
<?php include "../script/connection.php";?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Styles -->
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Custom -->
        <link rel="stylesheet" href="../style/user_style.css">

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

        <title>Career</title>
    </head>
    
    <body>
        <div class="wrapper">
            <!-- Navigation Bar -->
            <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark" aria-label="Navigation Bar">
                <div class="container-fluid">
                    <a class="navbar-brand"  aria-current="page" href="./dashboard.php">User Portal</a>
                    <button class="btn btn-info" id="sidebarCollapse" type="button">
                        <em class="fas fa-align-left"></em>
                    </button>
                </div>
            </nav>

            <!-- Sidebar  -->
            <nav id="sidebar" aria-label="SideBar">
                <div class="sidebar-header">
                    <em class="fas fa-user"></em>
                </div>

                <ul class="list-unstyled components">
                    <li>
                        <a class='active' href="./dashboard.php">Home</a>
                    </li>
                    <li>
                        <a href="./jobs_dashboard.php">Jobs Applied</a>
                    </li>
                    <li>
                        <a href="../index.php">Logout</a>
                    </li>
                </ul>
            </nav>

            <!-- Page Content  -->
            <div id="content">
                <div class="row align-items-md-stretch">
                    <?php 

                        $sql = "SELECT * FROM `jobs`";
                        $result = mysqli_query($conn,$sql);
                        $i=0;
                        if($result->num_rows > 0)
                        {
                            while($rows=$result->fetch_assoc()){
                                $i++;
                                $class = '';
                                $outline = '';
                                if( $i % 2 == 0){
                                    $class = 'bg-light';
                                    $outline = 'secondary';
                                }
                                if( $i % 2 == 1){
                                    $class = 'text-white bg-dark';
                                    $outline = 'light';
                                }
                                echo'
                                <div class="col-md-4">
                                    <div class="h-auto p-4 ' . $class . ' border rounded-3">
                                        <h2 >'.$rows['cname'].'</h2>
                                        <h7 > Position: '.$rows['position'].' <br/>Vacancies: '.$rows['vacancies'].'</h7>
                                        <br/>
                                        <h7>JD: </h7> <br/><p>'.$rows['job_desc'].'</p>
                                        <h7>CTC: </h7><p>'.$rows['ctc'].'</p>
                                        <h7>Skills: </h7> <p>'.$rows['skills'].'</p>
                                        <button class="btn btn-outline-'.$outline.' type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Apply</button>
                                    </div>
                                    <hr>
                                </div>';
                            }
                        }
                        mysqli_close($conn);

                    ?>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Job Application</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                
                                <div class="modal-body">
                                    <form action="../script/apply_jobU.php" method="POST">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Name:</label>
                                            <input type="text" name="name" class="form-control" id="recipient-name">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="company-name" class="col-form-label">Company Name:</label>
                                            <input type="text" name="cname" class="form-control" id="company-name">
                                        </div>

                                        <div class="mb-3">
                                            <label for="position-text" class="col-form-label">Applying for:</label>
                                            <input type ="text" name="position" class="form-control" id="position-text">
                                        </div>

                                        <div class="mb-3">
                                            <label for="qual-text" class="col-form-label">Qualifications:</label>
                                            <input type ="text" name="qualification" class="form-control" id="qual-text">
                                        </div>

                                        <div class="mb-3">
                                            <label for="year-text" class="col-form-label">Year Pass out:</label>
                                            <input type ="text" name="year_passout" class="form-control" id="year-text">
                                        </div>

                                        <div class="mb-3">
                                            <label for="experience-text" class="col-form-label">Experience:</label>
                                            <input type ="text" name="experience" class="form-control" id="experience-text">
                                        </div>
    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                });
            });
        </script>
    </body>
</html>