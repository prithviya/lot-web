<?php
    $today_date = '';
    $date_error = '';
    $response_array = [];
    /* Request section */
    if (($_SERVER['REQUEST_METHOD']) == 'POST') {
        $con = mysqli_connect('localhost', 'root', '','lot');
        // if($con) {
        //     echo 'connected successfully';
        // } else {
        //     echo 'connected failed';
        // }
        $today_date = (isset($_POST['today_date']) && !empty($_POST['today_date']))? $_POST['today_date'] : '';
        
        if (date("Y-m-d") != $today_date) {
            $date_error = 'invalid date! Please enter Today date!';
        } else {
            $select_query = "SELECT * FROM lott WHERE lotdate = '$today_date'";
            $result = mysqli_query($con, $select_query);
            
            if ($result->num_rows > 0) {
                $response_array = $result->fetch_all(MYSQLI_ASSOC);
            } 
        }
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Malapuram Lots
    </title>
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</head>
<body>
    <div class="gs-navbar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                   <img src="./assets/Malapuram Png.png" alt="" style="max-width: 150px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                </ul>
                <form class="d-flex">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Result</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Contact</a>
                    </li>
                </ul>
                </form>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 text-center content-bg">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="calendar-selector m-3">
                            <input type="date" name="today_date" class="date-selector">
                            <p class="text-danger"><?php echo $date_error; ?></p>
                        </div>
                        <button class="btn-25">
                            <span>
                                Submit
                            </span>
                        </button>
                    </form>
                    <!-- <h2 class="text-white p-2">
                        Draw No : 
                    </h2> -->
                    <h2 class="text-white pb-3">
                        Platinum Date : <?php echo (isset($response_array[0]['lotdate']) && !empty($response_array[0]['lotdate']))? $response_array[0]['lotdate'] : '-'; ?>
                    </h2>                    
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-6 mt-3">
                    <div style="overflow-x:auto;">
                        <table class="table table-striped table-dark table-bordered">
                            <thead>
                              <tr>
                              <th scope="row">Time</th>
                                <td>11.30 Am</td>
                                <td>01.30 Pm</td>
                                <td>06.30 Pm</td>
                              </tr>
                            </thead>
                            <tbody>
                                <?php if (count($response_array) > 0) { ?>
                                    <tr>
                                        <th scope="row">Draw No</th>
                                        <td><?php echo (isset($response_array[0]['drawno']) && !empty($response_array[0]['drawno']))? $response_array[0]['drawno'] : '-'; ?></td>
                                        <td><?php echo (isset($response_array[1]['drawno']) && !empty($response_array[1]['drawno']))? $response_array[1]['drawno'] : '-'; ?></td>
                                        <td><?php echo (isset($response_array[2]['drawno']) && !empty($response_array[2]['drawno']))? $response_array[2]['drawno'] : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1 Price</th>
                                        <td><?php echo (isset($response_array[0]['fstprice']) && !empty($response_array[0]['fstprice']))? $response_array[0]['fstprice'] : '-'; ?></td>
                                        <td><?php echo (isset($response_array[1]['fstprice']) && !empty($response_array[1]['fstprice']))? $response_array[1]['fstprice'] : '-'; ?></td>
                                        <td><?php echo (isset($response_array[2]['fstprice']) && !empty($response_array[2]['fstprice']))? $response_array[2]['fstprice'] : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2 Price</th>
                                        <td><?php echo (isset($response_array[0]['secprice']) && !empty($response_array[0]['secprice']))? $response_array[0]['secprice'] : '-'; ?></td>
                                        <td><?php echo (isset($response_array[1]['secprice']) && !empty($response_array[1]['secprice']))? $response_array[1]['secprice'] : '-'; ?></td>
                                        <td><?php echo (isset($response_array[2]['secprice']) && !empty($response_array[2]['secprice']))? $response_array[2]['secprice'] : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3 Price</th>
                                        <td><?php echo (isset($response_array[0]['thiprice']) && !empty($response_array[0]['thiprice']))? $response_array[0]['thiprice'] : '-'; ?></td>
                                        <td><?php echo (isset($response_array[1]['thiprice']) && !empty($response_array[1]['thiprice']))? $response_array[1]['thiprice'] : '-'; ?></td>
                                        <td><?php echo (isset($response_array[2]['thiprice']) && !empty($response_array[2]['thiprice']))? $response_array[2]['thiprice'] : '-'; ?></td>
                                    </tr>
                                <?php } else { ?>
                                    <tr rowspan="3">
                                        <th rowspan="3"></th>
                                        <td></td>
                                        <td>No data found!</td>
                                        <td></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                          </table>
                      </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>