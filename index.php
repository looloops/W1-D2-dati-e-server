<?php
// Define variables and initialize with empty values
$name = $email = $age = "";
$name_err = $email_err = $age_err = "";
$submitted_data = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name.";
    } else{
        $name = trim($_POST["name"]);
    }
    
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email address.";
    } else{
        $email = trim($_POST["email"]);
        // Check if email address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email format"; 
        }
    }
    
    // Validate age
    if(empty(trim($_POST["age"]))){
        $age_err = "Please enter your age.";
    } else{
        $age = trim($_POST["age"]);
        // Check if age is a number
        if (!is_numeric($age)) {
            $age_err = "Age must be a number"; 
        }
    }
    
    // Check input errors before inserting into database
    if(empty($name_err) && empty($email_err) && empty($age_err)){
        // Here you can do further processing like saving to database
        $submitted_data = "Submitted Data:<br>Name: $name<br>Email: $email<br>Age: $age";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
</head>
<body>
    <h2>Form Validation</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>">
            <span><?php echo $name_err; ?></span>
        </div>
        <div>
            <label>Email</label>
            <input type="text" name="email" value="<?php echo $email; ?>">
            <span><?php echo $email_err; ?></span>
        </div>
        <div>
            <label>Age</label>
            <input type="text" name="age" value="<?php echo $age; ?>">
            <span><?php echo $age_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Submit">
        </div>
    </form>

    <?php echo $submitted_data; ?>
</body>
</html>
