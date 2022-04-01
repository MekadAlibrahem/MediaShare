<?php
session_start() ;
include_once "../class.User.php" ;
use MediaShare\Users\User;
use MediaShare\Users\Visitor;

    $isCreat  = Visitor::createNewAccount($_POST['username'] , $_POST['email'] , $_POST['password'] , $_POST['password']);
    if($isCreat === true){
        $user = User::logIn($_POST['username'] , $_POST['password']);
        if($user instanceof  User  ){
            $href = User::PUBLICPATH . '/user_homePage.php' ;
            $_SESSION['type'] = User::getTypeUserByUserName($user->getUserName());
            $_SESSION['username'] = $user->getUserName() ;
            $_SESSION['userid'] = $user->getUserID() ;
            $_SESSION['email'] = $user->getEmail();
            echo json_encode(array("status" => true , "href" => $href ));
        }
    }else{
        echo json_encode(array("status" => false , "error" => $isCreat ));
    }



?>