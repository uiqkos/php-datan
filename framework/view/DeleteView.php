<?php function DeleteView(Model $obj, Router $router): bool {
    head("Delete $obj");
    blockBegin();
    $id = $obj->getId();
echo "<h1>Вы уверены, что хотите удалить $obj ?</h1>"; ?>

    <form action="<?php echo '..'.$router->getDeleteRoute()."?id=$id"?>" method="post">
        <button
            type="submit"
            name="redirect"
            value="<?php echo $router->getListRoute()?>"
            class="btn btn-outline-danger">Удалить</button>
    </form>
    <a href="<?php echo $router->getListRoute()?>" class="btn btn-outline-secondary">Отмена</a>


    <?php blockEnd(); return true; } ?>
