<?php

include "view/DeleteView.php";
include "view/CreateView.php";
include "view/DetailsView.php";
include "view/UpdateView.php";
include "view/ListView.php";

class Controller {
    private Repository $repository;
    private Router $router;
    private string $model_name;

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

        $this->model_name = $prefix;
        $this->router = new Router($this, $prefix);
    }

    public function all() {
        head("List of $this->model_name".'s');
        blockBegin();
        ListView(
            $this->getRepository()->getModelDecorator()->getTranslatedFieldNames(),
            $this->getRepository()->findAll(),
            $this->router
        );
        blockEnd();
    }

    public function details(int|string $id) {
        if (is_string($id))
            $id = intval($id);
        head("Details about $this->model_name ($id)");
        blockBegin();
        DetailsView(
            $this
                ->getRepository()
                ->findById($id)
        );
        blockEnd();
    }

    public function create() {
        head("Create $this->model_name");
        blockBegin();
        CreateView(
            $this
                ->getRepository()
                ->getFieldNamesWithoutId(),
            $this
                ->getRepository()
                ->getModelDecorator()
                ->getTranslatedFieldNames(),
            $this->router->getListRoute(),
            $this->router
        );
        blockEnd();
    }

    public function update(int|string $id) {
        if (is_string($id))
            $id = intval($id);
        head("Edit $this->model_name ($id)");
        blockBegin();
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
        blockEnd();
    }

    public function delete(int|string $id) {
        if (is_string($id))
            $id = intval($id);

        head("Delete $this->model_name ($id)");
        blockBegin();
        DeleteView(
            $this
                ->getRepository()
                ->findById($id),
            $this->router->getListRoute(),
            $this->router
        );
        blockEnd();
    }

    public function getRepository(): Repository {
        return $this->repository;
    }

    /**
     * @return string|null
     */
    public function getModelName(): ?string {
        return $this->model_name;
    }

    /**
     * @return Router
     */
    public function getRouter(): Router {
        return $this->router;
    }
}