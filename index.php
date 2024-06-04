<?php include '../dinamic-slide-gallery/admin.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="./app.js" defer></script>
    <title>Document</title>
</head>

<body>
    <section>

        <div id="img-container">

            <?php
            $conn = new Admin;
            $conn->get_all_img();
            ?>

            <button class="prev">❮</button>
            <button class="next">❯</button>

        </div>

        <div id="dot-container"></div>

    </section>

    <table>

        <tr>
            <th>id</th>
            <th>show</th>
            <th>img</th>
            <th>action</th>
        </tr>

        <?php
        $conn = new Admin;
        $conn->get_all_slide_data();
        ?>
    </table>

    <section>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $img_url = $_POST['img_url'];
            $visibility = $_POST['visibility'];

            $conn = new Admin;
            $conn->add_new_slide($img_url, $visibility);

            header('Location: http://localhost/public_html/dinamic-slide-gallery/');
            die();
        }
        ?>
        <form class="add-new-img" action="" method="post">
            <select name="visibility">
                <option value="1">show</option>
                <option value="0">hidde</option>
            </select>
            <input type="img_url" name="img_url">
            <button type="submit">creat</button>
        </form>

    </section>
</body>

</html>