<?php
require_once 'dataBase.php';
require_once 'functions.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./src/css/userLogin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>

<body>
    <div>
        <?php include 'tempnav.php'; ?>
    </div>

    <div class="formContainer">
        <?php


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];
            logIn($email, $password, $conn);
        }

        ?>
        <form action="userLogin.php" method="post">
            <h1>Welcome Back!</h1>
            <label for="email">Email</label>
            <input type="text" name="email" placeholder="email" required>
            <label for="password">Password</label>
            <div class="passwordContainer"><input type="password" name="password" placeholder="password" required>
                <i class='bx bxs-lock-alt' id="lockIcon"></i>
            </div>
            <button>Log in</button>
            <p>Need an account? <a href="userRegister.php" id="singupLink">Sign up</a></p>

        </form>
    </div>

</body>
<?php
$salesData = getMonthlySalesAndCost($conn);
?>
<script>
    const ctx = document.getElementById('salesChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($salesData['months']); ?>,
            datasets: [{
                    label: 'Sales',
                    data: <?php echo json_encode($salesData['sales']); ?>,
                    borderColor: '#4A90E2',
                    tension: 0.1,
                    fill: false
                },
                {
                    label: 'Cost',
                    data: <?php echo json_encode($salesData['costs']); ?>,
                    borderColor: '#E24A4A',
                    tension: 0.1,
                    fill: false
                },
                {
                    label: 'Profit',
                    data: <?php echo json_encode($salesData['profits']); ?>,
                    borderColor: '#4AE24A',
                    tension: 0.1,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Amount (Rs.)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Sales, Cost and Profit Overview',
                    font: {
                        size: 16
                    }
                },
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
</script>


</html>

<script>

</script>