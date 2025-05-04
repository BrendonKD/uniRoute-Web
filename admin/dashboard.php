<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .admin-header {
            background: linear-gradient(to right, #007bff, #28a745);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .admin-header .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .admin-header nav {
            display: flex;
            gap: 20px;
        }

        .admin-header nav a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .admin-header nav a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .admin-header .logout-btn {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 8px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .admin-header .logout-btn:hover {
            background-color: #c9302c;
        }

        /* Hamburger menu for mobile */
        .hamburger {
            display: none;
            font-size: 24px;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .admin-header {
                flex-wrap: wrap;
                padding: 15px;
            }

            .admin-header nav {
                display: none;
                flex-direction: column;
                width: 100%;
                gap: 10px;
                margin-top: 15px;
            }

            .admin-header nav.active {
                display: flex;
            }

            .admin-header .logout-btn {
                width: 100%;
                text-align: center;
            }

            .hamburger {
                display: block;
            }
        }
    </style>
</head>
<body>
    <?php include '../admin/adminLayout/header.php'; ?>


    <!-- Placeholder content to show the header is fixed -->
    <div style="height: 2000px; padding-top: 80px;">
        <!-- Your dashboard content goes here -->
    </div>

    <script>
        // Toggle mobile menu
        const hamburger = document.querySelector('.hamburger');
        const nav = document.querySelector('nav');

        hamburger.addEventListener('click', () => {
            nav.classList.toggle('active');
        });
    </script>
</body>
</html>