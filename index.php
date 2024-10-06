<?php

$contacts = array(
    1 => array(
        "fname" => "john",
        "lname" => "doe",
        "age" => 21,
        "contact" => "09123786541",
        "address" => "jan lang banda banda"
    ),
    2 => array(
        "fname" => "jane",
        "lname" => "doe ",
        "age" => 22,
        "contact" => "09123786541",
        "address" => "sa tabi tabi"
    )
);

function formatContact($contactNumber)
{
    $firstHypen = substr_replace($contactNumber, " - ", 4, 0);
    $secondHypen = substr_replace($firstHypen, " - ", 10, 0);
    return $secondHypen;
}

function validatePHPhoneNumber($phoneNumber)
{
    // Regular expression to match the pattern "09" followed by 9 digits
    $pattern = '/^09\d{9}$/';
    return preg_match($pattern, $phoneNumber);
}

// for form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from the form
    $fname = $_POST['fname'] ?? '';
    $lname = $_POST['lname'] ?? '';
    $age = $_POST['age'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $address = $_POST['address'] ?? '';

    if (!validatePHPhoneNumber($contact)) {
        echo "<script>alert('Invalid Phone Number')</script>";

    } else {
        // Add new contact to the array
        $newContactId = count($contacts) + 1; // for the appended contact
        $contacts[$newContactId] = array(
            "fname" => $fname,
            "lname" => $lname,
            "age" => $age,
            "contact" => $contact,
            "address" => $address
        );
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div id="container">

        <div class="oval"></div>
        <!-- divider only -->
        <div class="content">

            <div class="search-area">
                <i class="fas fa-search" id="search-icon"></i>
                <div class="search">
                    <input type="text" id="search-input" placeholder="Search Someone">
                </div>
                <i class="fas fa-plus" id="add-icon"></i>
            </div>

            <form method="POST" id="form" name="contact-form">

                <div class="form-group">
                    <input type="text" name="fname" placeholder="First Name" maxlength="20" autocomplete="off" required>
                    <input type="text" name="lname" placeholder="Last Name" maxlength="20" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input type="number" name="age" min="1" placeholder="Age" class="age-input" autocomplete="off" required>
                    <input type="number" name="contact" maxlength="11" placeholder="09*********" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input type="text" name="address" maxlength="100" placeholder="Address" autocomplete="off" required>
                </div>

                <div id="buttons">
                    <button type="button" id="hide">HIDE</button>
                    <button type="reset">CLEAR</button>
                    <button type="submit">SUBMIT</button>
                </div>


            </form>

            <div id="contact-list">



                <?php

                if (empty($contacts)) {
                    echo "<h3 class='empty'>Contact Empty</h3>";
                } else {

                    foreach ($contacts as $id => $item) {
                        echo "
                        <div class='contact'>
                        <p class='name'>" . htmlspecialchars($item["fname"]) . " " . htmlspecialchars($item["lname"]) . "<sup>" . htmlspecialchars($item["age"]) . "</sup> </p>
                        <small>" . $item["address"] .  "</small>
                        <h3>" . formatContact($item["contact"]) . "</h3>
                        </div>
                        ";
                    }
                }
                ?>


            </div>



        </div>
        <!-- end divider only -->
        <div class="footer"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./index.js"></script>
</body>

</html>