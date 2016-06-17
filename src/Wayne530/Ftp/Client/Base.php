<?php

namespace Wayne530\Ftp\Client;

use Wayne530\Ftp\Client_Interface;
use Wayne530\Ftp\Exception\ConnectionException;

/**
 * FTP implementation
 *
 * @package Wayne530\Ftp\Client
 */
abstract class Base implements Client_Interface {

    /** @var resource  connection resource */
    protected $connection;

    /** @var int  default connection port */
    protected $defaultPort = 21;

    /**
     * Base constructor
     *
     * @throws ConnectionException
     *
     * @param string $host  host or ip to connect to
     * @param int|null $port  (optional) port; use default port if not specified
     */
    public function __construct($host, $port = null) {
        if (is_null($port)) {
            $port = $this->defaultPort;
        }
        $this->connection = $this->connect($host, $port);
        if ($this->connection === false) {
            throw new ConnectionException('Unable to create ' . $this->getType() . ' connection to ' . $host . ':' . $port);
        }
    }

    /**
     * Base destructor
     */
    public function __destruct() {
        unset($this->connection);
    }

    /**
     * return the implementation type name (usually just the class name)
     *
     * @return string
     */
    public function getType() {
        return (new \ReflectionClass($this))->getShortName();
    }

}
