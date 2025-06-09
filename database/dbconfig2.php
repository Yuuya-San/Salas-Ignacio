

<?php
	try {

    // Check if the server is running on localhost
    if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_ADDR'] === '127.0.0.1') {
        // Localhost connection
        $pdoConnect = new PDO("mysql:host=localhost;dbname=magrent", "root", "");
    } else {
        // Live server connection
        $pdoConnect = new PDO("mysql:host=localhost;dbname=u297724503_magrent_2023", "u297724503_magrent_2023", "Magrent_2023");
    }
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