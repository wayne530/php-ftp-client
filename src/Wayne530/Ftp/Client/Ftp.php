<?php

namespace Wayne530\Ftp\Client;

use Wayne530\Ftp\Client_Interface;

/**
 * FTP implementation
 *
 * @package Wayne530\Ftp\Client
 */
class Ftp extends Base implements Client_Interface {

    /** @inheritDoc */
    public function connect($host, $port) {
        return ftp_connect($host, $port);
    }

    /** @inheritDoc */
    public function authenticate($username, $password) {
        return @ftp_login($this->connection, $username, $password);
    }

    /** @inheritDoc */
    public function pwd() {
        return ftp_pwd($this->connection);
    }

    /** @inheritDoc */
    public function ls($path = null) {
        if (is_null($path)) {
            $path = '.';
        }
        return ftp_nlist($this->connection, $path);
    }

    /** @inheritDoc */
    public function rename($from, $to) {
        return ftp_rename($this->connection, $from, $to);
    }

    /** @inheritDoc */
    public function mkdir($path) {
        return is_string(ftp_mkdir($this->connection, $path));
    }

    /** @inheritDoc */
    public function rmdir($path) {
        return ftp_rmdir($this->connection, $path);
    }

    /**
     * set passive mode on/off (ftp/ftps-specific)
     *
     * @param bool $passive  whether passive mode should be enabled
     *
     * @return bool  mode change successful?
     */
    public function setPassive($passive = true) {
        return ftp_pasv($this->connection, $passive);
    }

}
