<?php


class Router {
    private static string $root_path;

    public static function route(string $path) {
        self::$root_path = $path;
    }

    public static function getRootPath(): string {
        return self::$root_path;
    }

}