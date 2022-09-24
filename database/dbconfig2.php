<?php
	try {
		$pdoConnect = new PDO("mysql:host=localhost;dbname=u867039073_dhvsu_qrcode", "u867039073_qtracker", "Andrei12");
		$pdoConnect->setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);

	}
	catch (PDOException $exc){
		echo $exc -> getMessage();
	}
    catch (PDOException $exc){
        echo $exc -> getMessage();
    exit();
    }
?>