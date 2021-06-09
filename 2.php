<?php

include "framework/model/Types.php";
include "framework/model/Model.php";

class MyModel implements Model {
    public string $name;
    public int $age;
    public DateTime $birth_date;

    private static $fields;

    static function init() {
        self::$fields = (new Fields())
            ->add('id', new Id())
            ->add('name', new StringField())
            ->add('age', new IntegerField())
            ->add('birth_date', new DateField());
    }

    public function __construct(string $name, int $age, DateTime $birth_date) {
        $this->name = $name;
        $this->age = $age;
        $this->birth_date = $birth_date;
    }
    public static function getFields(): Fields {
        return self::$fields;
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

    public function getValues(): array {
        return [
            "'$this->name'",
            $this->age,
            "'".$this->birth_date->format("Y-m-d")."'"
        ];
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

    public function all(): View {
        return new View(ListView, [
            MyModel::getFieldNames(),
            $this->myModelRepository->findAll()
        ]);
    }

    public function details(int $id): View {

    }

    public function create(Model $object): View {
        // TODO: Implement create() method.
    }

    public function update(Model $object): View {
        // TODO: Implement update() method.
    }

    public function delete(int $id): View {
        // TODO: Implement delete() method.
    }
}