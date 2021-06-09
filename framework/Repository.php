<?php


class Repository {
    private DBConfig $config;
    private $model;
    private string $table_name;
    private mysqli $connection;

    /**
     * Repository constructor.
     * @param DBConfig $config
     * @param $model
     */
    public function __construct(DBConfig $config, $model) {
        $this->config = $config;
        $this->model = $model;
        $this->table_name = $model::getTableName();
        $this->connection = new mysqli(
            $config->hostname,
            $config->username,
            $config->password,
            $config->database
        );
    }

    public function delete(int $id): int {
        $r = $this->connection->query(
            "delete * from $this->table_name".
                "where $this->model->getIdName()=$id"
        );
        if ($r)
            return Status::Successful;
        return Status::ErrorNotFound;
    }

    public function findById(int $id): Model {
        $result = $this->connection->query(
            "select * from $this->table_name where $this->model->getIdName()=$id"
        );
        if ($r = $result->fetch_assoc()){
            return $this->model::fromFields($r);
        }
        throw new Exception('Cannot find object with id = $id');
    }

    public function findAll(): array {
        $result = $this->connection->query(
            "select * from $this->table_name"
        );
        $objects = array();
        while ($r = $result->fetch_assoc()) {
            array_push($objects, $this->model::fromFields($r));
        }
        return $objects;
    }

    public function save(Model $object): bool {
        $values = join(', ', $object->getValues());
        $query = "insert into $this->table_name values (null, $values);";
        $r = $this->connection->query(
            $query
        );
        print "hello, $query";
        return $r;
    }

    /**
     * @return DBConfig
     */
    public function getConfig(): DBConfig {
        return $this->config;
    }

    /**
     * @param DBConfig $config
     * @return Repository
     */
    public function setConfig(DBConfig $config): Repository {
        $this->config = $config;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel() {
        return $this->model;
    }

    /**
     * @param mixed $model
     * @return Repository
     */
    public function setModel($model) {
        $this->model = $model;
        return $this;
    }

    /**
     * @return string
     */
    public function getTableName(): string {
        return $this->table_name;
    }

    /**
     * @param string $table_name
     * @return Repository
     */
    public function setTableName(string $table_name): Repository {
        $this->table_name = $table_name;
        return $this;
    }

}