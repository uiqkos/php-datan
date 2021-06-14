<?php

require 'framework/html/base.php';

/**
 * @param array $col_names
 * @param array<Model> $objects
 */
function ListView(array $col_names, array $objects, $class = null) {
    title('List');
    blockBegin();
?>

    <table class="table">
        <thead>
        <tr> <?php foreach ($col_names as $col_name)
                echo "<th scope='col'>$col_name</th>"
            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($objects as $object) {
            echo "<tr>";
            foreach ($object->getValues() as $value)
                echo "<td>$value</td>";
            ?>
            <div class="btn-group btn-group-sm me-2 float-right" role="group" aria-label="First group">
            <a class="btn btn-outline-primary" href="<?php $Router->list()?>">All</a>
            <a class="btn btn-outline-primary" href="{{ root_path }}/{{ object.id }}/update">Edit</a>
            <a class="btn btn-outline-primary" href="{{ root_path }}/{{ object.id }}/delete">Delete</a>
            </div> <?php
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
<?php } blockEnd(); ?>