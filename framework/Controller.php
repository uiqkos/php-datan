<?php

include "view/DeleteView.php";
include "view/CreateView.php";
include "view/DetailsView.php";
include "view/UpdateView.php";
include "view/ListView.php";

abstract class Controller {
    
    public function all(): callable {
        return function () {
            ListView(
                $this->getRepository()->getFieldNames(),
                $this->getRepository()->findAll()
            );
        };
    }

    public function details(int $id): callable {
        return function () use ($id) {
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
        };
    }

    public function create(): callable {
        return function () {
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
        };
    }

    public function update(): callable {
        return function () {
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
        };
    }

    public function delete(int $id): callable {
        return function () use ($id) {
            DeleteView(
                strval(
                    $this
                        ->getRepository()
                        ->findById($id)
                )
            );
        };
    }

    public abstract function getRepository(): Repository;
}