<?php

include "framework/model/Types.php";
include "framework/model/Model.php";

class MyModel implements Model {
    public string $name;
    public int $age;
    public DateTime $birth_date;

    private static array $fields = array();
    private static array $field_names = ['name', 'age', 'birth_date'];

    static function init() {
        self::$fields['id']         = new Id();
        self::$fields['name']       = new StringField();
        self::$fields['age']        = new IntegerField();
        self::$fields['birth_date'] = new DateField();
    }

    public function __construct(string $name, int $age, DateTime $birth_date) {
        $this->name = $name;
        $this->age = $age;
        $this->birth_date = $birth_date;
    }
    public static function getFields(): array {
        return self::$fields;
    }
    public static function getFieldNames(): array {
        return self::$field_names;
    }
    public static function getTableName(): string {
        return 'my_table';
    }

    public static function fromFields(array $fields): Model {
        return new MyModel(...$fields);
    }

    public static function getIdName(): string {
        return 'id';
    }

    public static function getValues(): array {
        return array_values(self::$fields);
    }
}

class MyModelController implements Controller {
    private Repository $myModelRepository;

    /**
     * MyModelController constructor.
     * @param Repository $myModelRepository
     */
    public function __construct(Repository $myModelRepository) {
        $this->myModelRepository = $myModelRepository;
    }

    public function all(): string {
        return ListView(MyModel::getFieldNames(), $this->myModelRepository->findAll());
    }

    public function details(int $id): string {
        // TODO: Implement details() method.
    }

    public function create(Model $object): string {
        // TODO: Implement create() method.
    }

    public function update(Model $object): string {
        // TODO: Implement update() method.
    }

    public function delete(int $id): string {
        // TODO: Implement delete() method.
    }
}