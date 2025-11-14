<?php

/**
 * converts eurocent into euro (1000 => 10,00 €)
 * @example {$aData|centToEuro}
 *          {$aData|centToEuro:false} # Do not display the euro symbol
 * @param int  $iValue
 * @param bool $bShowEuroSymbol
 * @return string
 */
function smarty_modifier_centToEuro(mixed $iValue = 0, bool $bShowEuroSymbol = true)
{
    if (true === empty($iValue))
    {
        $sValue = '0.0';
    }
    else
    {
        $iValue = (int) $iValue;

        // Calc
        $sValue = ($iValue / 100);
    }

    $aValue = explode('.', $sValue);

    // Euro value
    $iEuro = $aValue[0];
    // Cent value; Ensure that there are 2 decimal places.
    $iCent = str_pad((count($aValue) >= 2 ? $aValue[1] : '00'), 2, 0);

    // recreate
    $sValue = $iEuro . ',' . $iCent;

    // adding a Euro symbol
    (true === $bShowEuroSymbol) ? $sValue.= ' €' : false;

    // return, so that further modifiers could handle it
    return $sValue;
}