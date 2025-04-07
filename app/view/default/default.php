<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>Main page - Azalea Pro</title>
        <link href="<?= DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'style.css' ?>" rel="stylesheet"/>
        <link rel="icon" href="<?= DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'azalea-logo.png' ?>" type="image/x-icon">
    </head>
    <body>
        <?php include_once "app" . DIRECTORY_SEPARATOR. "view" . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "header.php"; ?>
        <main>
            <?php include_once "app" . DIRECTORY_SEPARATOR. "view" . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "home.php"; ?>
        </main>
        <?php include_once "app" . DIRECTORY_SEPARATOR. "view" . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "footer.php"; ?>
    </body>
</html>