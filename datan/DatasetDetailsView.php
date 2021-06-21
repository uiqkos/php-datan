<?php

/**
 * @param Dataset $dataset
 * @param int $likes_count
 * @param Controller $comment_controller
 * @param Controller $like_controller
 * @throws Exception
 */
function DatasetDetailsView(Dataset $dataset, int $likes_count, Controller $comment_controller, Controller $like_controller) {

    DetailsView($dataset);
    $user_id = UserController::getCurrentUserId();
    $dataset_id = $dataset->getId();
    $current_date = (new DateTime('now'))->format('Y-m-d');
    ?>
    <?php
    if ($like = $like_controller->getRepository()->isLikes($user_id)) {
        $like_id = $like->getId();
    ?>
        <form action="<?php echo '..'.$like_controller->getRouter()->getDeleteRoute()."?id=$like_id"?>" method="post">
    <?php } else ?>
    <form action="<?php echo '..'.$like_controller->getRouter()->getCreateRoute()."?user_id=$user_id&dataset_id=$dataset_id&date=$current_date"?>" method="post">



        <div class="form-group">
        <button type="submit"
            class="btn btn-primary"
            name="redirect"

            value="<?php echo $_SERVER['REQUEST_URI'] ?>"
        >
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
        </svg>
        <?php echo $likes_count; ?> </button>
    </div>
    </form>
    <?php ListView(
        $comment_controller->getRepository()->getModelDecorator()->getTranslatedFieldNames(),
        $comment_controller->getRepository()->findAll(),
        $comment_controller->getRouter()
    ); ?>


    <form action="<?php echo '..'.$comment_controller->getRouter()->getCreateRoute()."?dataset_id=$dataset_id&user_id=$user_id&date=$current_date" ?>" method="post">
        <div class="form-group">
        <label for="field">Тема</label>
        <input
            type="text"
            class="form-control"
            name="name"
            id="field"
        >
        </div>
        <div class="form-group">
        <label for="field">Комментарий</label>
        <input
            type="text"
            class="form-control"
            name="text"
            id="field"
        >
        </div>
        <div class="form-group">
        <div class="form-group">

            <button type="submit"
                    class="btn btn-primary"
                    name="redirect"
                    value="<?php echo $_SERVER['REQUEST_URI'] ?>"
            > Comment </button>
        </div>
    </form>

<?php } ?>