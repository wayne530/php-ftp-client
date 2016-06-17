<?php

namespace Wayne530\Ftp;

/**
 * FTP/FTPS/SFTP client interface
 *
 * @package Wayne530\Ftp
 */
interface Client_Interface {

    /**
     * create a connection
     *
     * @param string $host  host name or ip to connect to
     * @param int $port  port number to connect to
     *
     * @return resource  connection resource
     */
    public function connect($host, $port);

    /**
     * authenticate
     *
     * @param string $username  username
     * @param string $password  plaintext password
     *
     * @return bool  successfully authenticated?
     */
    public function authenticate($username, $password);

    /**
     * get working directory
     *
     * @return string
     */
    public function pwd();

    /**
     * list files in current working directory, or provided path
     *
     * @return array
     */
    public function ls($path = null);

    /**
     * rename source file/directory to target file/directory
     *
     * @param string $from  source file/directory
     * @param string $to  source file/directory
     *
     * @return bool  rename successful?
     */
    public function rename($from, $to);

    /**
     * create a new directory
     *
     * @param string $path  path to create; can be relative to the current working directory or absolute
     *
     * @return bool  creation successful?
     */
    public function mkdir($path);

    /**
     * remove a directory
     *
     * @param string $path  path to remove; relative to cwd or absolute
     *
     * @return bool  removal successful?
     */
    public function rmdir($path);

}
