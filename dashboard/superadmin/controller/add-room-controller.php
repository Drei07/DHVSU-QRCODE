    <?php
    include_once '../../../database/dbconfig2.php';
    require_once '../authentication/superadmin-class.php';


    $superadmin_home = new SUPERADMIN();

    if(!$superadmin_home->is_logged_in())
    {
    $superadmin_home->redirect('');
    }


    if(isset($_POST['btn-register'])) {

        $Location                      = trim($_POST['room']);

        $pdoQuery = "SELECT * FROM location WHERE location_name = :name LIMIT 1";
        $pdoResult = $pdoConnect->prepare($pdoQuery);
        $pdoExec = $pdoResult->execute(array(":name" => $Location));
        $location_name = $pdoResult->fetch(PDO::FETCH_ASSOC);

        if($pdoResult->rowCount() > 0)
        {
            $_SESSION['status_title'] = "Oops!";
            $_SESSION['status'] = "Room is already added!";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_timer'] = 100000;
            header('Location: ../add-room');
        }
        else
        {

        $pdoQuery = "INSERT INTO location (location_name) VALUES (:location_name)";
        $pdoResult1 = $pdoConnect->prepare($pdoQuery);
        $pdoExec = $pdoResult1->execute
        (
            array
            ( 
                ":location_name"                =>$Location,

            )
        );

        $_SESSION['status_title'] = "Success!";
        $_SESSION['status'] = "Room is successfully added!";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_timer'] = 40000;
        header('Location: ../add-room');
        }
    }
    else
    {
        $_SESSION['status_title'] = "Oops!";
        $_SESSION['status'] = "Something went wrong, please try again!";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_timer'] = 100000;
        header('Location: ../add-room');

    }

    ?>