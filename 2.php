<?php

include "framework/model/Types.php";
include "framework/model/Model.php";
include "framework/Controller.php";

class Lecturer extends Model {
    /**
     * @var string
     * @toString
     * @translated ФИО
     */
    public string $name;
    /**
     * @var int
     * @translated Возраст
     */
    public int $age;
    public DateTime $birth_date;
    /**
     * @var int
     * @toString
     */
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

class Car extends Model {
    /**
     * @var string
     * @applyToString true
     * @translated Бренд
     */
    public string $brand;
    /**
     * @var DateTime
     * @translated Дата_покупки
     */
    public DateTime $buy_date;
    /**
     * @var int
     * @ref Lecturer
     * @onDelete CASCADE
     */
    public int $lecturer_id;

    /**
     * Car constructor.
     * @param string $brand
     * @param DateTime $buy_date
     * @param int $lecturer_id
     */
    public function __construct(string $brand, DateTime $buy_date, int $lecturer_id) {
        $this->brand = $brand;
        $this->buy_date = $buy_date;
        $this->lecturer_id = $lecturer_id;
    }

}
