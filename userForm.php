<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/userForm.css">
</head>

<body>
    <div class="userFormContainer">
        <form action="userRegister.php" class="userForm" id="userForm" method="post" enctype="multipart/form-data">
            <h1>User Register Form</h1>
            <label for="">First Name</label>
            <input type="text" name="first_name" placeholder="First Name" required>
            <label for="">Last Name</label>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <label for="">Address</label>
            <input type="text" name="address_no" id="" placeholder="No" required>
            <input type="text" name="street" id="" placeholder="Street" required>
            <input type="text" name="city" id="" placeholder="City" required>
            <label for="">Phone</label>
            <input type="text" name="phone" id="" placeholder="Phone">
            <label for="">Email</label>
            <input type="text" name="email" placeholder="Email" required>
            <label for="">Password</label>
            <input type="password" name="password" placeholder="Password" required>
            <button class="submitbtn"> Register new user</button>
        </form>
    </div>
</body>

</html>