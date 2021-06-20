<?php
/**
 * @param array<Controller> $controllers
 */
function HomeView(array $controllers) {
head("Home");
blockBegin();
?>
    <?php foreach ($controllers as $controller) { ?>
    <h3><?php echo strtoupper($controller->getModelName())?>S</h3>
    <a class="btn btn-light" href="<?php echo $controller->getRouter()->getListRoute()?>">All</a>
    <a class="btn btn-light" href="<?php echo $controller->getRouter()->getCreateRoute()?>">Create</a>
    <?php } ?>

<?php blockEnd(); }?>