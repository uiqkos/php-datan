<!DOCTYPE html>
before
<?php function get_index($fields) { ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    Hello,
    <?php
        foreach ($fields as $field) {
            echo $field;
            echo '<br>';
        }
    ?>
</body>
</html>
<?php }?>