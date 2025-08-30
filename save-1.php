<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // 1. Form fields को प्राप्त करें
  $fullName      = $_POST['full_name'] ?? '';
  $fatherName    = $_POST['father_name'] ?? '';
  $motherName    = $_POST['mother_name'] ?? '';
  $dob           = $_POST['dob'] ?? '';
  $gender        = $_POST['gender'] ?? '';
  $category      = $_POST['category'] ?? '';
  $mobile        = $_POST['mobile'] ?? '';
  $email         = $_POST['email'] ?? '';
  $address       = $_POST['address'] ?? '';
  $idType        = $_POST['id_type'] ?? '';
  $level         = $_POST['level'] ?? '';
  $faculty       = $_POST['faculty'] ?? '';
  $course        = $_POST['course'] ?? '';
  $percent10     = $_POST['percent_10'] ?? '';
  $percent12     = $_POST['percent_12'] ?? '';
  $percentGrad   = $_POST['percent_grad'] ?? '';

  // 2. CSV File में Save करने के लिए तैयार करें
  $row = [
    date("Y-m-d H:i:s"),  // Timestamp
    $fullName,
    $fatherName,
    $motherName,
    $dob,
    $gender,
    $category,
    $mobile,
    $email,
    $address,
    $idType,
    $level,
    $faculty,
    $course,
    $percent10,
    $percent12,
    $percentGrad
  ];

  // 3. applications.csv फाइल में जोड़ें
  $file = fopen("applications.csv", "a");

  // अगर फाइल खाली है, तो headers डालें
  if (filesize("applications.csv") == 0) {
    fputcsv($file, [
      "Submitted At", "Full Name", "Father Name", "Mother Name", "DOB", "Gender",
      "Category", "Mobile", "Email", "Address", "Govt ID Type",
      "Level", "Faculty", "Course", "10th %", "12th %", "Graduation %"
    ]);
  }

  fputcsv($file, $row);
  fclose($file);

  // 4. Redirect करें preview या payment page पर
  header("Location: payment.html");  // या preview.html
  exit();
}
?