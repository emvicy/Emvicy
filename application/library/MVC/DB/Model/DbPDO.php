<?php
/**
 * DbPDO.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $DBModel
 */
namespace MVC\DB\Model;

/**
 * Class DbPDO
 * @package DB\Model
 */
class DbPDO extends \PDO
{
    /**
     * DbPDO constructor.
     * @param array $aConfig
     */
    public function __construct(array $aConfig = array())
    {
        parent::__construct(
            $aConfig['db']['type'] . ':'
            . 'host=' . $aConfig['db']['host'] . ';'
            . 'port=' . $aConfig['db']['port'] . ';'
            . 'dbname=' . $aConfig['db']['dbname'] . ';',
            $aConfig['db']['username'],
            $aConfig['db']['password']
//            // if SSL
//            ,array(
//                    \PDO::MYSQL_ATTR_SSL_KEY    => '/path/to/client-key.pem',
//                    \PDO::MYSQL_ATTR_SSL_CERT   => '/path/to/client-cert.pem',
//                    \PDO::MYSQL_ATTR_SSL_CA     => '/path/to/ca-cert.pem'
//            )
        );
    }

    /**
     * @param string $sSql
     * @return array
     */
    public function fetchAll(string $sSql = '') : array
    {
        $oStmt = $this->query($sSql);

        if (gettype($oStmt) != 'object')
        {
            return array();
        }

        $aResult = $oStmt->fetchAll(\PDO::FETCH_ASSOC);
        (false === $aResult) ? $aResult = [] : false;

        return $aResult;
    }

    /**
     * @param string $sSql
     * @return mixed
     */
    public function fetchRow($sSql = '')
    {
        $oStmt = $this->query($sSql);
        $aRow = $oStmt->fetch(\PDO::FETCH_ASSOC);

        return $aRow;
    }
}
