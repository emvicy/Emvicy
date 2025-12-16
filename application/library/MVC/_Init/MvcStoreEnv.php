<?php

namespace MVC\_Init;

class MvcStoreEnv
{
    public static function do(string $sEnvFile = '')
    {
        (true === empty($sEnvFile))
            ? $sEnvFile = realpath(__DIR__ . '/../../../../') . '/.env'
            : false
        ;

        if (file_exists($sEnvFile))
        {
            $aEnvContent = array_values(array_filter(file($sEnvFile), 'trim'));

            foreach ($aEnvContent as $sLine)
            {
                $sLine = trim($sLine);

                // skip comment lines
                if ('#' === substr($sLine, 0, 1))
                {
                    continue;
                }

                // simply set
                putenv($sLine);
                $sLine = null;
                unset ($sLine);
            }

            $aEnvContent = null;
            unset($aEnvContent);
        }
        else
        {
            $sMessage = "missing file:\n" . $sEnvFile . "\n\n";
            echo (('cli' != php_sapi_name()) ? nl2br($sMessage) : $sMessage . "\n");
            (false === getenv('emvicy')) ? exit() : false;
        }

        $sEnvFile = null;
        unset($sEnvFile);
    }
}
