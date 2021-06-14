<?php

include "view/DeleteView.php";
include "view/CreateView.php";
include "view/DetailsView.php";
include "view/UpdateView.php";
include "view/ListView.php";

class Controller {
    private Repository $repository;

    /**
     * Controller constructor.
     * @param Repository $repository
     */
    public function __construct(Repository $repository) {
        $this->repository = $repository;
    }

    public function all() {
        ListView(
            $this->getRepository()->getFieldNames(),
            $this->getRepository()->findAll()
        );
    }

    public function details(int $id) {
        DetailsView(
            $this
                ->getRepository()
                ->getFieldNames(),
            $this
                ->getRepository()
                ->getModelDecorator()
                ->toArray(
                    $this
                        ->getRepository()
                        ->findById($id)
            )
        );
    }

    public function create() {
        $this
            ->getRepository()
            ->create(
            $this
                ->getRepository()
                ->getModelDecorator()
                ->fromArray(
                    CreateView(
                        $this
                            ->getRepository()
                            ->getFieldNames()
                    )
            )
        );
    }

    public function update() {
        $this->getRepository()->create(
            $this
                ->getRepository()
                ->getModelDecorator()
                ->fromArray(
                UpdateView(
                    $this
                        ->getRepository()
                        ->getFieldNames()
                )
            )
        );
    }

    public function delete(int $id) {
        DeleteView(
            strval(
                $this
                    ->getRepository()
                    ->findById($id)
            )
        );
    }

    public function getRepository(): Repository {
        return $this->repository;
    }
}