<?php
/**
 * Debug.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3.
 */

namespace MVC;

use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;

class Debug
{
    protected static $_oInstance;

    /**
     * Constructor
     */
    protected function __construct()
    {
        ;
    }

    /**
     * @param mixed $mData
     * @return string
     */
    protected static function obDump(mixed $mData = '') : string
    {
        ob_start();
        echo (Closure::is($mData)) ? '// type: Closure' : '// type: ' . gettype($mData);
        echo ('resource' === gettype($mData)) ? ', ' . get_resource_type($mData) : '';
        echo ('array' === gettype($mData)) ? ', items: ' . count($mData) : '';
        echo "\n";
        self::varExport($mData);
        $sData = trim(ob_get_contents());
        $sData = str_replace("=>\n", '=>', $sData);
        $sData = str_replace("=> \n", '=>', $sData);
        ob_end_clean();

        /** @var string $sData */
        return $sData;
    }

    /**
     * Mini OnScreen Debugger
     * @param mixed  $mData
     * @param array  $aDebugBacktrace
     * @param string $sTitle
     * @return void
     */
    public static function info(mixed $mData = '', array $aDebugBacktrace = array(), string $sTitle = '') : void
    {
        static $iCount;

        if (true === empty($sTitle))
        {
            $sTitle = ':: :: :: :: :: :: :: info() :: :: :: :: :: :: ::';
        }

        $iCount++;

        // source
        $aBacktrace = self::prepareBacktraceArray((false === empty($aDebugBacktrace)) ? $aDebugBacktrace : debug_backtrace(limit: 2));
        $mData = self::obDump($mData);

        // output CLI
        if (isset ($GLOBALS['argc']))
        {
            echo "\n---DEBUG------------------------- " . $sTitle;
            echo "\nInfo Count:\t\t" . $iCount . "";
            echo "\nFile:\t\t\t" . $aBacktrace['sFile'] . "";
            echo "\nLine:\t\t\t" . $aBacktrace['sLine'] . "";
            echo "\nClass::function:\t" . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . "\n";
            echo "\n" . '$data:' . "\n" . $mData . "\n\n";
            echo "\n---/DEBUG------------------------\n\n";
        }
        // output Web
        else
        {
            $sId = 'debugInfo' . md5(Convert::serialize($aBacktrace)) . $iCount;
            echo '<div '
                 . 'id="' . $sId . '" '
                 . 'style="position: fixed;top: 400px;left: 400px;
                         box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                         z-index: 65535 !important;
                         float: left !important; text-align: left !important;
                         background-color: transparent;border: 1px solid #d3d3d3;
                         text-align: center;
                         " '
                 . 'class="emvicy_draggable" '
                 . '>
                <div id="' . $sId . '_mover" style="
                    padding: 2px;
                    cursor: move;
                    z-index: 10;
                    background-color: #0D6EFD;
                    color: #fff;
                    text-align: center;"
                >' . $sTitle . '</div>
                <div style="
                    overflow: auto !important;
                    font-weight: normal;
                    font-family: \'FreeMono\', \'Andale Mono\', monospace;
                    color: #000;
                    padding: 0 10px 0 10px;
                    background-color: #f1f1f1;
                ">
                <div style="position: absolute; top: 0px; left: 0px;color: white; background-color: #0D6EFD ; padding: 2px 5px;border-radius: 0px;">&#128468; ' . $iCount . '</div>
                <div title="close" style="cursor: pointer;position: absolute; top: 0px; right: 0px;color: white; background-color: red; padding: 2px 8px;border-radius: 3px;float: right" onclick="document.getElementById(\'' . $sId . '\').remove()">X</div>
                    <nobr><b>File:</b> ' . $aBacktrace['sFile'] . '</nobr><br>
                    <nobr><b>Line:</b> ' . $aBacktrace['sLine'] . '</nobr><br>
                    <nobr><b>Class/Method:</b> ' . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . '</nobr><br>
                </div>
                <div  id="' . $sId . '_content" style="
                    resize: both;overflow: auto !important;
                    float:left !important;
                    background-color: whitesmoke;
                    width:100%;
                    height:300px;
                    font-size:medium !important;
                    padding: 10px !important;
                    font-family: monospace !important;
                    opacity: 0.8;transition: opacity 0.5s;"
                    onmouseover="this.style.opacity=1.0;this.style.transition=\'opacity 0.5s ease\'"
                    onmouseout="this.style.opacity=0.8;this.style.transition=\'opacity 0.5s ease\'"                    
                ><b>';
            $sHighlight = highlight_string('<?php' . "\n" . $mData, true);
            echo trim(str_replace('&lt;?php', '', $sHighlight));
            echo '</b></div>
			</div>';
        }
    }

