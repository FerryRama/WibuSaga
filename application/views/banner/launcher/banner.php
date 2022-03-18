<!DOCTYPE html>
<html lang="ko">

<head>
    <title><?= $title ?></title>
</head>

<body>

    <?php foreach ($banner as $s) : ?>
        <img src="<?= $s['bannerlauncher'] ?>" style="
    margin: -8px;
    overflow-x:hidden;
    height: 221px;
    width: 319px;
"> <?php endforeach ?>
</body>

</html>