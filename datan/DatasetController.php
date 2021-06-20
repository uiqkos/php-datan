<?php

//require 'framework/Controller.php';

require 'datan/DatasetDetailsView.php';

class DatasetController extends Controller {

    private Controller $comment_controller;
    private Controller $like_controller;

    public function __construct(Repository $repository, Controller $comment_controller, Controller $like_controller, string $prefix = null) {
        parent::__construct($repository, $prefix);
        $this->like_controller = $like_controller;
        $this->comment_controller = $comment_controller;
    }

    public function details(int|string $id) {
        head("Details about dataset ($id)");
        blockBegin();
        if (is_string($id)) $id = intval($id);
        DatasetDetailsView(
            $this->getRepository()->findById($id),
            sizeof($this->like_controller->getRepository()->findAll()),
            $this->comment_controller,
            $this->like_controller
        );
        blockEnd();
    }
}