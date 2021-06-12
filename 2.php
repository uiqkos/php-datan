<?php

include "framework/model/Types.php";
include "framework/model/Model.php";

class MyModel extends Model {
    public string $name;
    public int $age;
    public DateTime $birth_date;

    public function __construct(string $name, int $age, DateTime $birth_date) {
        $this->name = $name;
        $this->age = $age;
        $this->birth_date = $birth_date;
    }
}

class MyModelController extends Controller {
    private Repository $myModelRepository;

    /**
     * MyModelController constructor.
     * @param Repository $myModelRepository
     */
    public function __construct(Repository $myModelRepository) {
        $this->myModelRepository = $myModelRepository;
    }

    public function getRepository(): Repository {
        return $this->myModelRepository;
    }
}