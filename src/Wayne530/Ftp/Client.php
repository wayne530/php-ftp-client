<?php

namespace Wayne530\Ftp;
use Wayne530\Ftp\Exception\AuthenticationException;

/**
 * FTP/FTPS/SFTP connection factory
 *
 * @package Wayne530\Ftp
 */
class Client {

    // implementation types
    const TYPE_FTP = 'ftp';
    const TYPE_FTPS = 'ftps';
    const TYPE_SFTP = 'sftp';

    /**
     * connection factory
     *
     * @throws AuthenticationException
     *
     * @param string $type  connection type (see constants above)
     * @param string $host  host or ip to connect to
     * @param string $username  username
     * @param string $password  password
     * @param int|null $port  port to connect to; null for default port based on connection type
     *
     * @return Client_Interface
     */
    public static function createConnection($type = self::TYPE_SFTP, $host, $username, $password, $port = null) {
        $implementationClass = __NAMESPACE__ . '\\' . ucfirst($type);
        /** @var Client_Interface $implementation */
        $implementation = new $implementationClass($host, $port);
        if (! $implementation->authenticate($username, $password)) {
            throw new AuthenticationException('Unable to authenticate for username ' . $username);
        }
        return $implementation;
    }

}
