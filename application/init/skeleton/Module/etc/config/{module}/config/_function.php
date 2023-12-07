<?php

/**
 * @param $oSql
 * @return void
 * @throws \ReflectionException
 */
function logSql($oSql) {
    MVC\Log::write(
        \MVC\Strings::tidy(
            $oSql->get('sSql')
        ),
        \MVC\Config::get_MVC_LOG_FILE_SQL()
    );
}
