<?php

namespace qbilal\imap;

use Yii;
use qbilal\imap\Mailbox;
use yii\base\Exception;
use yii\base\InvalidConfigException;

/**
 * 
 * All rights reserved.
 * Date : 19-07-2019
 * Class can be used for connecting and extracting Email messages.
 */

/**
 * Imap Component
 *
 * To use Imap, you should configure it in the application configuration like the following,
 *
 * ~~~
 * 'components' => [
 *     ...
 *     'imap' => [
 *         'class' => 'vendor\qbilal\yii2-imap\Imap',
 *         'connection' => [
 *             'imapPath' => '{imap.gmail.com:993/imap/ssl}INBOX',
 *             'imapLogin' => 'username',
 *             'imapPassword' => 'password',
 *             'serverEncoding' => 'encoding', // utf-8 default.
 *             'searchEncoding' => 'encoding',//MIME character set to use when searching strings
 *             'decodeMimeStr' => false // Return as is, default -> true
 *         ],
 *     ],
 *     ...
 * ],
 * ~~~
**/

class Imap extends Mailbox
{
    private $_connection = [];

    /**
     * @param array
     * @throws InvalidConfigException on invalid argument.
     */
    public function setConnection($connection)
    {
        if (!is_array($connection)) {
            throw new InvalidConfigException('You should set connection params in your config. Please read yii2-imap doc for more info');
        }
        $this->_connection = $connection;
    }

    /**
     * @return array
     */
    public function getConnection()
    {
        if ($this->_connection instanceof Imap) {
            return $this->_connection;
        }
        $this->_connection = $this->createConnection();
        return $this->_connection;
    }

    /**
     * @return $this
     * @throws Exception
     */
    public function createConnection()
    {
        $this->imapPath = $this->_connection['imapPath'];
        $this->imapLogin = $this->_connection['imapLogin'];
        $this->imapPassword = $this->_connection['imapPassword'];
        $this->serverEncoding = $this->_connection['serverEncoding'];
        $this->attachmentsDir = $this->_connection['attachmentsDir'];
        //Optional decoding of the MIME-string
        if (isset($this->_connection['decodeMimeStr'])) {
            $this->decodeMimeStr = $this->_connection['decodeMimeStr'];
        }
        //MIME character set to use when searching strings
        $this->searchEncoding = $this->_connection['searchEncoding'] ? $this->_connection['searchEncoding'] : $this->_connection['serverEncoding'];

        if ($this->attachmentsDir) {
            if (!is_dir($this->attachmentsDir)) {
                throw new Exception('Directory "' . $this->attachmentsDir . '" not found');
            }
            $this->attachmentsDir = rtrim(realpath($this->attachmentsDir), '\\/');
        }
        return $this;
    }
}
