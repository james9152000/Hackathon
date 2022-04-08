<?php

function getEmployees()
{
    return json_decode(file_get_contents(__DIR__ . '/employee.json'), true);
}

function getEmployeeById($id)
{
    $Employees = getEmployees();
    foreach ($Employees as $Employee) {
        if ($Employee['id'] == $id) {
            return $Employee;
        }
    }
    return null;
}

function createEmployee($data)
{
    $Employees = getEmployees();

    $data['id'] = rand(100000, 200000);

    $Employee[] = $data;

    putJson($Employee);

    return $data;
}

function updateEmployee($data, $id)
{
    $updateEmployee = [];
    $Employees = getEmployees();
    foreach ($Employees as $i => $Employee) {
        if ($Employee['id'] == $id) {
            $Employees[$i] = $updateEmployee = array_merge($Employee, $data);
        }
    }

    putJson($Employees);

    return $updateEmployee;
}

function deleteEmployee($id)
{
    $Employees = getEmployees();

    foreach ($Employees as $i => $Employee) {
        if ($Employee['id'] == $id) {
            array_splice($Employees, $i, 1);
        }
    }

    putJson($Employees);
}


function putJson($Employees)
{
    file_put_contents(__DIR__ . '/users.json', json_encode($Employees, JSON_PRETTY_PRINT));
}

function validateEmployee($Employee, &$errors)
{
    $isValid = true;
    
    if (!$Employee['name']) {
        $isValid = false;
        $errors['name'] = 'Name is mandatory';
    }
    if (!$Employee['username'] || strlen($Employee['username']) < 6 || strlen($Employee['username']) > 16) {
        $isValid = false;
        $errors['username'] = 'Username is required and it must be more than 6 and less then 16 character';
    }
    if ($Employee['email'] && !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $errors['email'] = 'This must be a valid email address';
    }

    if (!filter_var($Employee['phone'], FILTER_VALIDATE_INT)) {
        $isValid = false;
        $errors['phone'] = 'This must be a valid phone number';
    }
   

    return $isValid;
}