    /**
     * shows a smaller message on the screen right side.
     * if you call display more than once, all messages are showed among each other
     * use it to debug a string or array or whatever
     * @param mixed $mData
     * @param array $aDebugBacktrace
     * @return void
     */
    public static function display(mixed $mData = '', array $aDebugBacktrace = array()) : void
    {
        static $sDisplay;
        static $iCount;

        $iCount++;

        // Source
        $aBacktrace = self::prepareBacktraceArray((false === empty($aDebugBacktrace)) ? $aDebugBacktrace : debug_backtrace(limit: 2));
        $mData = self::obDump($mData);

        // Output for CLI
        if (isset ($GLOBALS['argc']))
        {
            echo "\n---DISPLAY-------------------------";
            echo "\nDisplay Count:\t\t" . $iCount . "";
            echo "\nFile:\t\t\t" . $aBacktrace['sFile'] . "";
            echo "\nLine:\t\t\t" . $aBacktrace['sLine'] . "";
            echo "\nClass::function:\t" . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . "\n";
            echo "\n" . '$data:' . "\n" . $mData . "\n\n";
            echo "\n---/DISPLAY------------------------\n\n";
        }
        // Output Web
        else
        {
            // show source
            $sConsultation = '<div style="overflow-wrap: break-word !important;word-wrap: break-word !important;hyphens: auto !important;background-color:white !important;color:red !important;font-weight: normal !important;">';
            $sConsultation .= '<span style="color: white; background-color: blue; padding: 2px;">' . $iCount . '</span>';
            (isset ($aBacktrace['sFile']))
                ? $sConsultation .= '<b>File:</b> ' . $aBacktrace['sFile'] . '<br>'
                : '';
            (isset ($aBacktrace['sLine']))
                ? $sConsultation .= '<b>Line:</b> ' . $aBacktrace['sLine'] . '<br>'
                : '';
            (isset ($aBacktrace['sClass']) && isset ($aBacktrace['sFunction']))
                ? $sConsultation .= '<b>Class/Method:</b> ' . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . '<br>'
                : '';
            $sConsultation .= '</div>';

            $sDisplay .= $sConsultation . '<textarea style="font-size:10px;width:100% !important;min-height: 60px !important;margin:0 !important;background-color:blue !important;color:white !important;border: none !important;padding: 5px !important;font-family: monospace !important;">' . $mData . '</textarea>';

            // Display
            echo '<div id="debugDisplay' . $iCount . '" style="box-shadow: 0px 0px 10px 0px rgba(100, 100, 100, 1); overflow: auto !important;max-height: 90%;z-index:65535 !important;position:fixed !important;bottom:10px !important;right:10px !important;background-color:blue !important;color:white !important;border:1px solid #333 !important;width:500px !important;-moz-border-radius:3px !important; border-radius: 3px !important;font-size:12px !important;font-family: monospace !important;"><b>';
            echo $sDisplay;
            echo '</b></div>';
        }
    }

