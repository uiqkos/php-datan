<?php

require 'framework/html/base.php';

/**
 * @param array $col_names
 * @param array<Model> $objects
 */
function ListView(array $col_names, array $objects, Router $router) {
    head('List');
    blockBegin();
?>
    <table class="table">
        <thead>
        <tr> <?php foreach ($col_names as $col_name)
                echo "<th scope='col'>$col_name</th>"
            ?>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($objects as $object) {
            $id = $object->getId();
            echo "<tr>";
            foreach ($object->getValues() as $value)
                echo "<td>$value</td>";
            ?>
            <td>
                <div class="btn-group btn-group-sm me-2 float-right" role="group" aria-label="First group">
                    <a class="btn btn-light" href="<?php echo $router->getDetailsRoute() . "?id=$id"?>">Details</a>
                    <a class="btn btn-light" href="<?php echo $router->getUpdateRoute() . "?id=$id"?>">Edit</a>
                    <a class="btn btn-light" href="<?php echo $router->getDeleteRoute() . "?id=$id"?>">Delete</a>
                </div>
            </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } blockEnd(); ?>