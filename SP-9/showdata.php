<?php
session_start();

function connectDB()
{
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'dbhw9';
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function login($username, $password)
{
    $conn = connectDB();
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['is_admin'] = $user['is_admin'];
            return true;
        }
    }
    return false;
}

function register($username, $password, $first_name, $last_name, $gender, $age, $province, $email)
{
    $conn = connectDB();
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return "Username หรือ Email มีอยู่แล้ว";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, password, first_name, last_name, gender, age, province, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssiis", $username, $hashed_password, $first_name, $last_name, $gender, $age, $province, $email);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function isAdmin()
{
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
}

function logout()
{
    session_destroy();
    header("Location: index.html");
    exit();
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'login':
                if (login($_POST['username'], $_POST['password'])) {
                    // Redirect to the same page to show data
                    header("Location: showdata.php");
                    exit();
                } else {
                    $error = "Invalid username or password";
                }
                break;
            case 'register':
                if ($_POST['password'] === $_POST['confirm_password']) {
                    $register_result = register($_POST['username'], $_POST['password'], $_POST['first_name'], $_POST['last_name'], $_POST['gender'], $_POST['age'], $_POST['province'], $_POST['email']);
                    if ($register_result === true) {
                        header("Location: index.html");
                        exit();
                    } elseif ($register_result === "Username หรือ Email มีอยู่แล้ว") {
                        $error = $register_result;
                    } else {
                        $error = "Registration failed";
                    }
                } else {
                    $error = "Passwords do not match";
                }
                break;
            case 'logout':
                logout();
                break;
        }
    }
}

// Check if user is logged in
if (!isLoggedIn()) {
    header("Location: index.html");
    exit();
}

$conn = connectDB();

// Handle user actions for admin
if (isAdmin() && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                register($_POST['username'], $_POST['password'], $_POST['first_name'], $_POST['last_name'], $_POST['gender'], $_POST['age'], $_POST['province'], $_POST['email']);
                break;
            case 'edit':
                $id = $_POST['id'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $gender = $_POST['gender'];
                $age = $_POST['age'];
                $province = $_POST['province'];
                $email = $_POST['email'];
                $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, gender=?, age=?, province=?, email=? WHERE id=?");
                $stmt->bind_param("ssssisi", $first_name, $last_name, $gender, $age, $province, $email, $id);
                $stmt->execute();
                break;
            case 'delete':
                $id = $_POST['id'];
                $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                break;
        }
    }
}

// Fetch user data
if (isAdmin()) {
    $result = $conn->query("SELECT * FROM users WHERE is_admin = 0");
    $users = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title><?php echo isAdmin() ? 'Admin Dashboard' : 'Customer Dashboard'; ?></title>
</head>

<body>
    <h2><?php echo isAdmin() ? 'Admin Dashboard' : 'Customer Dashboard'; ?></h2>
    <form method="post">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Logout">
    </form>

    <?php if (isAdmin()): ?>
        <h3>Customer Accounts</h3>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Province</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['first_name']; ?></td>
                    <td><?php echo $user['last_name']; ?></td>
                    <td><?php echo $user['gender']; ?></td>
                    <td><?php echo $user['age']; ?></td>
                    <td><?php echo $user['province']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <input type="submit" value="Edit">
                        </form>
                        <form method="post" onsubmit="return confirm('Are you sure you want to delete this account?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>


        <form method="post">
            <h3>Add New Customer Account</h3>
            <input type="hidden" name="action" value="add">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="text" name="first_name" placeholder="First Name" required><br>
            <input type="text" name="last_name" placeholder="Last Name" required><br>
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select><br>
            <input type="number" name="age" placeholder="Age" required><br>
            <input type="text" name="province" placeholder="Province" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="submit" value="Add Customer">
        </form>
    <?php else: ?>
        <h3>Your Account Information</h3>
        <form method="post">
            <input type="hidden" name="action" value="edit">
            <label>Username: <?php echo $user['username']; ?></label><br>
            <label>First Name: <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required></label><br>
            <label>Last Name: <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required></label><br>
            <label>Gender:
                <select name="gender" required>
                    <option value="male" <?php echo $user['gender'] === 'male' ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?php echo $user['gender'] === 'female' ? 'selected' : ''; ?>>Female</option>
                    <option value="other" <?php echo $user['gender'] === 'other' ? 'selected' : ''; ?>>Other</option>
                </select>
            </label><br>
            <label>Age: <input type="number" name="age" value="<?php echo $user['age']; ?>" required></label><br>
            <label>Province: <input type="text" name="province" value="<?php echo $user['province']; ?>" required></label><br>
            <label>Email: <input type="email" name="email" value="<?php echo $user['email']; ?>" required></label><br>
            <input type="submit" value="Update Information">
        </form>
    <?php endif; ?>
</body>

</html>