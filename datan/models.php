<?php

include 'framework/model/Model.php';


class User extends Model {
    /**
     * @var string
     * @applyToString()
     * @translated(Полное имя)
     */
    public string $full_name;
    /**
     * @var DateTime
     * @translated(Дата рождения)
     */
    public DateTime $birth_date;
    /**
     * @var string
     * @translated(Компания)
     */
    public string $company;
    /**
     * @var DateTime
     * @translated(Дата регистрации)
     */
    public DateTime $register_date;

    /**
     * @var string
     */
    public string $password;

    /**
     * User constructor.
     * @param string $full_name
     * @param DateTime $birth_date
     * @param string $company
     * @param DateTime $register_date
     * @param string $password
     */
    public function __construct(string $full_name, DateTime $birth_date, string $company, DateTime $register_date, string $password) {
        $this->full_name = $full_name;
        $this->birth_date = $birth_date;
        $this->company = $company;
        $this->register_date = $register_date;
        $this->password = $password;
    }


}

class Dataset extends Model {
    /**
     * @var string
     * @translated(Название)
     * @applyToString()
     */
    public string $name;
    /**
     * @var string
     * @translated(Описание)
     */
    public string $desc;
    /**
     * @var DateTime
     * @translated(Дата публикации)
     * @applyToString()
     */
    public DateTime $public_date;
    /**
     * @var int
     * @translated(Идентификатор автора)
     * @ref(User)
     * @onDelete(cascade)
     */
    public int $user_id;
    /**
     * @var string
     * @translated(Хэш)
     */
    public string $hash;

    /**
     * Dataset constructor.
     * @param string $name
     * @param string $desc
     * @param DateTime $public_date
     * @param int $author_id
     * @param string $hash
     */
    public function __construct(string $name, string $desc, DateTime $public_date, int $author_id, string $hash) {
        $this->name = $name;
        $this->desc = $desc;
        $this->public_date = $public_date;
        $this->user_id = $author_id;
        $this->hash = $hash;
    }

}

class Comment extends Model {
    /**
     * @var string
     * @applyToString()
     * @translated(Название)
     */
    public string $name;
    /**
     * @var string
     * @translated(Текст комментария)
     */
    public string $text;
    /**
     * @var int
     * @translated(Идентификатор автора)
     * @ref(User)
     * @onDelete(cascade)
     */
    public int $user_id;
    /**
     * @var int
     * @translated(Идентификатор датасета)
     * @ref(Dataset)
     * @onDelete(cascade)
     */
    public int $dataset_id;
    /**
     * @var DateTime
     * @translated(Дата публикации)
     * @applyToString()
     */
    public DateTime $date;

    /**
     * Comment constructor.
     * @param string $name
     * @param string $text
     * @param int $author_id
     * @param int $dataset_id
     * @param DateTime $date
     */
    public function __construct(string $name, string $text, int $author_id, int $dataset_id, DateTime $date) {
        $this->name = $name;
        $this->text = $text;
        $this->user_id = $author_id;
        $this->dataset_id = $dataset_id;
        $this->date = $date;
    }

}

class Like extends Model {
    /**
     * @var DateTime
     * @translated(Дата)
     */
    public DateTime $date;
    /**
     * @var int
     * @translated(Идентификатор пользователя)
     * @ref(User)
     * @onDelete(cascade)
     */
    public int $user_id;
    /**
     * @var int
     * @translated(Идентификатор датасета)
     * @ref(Dataset)
     * @onDelete(cascade)
     */
    public int $dataset_id;

    /**
     * Like constructor.
     * @param DateTime $date
     * @param int $user_id
     * @param int $dataset_id
     */
    public function __construct(DateTime $date, int $user_id, int $dataset_id) {
        $this->date = $date;
        $this->user_id = $user_id;
        $this->dataset_id = $dataset_id;
    }

}
