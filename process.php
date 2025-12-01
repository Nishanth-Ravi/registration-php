<?php
// process.php (improved)
//
// Debug marker: change the marker string if you want to confirm which file responded.

define('DEBUG_MARKER', 'PROCESS_PHP_V1'); // change this if testing different copies

header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);
    echo "<div style='color:red;'>Invalid request. (marker: ".DEBUG_MARKER.")</div>";
    exit;
}

// safe output helper
function e($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

$fname   = isset($_POST['fname'])   ? trim($_POST['fname'])   : '';
$email   = isset($_POST['email'])   ? trim($_POST['email'])   : '';
$phone   = isset($_POST['phone'])   ? trim($_POST['phone'])   : '';
$dob     = isset($_POST['dob'])     ? trim($_POST['dob'])     : '';
$gender  = isset($_POST['gender'])  ? trim($_POST['gender'])  : '';
$address = isset($_POST['address']) ? trim($_POST['address']) : '';

// server-side validation
$errors = [];
if ($fname === '')  $errors[] = 'Full name required.';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email required.';
if ($phone === '')  $errors[] = 'Phone required.';
if ($dob === '')    $errors[] = 'Date of birth required.';
if ($gender === '') $errors[] = 'Gender required.';
if ($address === '') $errors[] = 'Address required.';

if (!empty($errors)) {
    echo "<div style='color:red'><strong>Please fix:</strong><ul>";
    foreach ($errors as $err) echo '<li>' . e($err) . '</li>';
    echo "</ul></div>";
    exit;
}

// success HTML (AJAX will inject into #message)
$out = '<div style="background:#fff;padding:18px;border-radius:8px;box-shadow:0 3px 8px rgba(0,0,0,.08);">';
$out .= '<!-- marker: ' . DEBUG_MARKER . ' -->';
$out .= '<h2 style="margin:6px 0 12px;">Registration Successful!</h2>';
$out .= '<p><strong>Name:</strong><br>' . e($fname) . '</p>';
$out .= '<p><strong>Email:</strong><br>' . e($email) . '</p>';
$out .= '<p><strong>Phone:</strong><br>' . e($phone) . '</p>';
$out .= '<p><strong>Date of Birth:</strong><br>' . e($dob) . '</p>';
$out .= '<p><strong>Gender:</strong><br>' . e($gender) . '</p>';
$out .= '<p><strong>Address:</strong><br>' . nl2br(e($address)) . '</p>';
$out .= '</div>';

echo $out;
exit;
?>
