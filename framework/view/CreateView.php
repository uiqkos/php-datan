<?php function CreateView(array $col_names, array $translated_col_names, Router $router) {
    head('Hello');
    blockBegin();
?>
    <form action="<?php echo '..'.$router->getCreateRoute()?>" method="post">
        <?php foreach (array_map(
                null,
                $col_names,
                $translated_col_names
           ) as list($col_name, $translated)) { ?>
        <div class="form-group">
            <label for="field"><?php echo $translated ?></label>
            <input
                type="text"
                class="form-control"
                name="<?php echo $col_name ?>"
                id="field"
            >
        </div>
        <?php } ?>
        <button
            type="submit"
            class="btn btn-primary"
            name="redirect"
            value="<?php echo $router->getListRoute() ?>"
        >Submit</button>
    </form>
<?php
blockEnd();
} ?>