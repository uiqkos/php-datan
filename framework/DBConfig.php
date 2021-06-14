<?php


class DBConfig {
    public string $hostname;
    public string $username;
    public string $password;
    public string $database;

    /**
     * DBConfig constructor.
     * @param string $hostname
     * @param string $username
     * @param string $password
     * @param string $database
     */
    public function __construct(string $hostname, string $username, string $password, string $database) {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }


    /**
     * @param string $username
     * @return DBConfig
     */
    public function setUsername(string $username): DBConfig {
        $this->username = $username;
        return $this;
    }

    /**
     * @param string $hostname
     * @return DBConfig
     */
    public function setHostname(string $hostname): DBConfig {
        $this->hostname = $hostname;
        return $this;
    }

    /**
     * @param string $password
     * @return DBConfig
     */
    public function setPassword(string $password): DBConfig {
        $this->password = $password;
        return $this;
    }

    /**
     * @param string $database
     * @return DBConfig
     */
    public function setDatabase(string $database): DBConfig {
        $this->database = $database;
        return $this;
    }

}