    /**
     * Stops any further execution: exits the script.
     * Shows a Message from where the STOP command was called (default).
     * @param mixed $mData
     * @param bool  $bShowWhereStop
     * @param bool  $bDump
     * @param array $aBacktrace
     * @return void
     * @throws \ReflectionException
     */
    public static function stop(mixed $mData = '', bool $bShowWhereStop = true, bool $bDump = true, array $aBacktrace = array()) : void
    {
        static $iCount;
        $iCount++;

        // source
        (true === empty($aBacktrace)) ? $aBacktrace = self::prepareBacktraceArray(debug_backtrace(limit: 2)) : false;

        if (true === $bDump)
        {
            ob_start();
            var_dump($mData);
            $sEcho = ob_get_contents();
            ob_end_clean();
        }
        else
        {
            $sEcho = $mData;
        }

        // output CLI
        if (isset ($GLOBALS['argc']))
        {
            $sConsultation = "\n---STOP-------------------------";
            $sConsultation .= "\nStopped at:";
            $sConsultation .= "\nFile:\t\t\t" . $aBacktrace['sFile'];
            $sConsultation .= "\nLine:\t\t\t" . $aBacktrace['sLine'];
            $sConsultation .= "\nClass::function:\t" . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . "\n";

            echo ($bShowWhereStop === true)
                ? $sConsultation
                : '';

            if (false === empty ($mData))
            {
                echo ($bShowWhereStop === true)
                    ? "\nData:\n"
                    : '';
                echo $sEcho . "\n";
            }
            echo "\n---/STOP------------------------\n\n";
        }
        // output Web
        else
        {
            // show source
            $sConsultation = '<div style="overflow-wrap: break-word !important;word-wrap: break-word !important;hyphens: auto !important;background-color:white !important;color:red !important;font-weight: normal !important;">';
            (isset ($aBacktrace['sFile']))
                ? $sConsultation .= '<b>File:</b> ' . $aBacktrace['sFile'] . '<br>'
                : '';
            (isset ($aBacktrace['sLine']))
                ? $sConsultation .= '<b>Line:</b> ' . $aBacktrace['sLine'] . '<br>'
                : '';
            (isset ($aBacktrace['sClass']) && isset ($aBacktrace['sFunction']))
                ? $sConsultation .= '<b>Class/Method:</b> ' . $aBacktrace['sClass'] . '::' . $aBacktrace['sFunction'] . '<br>'
                : '';
            $sConsultation .= '</div>';

            // display
            echo '<div class="draggable" style="padding:10px !important;z-index:65535 !important;position:fixed !important;top:10px !important;left:10px !important;background-color:red !important;color:white !important;border:1px solid #333 !important;width:400px !important;height:auto !important;overflow:auto !important;-moz-border-radius: 3px !important; border-radius: 3px !important;"><b>';
            echo ($bShowWhereStop === true)
                ? '<h1 style="font-size:20px !important;">STOP</h1><p>Stopped at:</p>' . $sConsultation
                : '';

            if (false === empty($mData))
            {
                echo ($bShowWhereStop === true)
                    ? '<h2>Data</h2><p>'
                    : '';
                echo '<pre style="font-size:10px;overflow:auto !important;max-height:300px !important;background-color:transparent !important;color:#fff !important;border: none !important;">' . $sEcho . '</pre></p>';
            }
            echo '</b></div>';
        }

        Event::run('mvc.debug.stop.after', DTArrayObject::create()
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('aBacktrace')
                ->set_sValue($aBacktrace))
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('mData')
                ->set_sValue($sEcho))
            ->add_aKeyValue(DTKeyValue::create()
                ->set_sKey('bOccurrence')
                ->set_sValue($bShowWhereStop)));

        (true === Config::get_MVC_CLI()) && Config::get_MVC_MODULE_PRIMARY_VIEW()::$bRender = false;
        exit();
    }

    /**
     * prepares backtrace array for output
     * @access public
     * @static
     * @param array $aBacktrace
     * @return array
     */
    public static function prepareBacktraceArray(array $aBacktrace = array()) : array
    {
        $aData = array();
        $aData['sFile'] = ($aBacktrace[0]['file'] ?? '');
        $aData['sLine'] = ($aBacktrace[0]['line'] ?? '');
        $aData['sClass'] = ($aBacktrace[1]['class'] ?? '');
        $aData['sFunction'] = ($aBacktrace[1]['function'] ?? '');

        return $aData;
    }

    /**
     * @param mixed $mData
     * @param bool  $bReturn
     * @param bool  $bShortArraySyntax
     * @return void|string
     */
    public static function varExport(mixed $mData, bool $bReturn = false, bool $bShortArraySyntax = true)
    {
        $sExport = var_export($mData, true);
        $sExport = preg_replace("/^([ ]*)(.*)/m", '$1$1$2', $sExport);
        $aData = preg_split("/\r\n|\n|\r/", $sExport);

        if ('array' === gettype($mData))
        {
            $sTokenLeft = (true === $bShortArraySyntax) ? '[' : 'array(';
            $sTokenRight = (true === $bShortArraySyntax) ? ']' : ')';
            $aData = preg_replace(["/\s*array\s\($/", "/\)(,)?$/", "/\s=>\s$/"], [
                null,
                $sTokenRight . '$1',
                ' => ' . $sTokenLeft,
            ], $aData);
            $sExport = join(PHP_EOL, array_filter([$sTokenLeft] + $aData));
        }

        if (true === $bReturn)
        {
            return (string) $sExport;
        }

        echo $sExport;
    }

    /**
     * returns time passed from start until calling this method
     * @return float
     * @throws \ReflectionException
     */
    public static function constructionTime() : float
    {
        // calc now
        $fMicrotime = microtime(true);
        $sMicrotime = sprintf("%06d", ($fMicrotime - floor ($fMicrotime)) * 1000000);
        $oDateTime = new \DateTime (date ('Y-m-d H:i:s.' . $sMicrotime));

        // calc duration
        $oStart = (false === empty(Session::is('Emvicy')
                ->get('startDateTime')))
            ? Session::is('Emvicy')
                ->get('startDateTime')
            : new \DateTime (date('Y-m-d H:i:s.' . $sMicrotime));
        $fEnd = round((date_format ($oDateTime, "s.u") - date_format (($oStart ?? null), "s.u")), 3);

        return $fEnd;
    }
}