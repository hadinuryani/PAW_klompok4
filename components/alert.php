<?php require_once '../config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alert</title>
  <link rel="stylesheet" href="<?= BASE_URL; ?>/assets/css/alert.css">
</head>
<body>
  <div class="container-alert">
        <div class="brutalist-card">
          <div class="brutalist-card__header">
        <div class="brutalist-card__icon">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path
            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"
            ></path>
          </svg>
        </div>
        <div class="brutalist-card__alert">Pesan</div>
      </div>
      <div class="brutalist-card__message">
        <?= $alert['pesan']; ?>
      </div>
      <div class="brutalist-card__actions">
        <a class="brutalist-card__button brutalist-card__button--mark" href="<?= $alert['href']; ?>?id_buku=<?= $alert['data']; ?>"
          >Okay</a>
        <?php if($alert['confirm'] == true) : ?>
        <a class="brutalist-card__button brutalist-card__button--read" href="<?= BASE_URL; ?>administrator/kelola_buku.php"
          >Tidak</a
        >
        <?php endif ?>
        
      </div>
    </div>
</div>

</body>
</html>
