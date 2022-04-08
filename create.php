<?php
include 'partials/header.php';
require __DIR__ . '/users/users.php';


$user = [
    'id' => '',
    'firstName' => '',
    'lastName' => '',
    'email' => '',
    'password' => '',
    'clearanceLevel' => '',
];

$errors = [
    'firstName' => "",
    'lastName' => "",
    'email' => "",
    'password' => "",
    'clearanceLevel' => "",
];
$isValid = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = array_merge($user, $_POST);

    $isValid = validateUser($user, $errors);

    if ($isValid) {
        $user = createUser($_POST);

        header("Location: index.php");
    }
}

?>

<?php include '_form.php' ?>

