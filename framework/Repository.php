<?php

require "Status.php";
require 'model/ModelDecorator.php';

class Repository {
    private DBConfig $config;
    private ModelDecorator $modelDecorator;
    private string $table_name;
    private mysqli $connection;

    /**
     * Repository constructor.
     * @param DBConfig $config
     * @param $model
     * @param null $table_name
     * @throws ReflectionException
     */
    public function __construct(DBConfig $config, $model, $table_name = null) {
        $this->config = $config;

        if (is_null($table_name))
            $this->table_name = $model;
        else
            $this->table_name = $table_name;

        $this->connection = new mysqli(
            $config->hostname,
            $config->username,
            $config->password,
            $config->database
        );

        $this->modelDecorator = new ModelDecorator($model);

        $fields = array_map(
            function ($name, $value) {
                return "$name $value";
            },
            $this->modelDecorator->getFieldNames(),
            $this->modelDecorator->getFieldsAsString()
        );

        $fields = join(', ', $fields);

        if (!empty($this->getModelDecorator()->getForeignKeys())) {
            $foreign_keys = array_map(
                function ($key, $foreign_keys) {
                    $onDelete = $foreign_keys['onDelete'];
                    $foreign_key_name = $foreign_keys['key'];
                    return "foreign key ($key) references $foreign_key_name (id) on delete $onDelete";
                },
                array_keys($this->modelDecorator->getForeignKeys()),
                $this->modelDecorator->getForeignKeys()
            );
            $this->connection->query(
                "create table if not exists $this->table_name ($fields, ".
                join(', ', $foreign_keys).')'
            );
        } else {
            $this->connection->query(
                "create table if not exists $this->table_name ($fields)"
            );
        }


    }

    public function delete(int $id): int {
        $r = $this->connection->query(
            "delete from $this->table_name ".
                "where id=$id"
        );
        if ($r)
            return Status::Successful;
        return Status::ErrorNotFound;
    }

    public function findById(int $id): Model {
        $result = $this->connection->query(
            "select * from $this->table_name where id=$id"
        );
        if ($r = $result->fetch_assoc()){
            return $this->modelDecorator->fromArray($r);
        }
        throw new Exception("Cannot find object with id = $id");
    }

    public function findAll(): array {
        $result = $this->connection->query(
            "select * from $this->table_name"
        );
        $objects = array();
        while ($r = $result->fetch_assoc()) {
            array_push(
                $objects,
                $this->modelDecorator->fromArray($r)
            );
        }
        return $objects;
    }

    public function create(Model $object): Model {
        $fields = join(', ', $this->modelDecorator->getFieldNames());
        $values = join(', ', $this->modelDecorator->parseValuesToMySql($object));
        $this->connection->query(
            "insert into $this->table_name ($fields) values ($values)"
        );
        return $object->setId($this->connection->insert_id);
    }

    public function update(Model $object) {
        $setters = join(', ', array_map(
            function ($name, $value) {
                return "$name=$value";
            },
            $this->modelDecorator->getFieldNames(),
            $this->modelDecorator->parseValuesToMySql($object)
        ));
        $id = $object->getId();
        $this->connection->query(
            "update $this->table_name set $setters where id = $id"
        );
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

    /**
     * @return ModelDecorator
     */
    public function getModelDecorator(): ModelDecorator {
        return $this->modelDecorator;
    }

    public function getFieldNames(): array {
        return $this->modelDecorator->getFieldNames();
    }

    public function getFieldNamesWithoutId(): array {
        return array_filter(
            $this->modelDecorator->getFieldNames(),
            function ($s) { return $s != 'id'; }
        );
    }

}