<?php
include_once 'Manager.php';

$manager = new Manager();
session_start();

if ($_REQUEST['type'] === 'login') {
    
    if ($manager->loginCheck($_REQUEST['email'], $_REQUEST['password'])) {
        $_SESSION["loggedin"] = true;
        header("location: adminaddstory.php");
    } else {
        $_SESSION['error_message'] = 'Invalid credentials.';
        header("location: login.php");
    }
}

else if ($_REQUEST['type'] === 'add_notice') {
    if ($manager->addNotice($_REQUEST['title'], $_REQUEST['notice'])) {
        $_SESSION['success_message'] = 'A notice has been published.';
    } else {
        $_SESSION['error_message'] = 'Notice can not be created.';
    }
    header("location: adminaddstory.php");
}

else if ($_REQUEST['type'] === 'get_notices') {
    $notices = $manager->getNotices();
    header('Content-type: application/json');
    echo json_encode($notices);
}
