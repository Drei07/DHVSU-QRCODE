<?php
include_once '../../database/dbconfig2.php';
require_once 'authentication/user-class.php';
include_once '../superadmin/controller/select-settings-coniguration-controller.php';


$user_home = new USER();

if (!$user_home->is_logged_in()) {
    $user_home->redirect('../../');
}

$stmt = $user_home->runQuery("SELECT * FROM student WHERE userId=:uid");
$stmt->execute(array(":uid" => $_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$UId = $row['userId'];

$pdoQuery = "SELECT * FROM student WHERE userId=$UId";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array());
$user_profile = $pdoResult->fetch(PDO::FETCH_ASSOC);

$studentId                 = $user_profile["studentId"];
$first_name                 = $user_profile["first_name"];
$middle_name                = $user_profile["middle_name"];
$last_name                  = $user_profile["last_name"];
$email                      = $user_profile["email"];
$qrcode                       = $user_profile["qrcode"];
$created_at                 = $user_profile["created_at"];
$updated_at                 = $user_profile["updated_at"];

$profile_user = $user_profile['profile'];
$updated_at  = $user_profile["updated_at"];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../src/img/<?php echo $logo ?>">
    <link rel="stylesheet" href="../../src/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../src/node_modules/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../../src/node_modules/aos/dist/aos.css" />
    <link rel="stylesheet" href="../../src/css/admin.css?v=<?php echo time(); ?>">
    <title>Dashboard</title>
</head>

<body>

    <!-- Loader -->
    <div class="loader"></div>

    <!-- SIDEBAR -->
    <section id="sidebar" class="hide">
        <a href="#" class="brand"><img src="../../src/img/<?php echo $logo ?>" alt="logo" class="brand-img"></i>&nbsp;&nbsp;DHVSU</a>
        <ul class="side-menu">
            <li><a href="home"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
            <li class="divider" data-text="main">Main</li>
            <li><a href="history"><i class='bx bx-history icon'></i> History</a></li>
        </ul>

    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu toggle-sidebar'></i>

            <a href="#" class="nav-link">
                <i class='bx bxs-bell icon'></i>
                <span class="badge">5</span>
            </a>
            <a href="#" class="nav-link">
                <i class='bx bxs-message-square-dots icon'></i>
                <span class="badge">8</span>
            </a>
            <span class="divider"></span>
            <div class="dropdown">
                <span><?php echo $row['last_name']; ?>, <?php echo $row['first_name']; ?></i></span>
            </div>
            <div class="profile">
                <img src="../../src/img/<?php echo $profile_user ?>" alt="">
                <ul class="profile-link">
                    <li><a href="authentication/user-signout" class="btn-signout"><i class='bx bxs-log-out-circle'></i> Signout</a></li>
                </ul>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <h1 class="title">History</h1>
            <ul class="breadcrumbs">
                <li><a href="home">Home</a></li>
                <li class="divider">|</li>
                <li><a href="" class="active">History</a></li>
            </ul>
            <section class="data-table">
                <div class="searchBx">
                    <input type="input" placeholder="search activity" class="search" name="search_box" id="search_box"><button class="searchBtn"><i class="bx bx-search icon"></i></button>
                </div>

                <div class="table">
                    <div id="dynamic_content">
                    </div>

            </section>
        </main>
        <!-- MAIN -->
    </section>
    <!-- END NAVBAR -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script src="../../src/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../src/js/countrySelect.min.js"></script>
    <script src="../../src/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../../src/js/dashboard.js"></script>
    <script src="../../src/js/qrcode.js"></script>
    <script src="../../src/js/loader.js"></script>

    <script>
        // Signout
        $('.btn-signout').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')

            swal({
                    title: "Signout?",
                    text: "Are you sure do you want to signout?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willSignout) => {
                    if (willSignout) {
                        document.location.href = href;
                    }
                });
        })


        //live search---------------------------------------------------------------------------------------//
        $(document).ready(function() {

            load_data(1);

            function load_data(page, query = '') {
                $.ajax({
                    url: "data-table/students-history-data-table.php",
                    method: "POST",
                    data: {
                        page: page,
                        query: query
                    },
                    success: function(data) {
                        $('#dynamic_content').html(data);
                    }
                });
            }

            $(document).on('click', '.page-link', function() {
                var page = $(this).data('page_number');
                var query = $('#search_box').val();
                load_data(page, query);
            });

            $('#search_box').keyup(function() {
                var query = $('#search_box').val();
                load_data(1, query);
            });

        });
    </script>

    <!-- SWEET ALERT -->
    <?php

    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status_title']; ?>",
                text: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['status_code']; ?>",
                button: false,
                timer: <?php echo $_SESSION['status_timer']; ?>,
            });
        </script>
    <?php
        unset($_SESSION['status']);
    }
    ?>
</body>

</html>