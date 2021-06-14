<?php

include "framework/model/Types.php";
include "framework/model/Model.php";
include "framework/Controller.php";

/**
 * @Models
 */
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

class Lecturer extends Model {
    public string $name;
    public int $age;
    public DateTime $birth_date;
    public int $experience;
    public string $subject;
    public string $car_number;
    public string $address;

    /**
     * Lecturer constructor.
     * @param string $name
     * @param int $age
     * @param DateTime $birth_date
     * @param int $experience
     * @param string $subject
     * @param string $car_number
     * @param string $address
     */
    public function __construct(string $name, int $age, DateTime $birth_date, int $experience, string $subject, string $car_number, string $address) {
        $this->name = $name;
        $this->age = $age;
        $this->birth_date = $birth_date;
        $this->experience = $experience;
        $this->subject = $subject;
        $this->car_number = $car_number;
        $this->address = $address;
    }

}

class LecturerController extends Controller {
    private Repository $lecturerRepository;

    public function __construct(DBConfig $config, $model) {
        $this->lecturerRepository = new Repository($config, $model);
    }

    public function getRepository(): Repository {
        return $this->lecturerRepository;
    }
}

class MyModelController extends Controller {
    private Repository $myModelRepository;

    /**
     * @throws ReflectionException
     */
    public function __construct(DBConfig $config, $model) {
        $this->myModelRepository = new Repository($config, $model);
    }

    public function getRepository(): Repository {
        return $this->myModelRepository;
    }
}