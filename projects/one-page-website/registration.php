<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Register for Coding Competition</h1>
    </header>

    <main>
        <section id="registration-form">
            <h2>Registration Form</h2>
            <form action="submit.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>

                <label for="language">Preferred Coding Language:</label>
                <input type="text" id="language" name="language"><br>

                <input type="submit" value="Register" class="btn">
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Coding Competition</p>
    </footer>
</body>
</html>
