<?php
include '../dinamic-slide-gallery/admin.php';
$id = $_GET['id'];
$conn = new Admin;
$result = $conn->get_slide_where($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo $id, '<br>';
    echo $img_url = $_POST['img_url'], '<br>';
    echo $visibility = $_POST['visibility'];

    $conn = new Admin;
    $conn->update_slide($id, $img_url, $visibility);

    header('Location: http://localhost/public_html/dinamic-slide-gallery/');
    die();
}

echo '
<div class="updateImg">
<form action="" method="post">
    <span>' . $result->id . '</span>
    <select name="visibility">
        <option value="1">show</option>
        <option value="0">hidde</option>
    </select>
    <input type="img_url" name="img_url" value="' . $result->img_url . '">
    <button type="submit">update</button>
</form>
</div>
    ';

