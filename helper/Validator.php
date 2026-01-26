<?php
namespace helper;
// validation du nom
function validateName($name) {
    $name = trim($name);
    if (empty($name)) {
        return "Name is required!";
    }
    if (strlen($name) < 2 ){
        return "name is too short";
    }
    if (!preg_match("/^[a-zA-ZÀ-ÿ\s]+$/", $name)) {
        return "Name can only contains letters and spaces";
    }
    return true;
}
// validation email
function validateEmail($email) {
    $email = trim($email);
    if (empty($email)) {
        return "Email is required!";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Email not valide!";
    }
    return true;
}

// validation phone
function validatePhone($phone) {
    $phone = trim($phone);
    if (empty($phone)) {
        return "Phone is required!";
    }
    if (!preg_match("/^\+212[0-9]{9}$/", $phone)) {
        return "Phone format +212XXXXXXXXX";
    }
    return true;
}

// validation ville
function validateVille($villeId) {
    if (empty($villeId) || !is_numeric($villeId) || $villeId <= 0) {
        return "city is required!";
    }
    return true;
}

// validation role
function validateRole($role) {
    $role = trim($role);
    if (empty($role)) {
        return "Role is required!";
    }
    if (!in_array($role, ['avocat', 'hussier'])) {
        return "Role invalide.";
    }
    return true;
}


function validateExpYears($expYears) {
    if (!is_numeric($expYears) || $expYears < 0) {
        return "Positive numbers only";
    }
    return true;
}

// validation hourly rate
function validateHourlyRate($hourlyRate) {
    if (!is_numeric($hourlyRate) || $hourlyRate <= 0) {
        return "Positive numbers only";
    }
    return true;
}

// validation du specialite
function validateSpecialisation($specialisation) {
    $specialisation = trim($specialisation);
    if (empty($specialisation)) {
        return "Speciality is required!";
    }
    return true;
}

// validation du type
function validateType($type) {
    $type = trim($type);
    if (empty($type)) {
        return "Type is required!";
    }
    return true;
}

// affichage dans une array des erreurs s'il y'en a
function validatePersonneData(array $data) {
    $errors = [];

    $nameValidation = validateName($data['name'] ?? '');
    if ($nameValidation !== true) $errors['name'] = $nameValidation;

    $emailValidation = validateEmail($data['email'] ?? '');
    if ($emailValidation !== true) $errors['email'] = $emailValidation;

    $phoneValidation = validatePhone($data['phone'] ?? '');
    if ($phoneValidation !== true) $errors['phone'] = $phoneValidation;

    $villeValidation = validateVille($data['ville'] ?? '');
    if ($villeValidation !== true) $errors['ville'] = $villeValidation;

    $roleValidation = validateRole($data['role'] ?? '');
    if ($roleValidation !== true) $errors['role'] = $roleValidation;

    return $errors;
}


function validateRoleSpecificData($data, $role) {
    $errors = [];

    $expValidation = validateExpYears($data['exp_years'] ?? '');
    if ($expValidation !== true) $errors['exp_years'] = $expValidation;

    $rateValidation = validateHourlyRate($data['hourly_rate'] ?? '');
    if ($rateValidation !== true) $errors['hourly_rate'] = $rateValidation;

    if ($role === 'avocat') {
        $specValidation = validateSpecialisation($data['specialisation'] ?? '');
        if ($specValidation !== true) $errors['specialisation'] = $specValidation;
    } elseif ($role === 'hussier') {
        $typeValidation = validateType($data['type'] ?? '');
        if ($typeValidation !== true) $errors['type'] = $typeValidation;
    }

    return $errors;
}

class Validator{

    public static function email($email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "L'email n'est pas valide";
            }
            return null;
        }
}
?>