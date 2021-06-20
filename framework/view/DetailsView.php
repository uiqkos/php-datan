


<?php
//require 'framework/html/base.php';

function DetailsView(Model $object) {
    $name = $object::class;
?>
    <h1><?php echo $object; ?></h1>
    <table class="table table-hover">
        <tbody>

            <?php
            foreach (array_map(null,
                $object->getValues(),
                $object->getTranslatedFieldNames()
             ) as list($value, $field_name))
                echo "<tr><th scope='row'>$field_name</th><td>$value</td></th></tr>";
            ?>


        </tbody>
    </table>

<?php
}
?>