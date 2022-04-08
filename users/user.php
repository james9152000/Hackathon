<?php

function getUsers()
{
    return json_decode(file_get_contents(__DIR__ . '/users.json'), true);
}

function getUserById($id)
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return $user;
        }
    }
    return null;
}

function getEmail($id) // getting email 
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['email'] == $id) {
            return $user;
        }
    }
    return null;
}
function getPass($id) // getting password
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['password'] == $id) {
            return $user;
        }
    }
    return null;
}

function getLogin($email, $pass) // getting email and pass
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['password'] == $email && $user['password'] == $email) {
            return $user;
        }
    }
    return null;
}

function createUser($data)
{
    $data['id'] = rand(100000, 200000);
    $users[] = $data;
    $users = getUsers();

    

    putJson($users);

    return $data;
}

function updateUser($data, $id)
{
    $updateUser = [];
    $users = getUsers();
    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            $users[$i] = $updateUser = array_merge($user, $data);
        }
    }

    putJson($users);

    return $updateUser;
}

function deleteUser($id)
{
    $users = getUsers();

    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            array_splice($users, $i, 1);
        }
    }

    putJson($users);
}


function putJson($users)
{
    file_put_contents(__DIR__ . '/users.json', json_encode($users, JSON_PRETTY_PRINT));
}

function validateUser($user, &$errors)
{
    $isValid = true;
    
    if (!$user['firstName']) {
        $isValid = false;
        $errors['firstName'] = 'Name is mandatory';
    }
    if (!$user['lastName']) {
        $isValid = false;
        $errors['lastName'] = 'Name is mandatory';
    }
    if ($user['email'] && !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $errors['email'] = 'This must be a valid email address';
    }

    if (!filter_var($user['password'], FILTER_VALIDATE_INT)) {
        $isValid = false;
        $errors['password'] = 'This must be a valid phone number';
    }

    if (!$user['password'] || strlen($user['password']) < 8 || strlen($user['password']) > 16) {
        $isValid = false;
        $errors['password'] = 'Password is required and it must be more than 8 and less then 16 character';
    }
    
    if (!$user['clearanceLevel']) {
        $isValid = false;
        $errors['clearanceLevel'] = 'Name is mandatory';
    }

    return $isValid;
}
