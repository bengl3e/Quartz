<?php	if ( !isset($_SESSION['usertype']) )    	session_start();?><! DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html>    <head>        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        <link rel="stylesheet" type="text/css" href="Style.css" />    </head>    <body bgcolor="#EEEEEE">        <?php        	include 'dbvars.php';                    if (isset($_GET['logout']) && $_GET['logout'] == 1)             { // [LOGOUT.0001]\                $_SESSION['usertype'] = 0;                session_destroy();            }            if (isset($_POST['submit'])) // [LOGIN.0005]            {                if (!$_POST['User'] | !$_POST['Pass']) // [LOGIN.0004]                {                      $_SESSION['nologin'] = 1;                }                else                {                    mysql_connect($serverurl, $adminname, $adminp) or die(mysql_error("could not connect to database server"));                    mysql_select_db($dbname) or die(mysql_error("could not select database"));                    $email = $_POST['User'];                    $pass = md5($_POST['Pass']);                    $check = mysql_query("SELECT * FROM nLogin WHERE email = '". $_POST['User']. "'")or die(mysql_error()); // [LOGIN.0001]                    $info = mysql_fetch_array( $check );                                        if ($pass == $info['password'] && $info['isactive'] >= 1)                    {                        $_SESSION['name'] = $info['name'];                        $_SESSION['email'] = $info['email'];                        $_SESSION['buid'] = $info['buid'];                        $_SESSION['usertype'] = $info['isactive']; // [LOGIN.0006]                        $_SESSION['nologin'] = 0;                    }                    else                    {                        $_SESSION['nologin'] = 1;                    }                }            }			$thisfilename = "index.php";            include 'header.php';			$not_logged_in = !isset($_SESSION['usertype']) || (isset($_SESSION['usertype']) && $_SESSION['usertype'] == 0);            if ($not_logged_in)                 include 'login.php'; // [LOGIN.0001]            else	            include 'manage.php'; // [LOGIN.0003]	                           include 'footer.php';        ?>    </body></html>