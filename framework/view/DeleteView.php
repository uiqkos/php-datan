<?php function DeleteView(Model $obj, string $redirect_url, Router $router): bool {
    $id = $obj->getId();
echo "<h1>Вы уверены, что хотите удалить $obj ?</h1>"; ?>

    <form action="<?php echo '..'.$router->getDeleteRoute()."?id=$id"?>" method="post">
        <button
            type="submit"
            name="redirect"
            value="<?php echo $redirect_url?>"
            class="btn btn-outline-danger">Удалить</button>
    </form>
    <a href="<?php echo $router->getListRoute()?>" class="btn btn-outline-secondary">Отмена</a>


    <?php  return true; } ?>
