<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ? $data['title'] :'document' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/<?= $data['css']; ?>">
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="<?= BASE_URL; ?>assets/img/logo-light.png" alt="Logo Library">
        </div>

        <form class="search-bar" action="#" method="get">
            <input type="text" name="q" placeholder="Search books, authors..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
            <button type="submit">&#128269;</button>
        </form>

        <div class="profile">
            <div class="profile-pic">
                <img src="<?= BASE_URL; ?>assets/img/logo-light.png" alt="User Profile">
                <!-- Tombol Edit SVG -->
                <button class="edit-btn" title="Edit Profile">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9" />
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                    </svg>
                </button>
            </div>
            <span>username dummy</span>
        </div>
    </header>


        


