<?php
// Database connection details
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "form_data_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO registrations (full_name, birth_year, gender, nationality, id_number, phone, email, specialization, graduation_year, university, disability_type, registered, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sisssssssssss", $full_name, $birth_year, $gender, $nationality, $id_number, $phone, $email, $specialization, $graduation_year, $university, $disability_type, $registered, $notes);

// Get the form data
$full_name = $_POST['full-name'];
$birth_year = $_POST['birth-year'];
$gender = $_POST['gender'];
$nationality = $_POST['nationality'];
$id_number = $_POST['id-number'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$specialization = $_POST['specialization'];
$graduation_year = $_POST['graduation-year'];
$university = $_POST['university'];
$disability_type = $_POST['disability-type'];
$registered = $_POST['registered'];
$notes = $_POST['notes'];

// Execute the statement
$success = $stmt->execute();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتيجة التسجيل</title>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            direction: rtl;
            background-color: #f2f2f2;
            text-align: center;
            padding: 50px;
        }

        .modal {
            display: <?php echo $success ? 'block' : 'none'; ?>; /* Show modal if success */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background-color: #197568;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #fff;
            color: #197568;
        }
    </style>
</head>
<body>

<div class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <p><?php echo $success ? "تم تسجيلك بنجاح!" : "حدث خطأ أثناء التسجيل."; ?></p>
        <button id="closeButton" onclick="window.location.href='./start.html'">إغلاق</button>
    </div>
</div>

<script>
    // Close the modal when the user clicks on <span> (x) or button
    function closeModal() {
        document.querySelector('.modal').style.display = 'none';
    }

    document.getElementById('closeModal').onclick = closeModal;

    // Close the modal when the user clicks anywhere outside of the modal
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            closeModal();
        }
    };
</script>

</body>
</html>