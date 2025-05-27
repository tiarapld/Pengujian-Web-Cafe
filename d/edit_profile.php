<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

require '../db.php';

$userId = $_SESSION['user_id'];

// Get current user data
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
    die('User not found');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = trim($_POST['username']);
    $new_email = trim($_POST['email']);
    
    // Basic validation
    if (empty($new_username) || empty($new_email)) {
        $error = 'Username and email are required.';
    } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        $profile_photo = $user['profile_photo'] ?? null;
        
        // Handle file upload if provided
        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['profile_photo'];
            
            // Validate file type and size
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxSize = 2 * 1024 * 1024; // 2MB
            
            if (!in_array($file['type'], $allowedTypes)) {
                $error = 'Only JPG, PNG, or GIF images are allowed.';
            } elseif ($file['size'] > $maxSize) {
                $error = 'Image size must be less than 2MB.';
            } else {
                // Generate unique filename
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $newFilename = 'profile_'.$userId.'_'.time().'.'.strtolower($ext);
                $uploadDir = __DIR__ . '/uploads/';
                
                // Create upload directory if it doesn't exist
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $uploadFile = $uploadDir . $newFilename;
                
                if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                    // Delete old photo if it exists
                    if (!empty($user['profile_photo']) && file_exists($uploadDir . $user['profile_photo'])) {
                        unlink($uploadDir . $user['profile_photo']);
                    }
                    $profile_photo = $newFilename;
                } else {
                    $error = 'Failed to upload image.';
                }
            }
        }
        
        if (empty($error)) {
            try {
                // Update user data
                $update_stmt = $pdo->prepare('UPDATE users SET username = ?, email = ?, profile_photo = ? WHERE id = ?');
                $update_stmt->execute([$new_username, $new_email, $profile_photo, $userId]);
                
                // Redirect to profile page after successful update
                header('Location: dashboard.php');
                exit;
                
            } catch (PDOException $e) {
                $error = 'Database error: ' . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Profile - Cafe Aroma</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
    :root {
        --primary-color: #3a2c2a;
        --secondary-color: #c8a97e;
        --light-color: #f9f5f0;
        --dark-color: #333;
        --danger-color: #cc3333;
        --success-color: #28a745;
        --background-color: #f5f5f5;
        --text-color: #333;
        --input-bg: #fff;
        --input-border: #ccc;
        --shadow-color: rgba(0, 0, 0, 0.1);
    }

    body.dark-mode {
        --primary-color: #c8a97e;
        --secondary-color: #3a2c2a;
        --light-color: #222;
        --dark-color: #f5f5f5;
        --danger-color: #ff6b6b;
        --success-color: #28a745;
        --background-color: #121212;
        --text-color: #eee;
        --input-bg: #1e1e1e;
        --input-border: #555;
        --shadow-color: rgba(255, 255, 255, 0.1);
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--background-color);
        color: var(--text-color);
        transition: background-color 0.3s, color 0.3s;
        padding: 20px;
    }

    .container {
        max-width: 500px;
        margin: 0 auto;
        background-color: var(--input-bg);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px var(--shadow-color);
    }

    h1 {
        color: var(--primary-color);
        margin-bottom: 20px;
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="file"] {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 20px;
        background-color: var(--input-bg);
        color: var(--text-color);
        border: 1px solid var(--input-border);
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    .profile-photo {
        display: block;
        margin-bottom: 20px;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--secondary-color);
    }

    button {
        background-color: var(--secondary-color);
        color: white;
        border: none;
        padding: 12px 20px;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #b89a6b;
    }

    .message {
        padding: 12px;
        margin-bottom: 20px;
        border-radius: 6px;
        font-weight: 600;
    }

    .error {
        background-color: #f8d7da;
        color: var(--danger-color);
    }

    .back-link {
        display: block;
        margin-top: 20px;
        text-align: center;
        text-decoration: none;
        color: var(--secondary-color);
        font-weight: 600;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    #toggleModeBtn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 100;
    background-color: var(--secondary-color);
    color: white;
    border: none;
    padding: 8px 10px;
    font-size: 14px;
    border-radius: 50px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 2px 6px var(--shadow-color);
    white-space: nowrap;
    max-width: 140px;
}

    #toggleModeBtn:hover {
        background-color: #b89a6b;
    }
</style>

    <script>
        function previewImage(event) {
            const input = event.target;
            if(input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePhotoPreview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>

        <?php if ($error): ?>
            <div class="message error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="edit_profile.php" method="POST" enctype="multipart/form-data">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required value="<?php echo htmlspecialchars($user['username']); ?>" />

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required value="<?php echo htmlspecialchars($user['email']); ?>" />

            <label for="profile_photo">Photo Profile</label>
            <img id="profilePhotoPreview" class="profile-photo" src="<?php 
                if (!empty($user['profile_photo']) && file_exists(__DIR__ . '/uploads/' . $user['profile_photo'])) {
                    echo 'uploads/' . htmlspecialchars($user['profile_photo']);
                } else {
                    echo 'https://via.placeholder.com/120';
                }
            ?>" alt="Profile Photo" />
            <input type="file" name="profile_photo" id="profile_photo" accept="image/*" onchange="previewImage(event)" />

            <button type="submit">Save Changes</button>
        </form>

        <a href="dashboard.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Profile</a>
    </div>
      <button id="toggleModeBtn" title="Mode">
    <i class="fas fa-moon"></i> Mode Gelap
  </button>

  <script>
    const toggleBtn = document.getElementById("toggleModeBtn");
    const body = document.body;

    function setMode(mode) {
      if (mode === "dark") {
        body.classList.add("dark-mode");
        toggleBtn.innerHTML = '<i class="fas fa-sun"></i> Mode Terang';
      } else {
        body.classList.remove("dark-mode");
        toggleBtn.innerHTML = '<i class="fas fa-moon"></i> Mode Gelap';
      }
    }

    // Cek localStorage saat halaman dimuat
    const savedMode = localStorage.getItem("mode") || "light";
    setMode(savedMode);

    toggleBtn.addEventListener("click", () => {
      const currentMode = body.classList.contains("dark-mode") ? "dark" : "light";
      const newMode = currentMode === "dark" ? "light" : "dark";
      localStorage.setItem("mode", newMode);
      setMode(newMode);
    });
  </script>
</body>

</body>
</html>