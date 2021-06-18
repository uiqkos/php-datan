<?php function CreateView(array $col_names, Router $router) {
    head('Hello');
    blockBegin();
?>
    <form action="<?php echo '..'.$router->getCreateRoute()?>" method="post">
        <?php foreach ($col_names as $col_name) { ?>
        <div class="form-group">
            <label for="field"><?php echo $col_name ?></label>
            <input
                type="text"
                class="form-control"
                name="<?php echo $col_name ?>"
                id="field"
                placeholder="Enter <?php echo $col_name ?>"
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