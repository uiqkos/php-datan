<?php


interface Controller {
    public function all(): View;
    public function details(int $id): View;
    public function create(Model $object): View;
    public function update(Model $object): View;
    public function delete(int $id): View;
}