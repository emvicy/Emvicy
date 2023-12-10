<?php

/**
 * @param string $sSql
 * @return void
 * @throws \ReflectionException
 */
function logSql(string $sSql) {
    MVC\Log::write(
        \MVC\Strings::tidy($sSql),
        \MVC\Config::get_MVC_LOG_FILE_SQL()
    );
}
