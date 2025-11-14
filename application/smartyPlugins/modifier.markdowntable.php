<?php


/**
 * converts an array into markdown table.
 * needs such an array structure as a transfer
 * @example array(
 *      // header
 *      ['Test Nr.','Position','Radius','Rot','Grün','Blau','Ein Wert','Abweichung'],
 *      // data
 *      ['a)', '1%', '2', '3', '4', '5', 'foo', 'bar'],
 *      ['b)', '0%', '2%', '20%', '20%', '20%', '219', '95'],
 *      ['c)', '10%', '5%', '3%', '20%', '20%', '19', '115'],
 * )
 * @param $aTableData
 * @return string
 */
function smarty_modifier_markdowntable($aTableData = array())
{
    $sString = '';

    foreach ($aTableData as $iKey => $aRow)
    {
        $sString.= '| ';

        foreach ($aRow as $sValue)
        {
            $sString.= $sValue . '| ';
        }

        $sString.= "\n";

        // table header
        if (0 === $iKey)
        {
            $sString.= '|';

            foreach ($aRow as $sValue)
            {
                $sString.= '-----|';
            }

            $sString.= "\n";
        }
    }

    return $sString;
}