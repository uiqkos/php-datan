<?php function ListView(array $col_names, array $objects) {?>
    <table>
        <tr> <?php foreach ($col_names as $col_name)
                echo "<td>$col_name</td>"
            ?>
        </tr>
        <?php
        foreach ($objects as $object) {
            echo "<tr>";
            foreach ($object->getValues() as $value)
                echo "<td>$value</td>";
            echo "</tr>";
        }
        ?>
    </table>"
<?php } ?>