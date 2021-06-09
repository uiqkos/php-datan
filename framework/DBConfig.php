<?php


class DBConfig {
    public string $username;
    public string $hostname;
    public string $password;
    public string $database;

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