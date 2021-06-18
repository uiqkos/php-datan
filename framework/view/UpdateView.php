<?php function UpdateView(array $col_names, array $values, Router $router) {
    head('Hello');
    blockBegin();
?>
    <form action="<?php echo '..'.$router->getUpdateRoute()?>" method="post">
        <?php foreach (array_map(null, $col_names, $values) as list($col_name, $value)) { ?>
            <div class="form-group">
                <label for="field"><?php echo $col_name ?></label>
                <input
                    type="text"
                    class="form-control"
                    name="<?php echo $col_name ?>"
                    id="field"
                    value="<?php echo $value ?>"
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
