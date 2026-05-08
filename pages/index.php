<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section>
        <div class="sidebar">
            <?php include 'sidebar.php'; ?>
        </div>
    </section>

    <section>
        <div class="content">
            <?php 
            $pages = $_GET['admin'] ?? 'dashboard';

            switch ($pages) {
                case 'dashboard':
                    include 'admin/dashboard/index.php';
                break;
                case 'user':
                    include 'admin/user/index.php';
                break;
                case 'edit':
                    include 'admin/user/index.php';
                break;
                case 'hapus':
                    include 'admin/user/index.php';
                break;
                case 'buku':
                    include 'admin/buku/index.php';
                break; 
                case 'edit_buku':
                    include 'admin/buku/edit.php';
                break;
                case 'delete_buku':
                    include 'admin/buku/delete.php';
                break;
                default:
                    include 'admin/dashboard/index.php';
                break;
            }
            ?>
        </div>
    </section>
</body>
</html>