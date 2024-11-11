<?php
require_once 'dataBase.php';
require_once 'functions.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="src/css/usersData.css">

</head>

<body>
    <div class="mainContainer">



        <table class="userTable">
            <tr>
                <th class="nameColumn">First Name</th>
                <th class="nameColumn">Last Name</th>
                <th>Email</th>
                <th class='phoneLine'>Phone</th>
                <th>Action</th>
                <th>delete</th>

            </tr>
            <?php
            require_once 'dataBase.php';
            require_once 'functions.php';
            include 'tempnav.php';
            include 'mobileNav.php';
            adminPanel();
            $sql = "SELECT * FROM users";
            $result = mysqli_query($conn, $sql);
            foreach ($result as $row) {
                echo "<tr id='userRow" . $row['id'] . "'>";
                echo "<td class='nameColumn'>" . $row['first_name'] . "</td>";
                echo "<td class='nameColumn'>" . $row['last_name'] . "</td>";
                echo "<td class='emailLine'>" . $row['email'] . "</td>";
                echo "<td class='phoneLine'>" . $row['phone'] . "</td>";
                echo "<td>
                    <select name='adminStatus" . $row['id'] . "' onchange='updateAdminStatus(this.value, " . $row['id'] . ")'>
                        <option value='1' " . ($row['admin'] == 1 ? 'selected' : '') . ">Admin</option>
                        <option value='0' " . ($row['admin'] == 0 ? 'selected' : '') . ">User</option>
                    </select>
                  </td>";
                echo "<td> <button onclick='deleteUser(" . $row['id'] . ")'><i class='fa-solid fa-user-xmark'></i></button></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>


</body>
<script>
    function updateAdminStatus(status, userId) {
        fetch('userUpdate.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'status=' + status + '&userId=' + userId
            })
            .then(response => response.text())
            .then(data => console.log(data));
    }

    function deleteUser(userId) {
        if (confirm("Do you want to proceed?")) {
            fetch('userUpdate.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'userId=' + userId + '&delete=true'
                })
                .then(response => response.text())
                .then(data => console.log(data));
            document.getElementById('userRow' + userId).remove();
            console.log("User clicked OK");
        } else {
            console.log("User clicked Cancel");
        }


    }
</script>
<script>
    const menuBtn = document.getElementById('menuBtn');
    const menuIcon = document.getElementById('menuIcon');
    const menu = document.querySelector('.menu');
    const closeBtn = document.getElementById('closeBtn');
    let isMenuOpen = true;
    menuBtn.addEventListener('click', () => {

        if (!isMenuOpen) {
            menu.style.display = 'flex';
            isMenuOpen = !isMenuOpen;
            console.log(isMenuOpen, '1');
            menuIcon.classList.remove('fa-bars');
            menuIcon.classList.add('fa-xmark');
            menuBtn.style.backgroundColor = '#feb1b1';
        } else {
            menu.style.display = 'none';
            isMenuOpen = !isMenuOpen;
            console.log(isMenuOpen, '2');
            menuIcon.classList.remove('fa-xmark');
            menuIcon.classList.add('fa-bars');
            menuBtn.style.backgroundColor = '#fff';
        }

    });
</script>


</html>