<?php

include "framework/model/Types.php";
include "framework/model/Model.php";
include "framework/Fields.php";

class MyModel implements Model {
    public int $id;
    public string $name;
    public int $age;
    public DateTime $birth_date;

    public function __construct(string $name, int $age, DateTime $birth_date) {
        $this->name = $name;
        $this->age = $age;
        $this->birth_date = $birth_date;
    }

    public static function getTableName(): string {
        return 'my_table';
    }

    public static function fromFields(array $fields): Model {
        return new MyModel(
            $fields['name'],
            $fields['age'],
            DateTime::createFromFormat(
                'Y-m-d', $fields['birth_date']
            )
        );
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