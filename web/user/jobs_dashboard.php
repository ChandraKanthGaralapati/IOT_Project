<?php  session_start();?>
<!DOCTYPE html>
<?php include "../script/connection.php";?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Styles -->
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <!-- Custom -->
        <link rel="stylesheet" href="../style/user_style.css">

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

        <title>Jobs Applied</title>
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
                        <a href="./dashboard.php">Home</a>
                    </li>
                    <li>
                        <a class='active' href="./jobs_dashboard.php">Jobs Applied</a>
                    </li>
                    <li>
                        <a href="../index.php">Logout</a>
                    </li>
                </ul>
            </nav>

            <!-- Page Content  -->
            <div id="content">
                <table class="table table-striped table-hover" aria-label="Table to show list of jobs applied">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Company</th>
                            <th scope="col">Experience</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                            // echo session_id();
                            // print_r($_SESSION);
                            $email = $_SESSION['email'];
                            $name = '';
                            
                            $s = "SELECT `Name` FROM users WHERE email='$email'";
                            $r = mysqli_query($conn,$s);

                            if($r->num_rows > 0)
                            {
                                $rows=$r->fetch_assoc();
                                $name = $rows['Name'];
                            }
                            
                            $sql = "SELECT `name`, cname, position, experience FROM applications WHERE `name`='$name'";
                            $result = mysqli_query($conn,$sql);
                            $i=0;

                            if($result->num_rows > 0)
                            {
                                while($rows=$result->fetch_assoc()){
                                    echo"<tr>
                                    <td>".++$i."</td>
                                    <td>".$rows['name']."</td>
                                    <td>".$rows['position']."</td>
                                    <td>".$rows['cname']."</td>
                                    <td>".$rows['experience']."</td>
                                    </tr>";
                                }

                            }
                            mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                });
            });
        </script>
    </body>
</html>