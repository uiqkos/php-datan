<?php

include "view/DeleteView.php";
include "view/CreateView.php";
include "view/DetailsView.php";
include "view/UpdateView.php";
include "view/ListView.php";

class Controller {
    private Repository $repository;
    private Router $router;

    /**
     * Controller constructor.
     * @param Repository $repository
     * @param string|null $prefix
     */
    public function __construct(Repository $repository, string $prefix = null) {
        $this->repository = $repository;

        if (is_null($prefix)) {
            $prefix = strtolower($repository
                ->getModelDecorator()
                ->getModel()
            );
        }

        $this->router = new Router($this, $prefix);
    }

    public function all() {
        ListView(
            $this->getRepository()->getFieldNames(),
            $this->getRepository()->findAll(),
            $this->router
        );
    }

    public function details(int|string $id) {
        if (is_string($id))
            $id = intval($id);
        DetailsView(
            $this
                ->getRepository()
                ->findById($id)
        );
    }

    public function create() {
        CreateView(
            $this
                ->getRepository()
                ->getFieldNamesWithoutId(),
            $this->router
        );
    }

    public function update(int|string $id) {
        if (is_string($id))
            $id = intval($id);
        UpdateView(
            $this
                ->getRepository()
                ->getFieldNames(),
            $this
                ->getRepository()
                ->findById($id)
                ->getValues(),
            $this->router
        );
    }

    public function delete(int|string $id) {
        if (is_string($id))
            $id = intval($id);
        DeleteView(
            $this
                ->getRepository()
                ->findById($id),
            $this->router
        );
    }

    public function getRepository(): Repository {
        return $this->repository;
    }
}