<?php


interface Controller {
    public function all(): string;
    public function details(int $id): string;
    public function create(Model $object): string;
    public function update(Model $object): string;
    public function delete(int $id): string;
}