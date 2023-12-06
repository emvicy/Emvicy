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

use MVC\ArrDot;
use MVC\Event;

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
     * @throws \ReflectionException
     */
    public function fetchAll(string $sSql = '') : array
    {
        $oSql = new ArrDot();
        $oSql->set('sSql', trim($sSql));
        Event::run('mvc.db.model.dbpdo.fetchAll', $oSql);

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
     * @param $sSql
     * @return mixed
     * @throws \ReflectionException
     */
    public function fetchRow($sSql = '')
    {
        $oSql = new ArrDot();
        $oSql->set('sSql', trim($sSql));
        Event::run('mvc.db.model.dbpdo.fetchRow', $oSql);

        $oStmt = $this->query($sSql);
        $aRow = $oStmt->fetch(\PDO::FETCH_ASSOC);

        return $aRow;
    }
}
