<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/app.css">
    <title>Abhishek Blog</title>
</head>

<body>
    <?php foreach ($posts as $post) : ?>
    <article>
        <a href="/post/<?= $post->slug ?>">
            <h1><?= $post->title; ?></h1>
        </a>
        <div><?= $post->excerpt; ?></div>
    </article>
    <?php endforeach; ?>
</body>

</html>