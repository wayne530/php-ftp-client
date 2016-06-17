<?php

namespace Wayne530\Ftp\Client;

use Wayne530\Ftp\Client_Interface;

/**
 * SFTP implementation
 *
 * @package Wayne530\Ftp\Client
 */
class Sftp extends Base implements Client_Interface {

    /** @var resource  ssh2 connection resource */
    protected $sshConnection;

    /** @override */
    protected $defaultPort = 22;

    /** @inheritDoc */
    public function connect($host, $port) {
        $this->sshConnection = ssh2_connect($host, $port);
        return null;
    }

    /** @inheritDoc */
    public function authenticate($username, $password) {
        return $this->authenticateByPassword($username, $password);
    }

    /**
     * authenticate by username and plaintext password
     *
     * @param string $username  username
     * @param string $password  password
     *
     * @return bool
     */
    public function authenticateByPassword($username, $password) {
        $success = ssh2_auth_password($this->sshConnection, $username, $password);
        if ($success) {
            $this->postAuthenticate();
        }
        return $success;
    }

    /**
     * authenticate by username and key file
     *
     * @param string $username  username
     * @param string $publicKeyFile  path to public key file
     * @param string $privateKeyFile  path to private key file
     * @param string|null $privateKeyPassphrase  plaintext private key passphrase; null if private key not protected by passphrase
     *
     * @return bool
     */
    public function authenticateByKey($username, $publicKeyFile, $privateKeyFile, $privateKeyPassphrase = null) {
        $success = ssh2_auth_pubkey_file($this->sshConnection, $username, $publicKeyFile, $privateKeyFile, $privateKeyPassphrase);
        if ($success) {
            $this->postAuthenticate();
        }
        return $success;
    }

    /**
     * method to call after authentication
     */
    public function postAuthenticate() {
        // initialize the sftp subsystem
        $this->connection = ssh2_sftp($this->sshConnection);
    }

    /** @inheritDoc */
    public function pwd() {
        // TODO: Implement pwd() method.
    }

    /** @inheritDoc */
    public function ls($path = null) {
        // TODO: Implement ls() method.
    }

    /** @inheritDoc */
    public function rename($from, $to) {
        return ssh2_sftp_rename($this->connection, $from, $to);
    }

    /** @inheritDoc */
    public function mkdir($path) {
        /** @todo: path mode should be specifiable */
        return ssh2_sftp_mkdir($this->connection, $path, 0755);
    }

    /** @inheritDoc */
    public function rmdir($path) {
        return ssh2_sftp_rmdir($this->connection, $path);
    }

}
