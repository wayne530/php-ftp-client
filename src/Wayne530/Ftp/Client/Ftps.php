<?php

namespace Wayne530\Ftp\Client;

use Wayne530\Ftp\Client_Interface;

/**
 * FTPS implementation
 *
 * @package Wayne530\Ftp\Client
 */
class Ftps extends Ftp implements Client_Interface {

    /** @override */
    public function connect($host, $port) {
        return @ftp_ssl_connect($host, $port);
    }

}
