<?php
/**
 * Strings.php
 *
 * @package Emvicy
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <emvicy@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

namespace MVC;

use HTMLPurifier;
use Parsedown;

class Strings
{
    /**
     * removes all doubleDot+Slashes (../) from string
     * @param string $sString
     * @return string
     */
    public static function removeDoubleDotSlashesFromString(string $sString = '') : string
    {
        // removes any "../"
        return (string) preg_replace('#(\.\.\/)+#', '', trim($sString));
    }

    /**
     * replaces multiple forwardSlashes (//) from string by a single forwardSlash
     * @param string $sString
     * @param bool   $bIgnoreProtocols default=false; on true leaves :// as it is
     * @return string
     */
    public static function replaceMultipleForwardSlashesByOneFromString(string $sString = '', bool $bIgnoreProtocols = false) : string
    {
        // removes multiple "/" [e.g.: //, ///, ////, etc.]
        if (true === $bIgnoreProtocols)
        {
            $sString = (string) preg_replace('#([^:])(\/{2,})#', '$1/', trim($sString));
        }
        else
        {
            $sString = (string) preg_replace('#/+#', '/', trim($sString));
        }

        return $sString;
    }

    /**
     * replaces special chars, umlauts by `-` (or given char)
     * @param string $sString
     * @param string $sReplacement
     * @param bool   $bStrToLower
     * @return string
     */
    public static function seofy(string $sString = '', string $sReplacement = '-', bool $bStrToLower = true) : string
    {
        $sString = preg_replace('/[^\\pL\d_]+/u', $sReplacement, $sString);
        $sString = trim($sString, $sReplacement);
        $sString = transliterator_transliterate('de-ASCII; Any-Latin; Latin-ASCII;', $sString);
        $sString = iconv("utf-8","ascii//translit//ignore", $sString);
        (true === $bStrToLower) ? $sString = strtolower($sString) : false;

        return (string) preg_replace('/[^-a-zA-Z0-9_]+/', '', $sString);
    }

    /**
     * converts markdown syntax into markup
     * @param string $sMarkdown
     * @return string
     */
    public static function markdown(string $sMarkdown) : string
    {
        return Parsedown::instance()->text($sMarkdown);
    }

    /**
     * checks whether a string is json
     * @param string $sString
     * @return bool
     */
    public static function isJson(string $sString = '') : bool
    {
        if (false === is_string($sString))
        {
            return false;
        }

        return json_validate($sString);
    }

    /**
     * parse JSON out of a mixed String; returns Array with detected JSON;
     * @param string $sString
     * @param bool   $bReturnValidJsonOnly
     * @return array
     */
    public static function getJson(string $sString = '', bool $bReturnValidJsonOnly = true) : array
    {
        // RegEx pattern
        $sPattern = '
        /
        \{              # { character
            (?:         # non-capturing group
                [^{}]   # anything that is not a { or }
                |       # OR
                (?R)    # recurses the entire pattern
            )*          # previous group zero or more times
        \}              # } character
        /x
        ';

        // get parsed matches
        preg_match_all($sPattern, $sString, $aJson);
        $aJson = current($aJson);

        if (true === $bReturnValidJsonOnly)
        {
            $aJson = array_filter(
                $aJson,
                function($sJson) {
                    if (true === json_validate($sJson)) {
                        return $sJson;
                    }
                }
            );
        }

        // Result
        return $aJson;
    }

    /**
     * checks whether a string is utf8
     * @param string $sString
     * @return bool
     */
    public static function isUtf8(string $sString = '') : bool
    {
        $iStrlen = strlen($sString);

        for($iCnt = 0; $iCnt < $iStrlen; $iCnt++)
        {
            $iOrd = ord($sString[$iCnt]);

            if($iOrd < 0x80)
            {
                continue; // 0bbbbbbb
            }
            elseif(($iOrd & 0xE0) === 0xC0 && $iOrd > 0xC1)
            {
                $iN = 1; // 110bbbbb (exkl C0-C1)
            }
            elseif(($iOrd & 0xF0) === 0xE0)
            {
                $iN = 2; // 1110bbbb
            }
            elseif(($iOrd & 0xF8) === 0xF0 && $iOrd < 0xF5)
            {
                $iN = 3; // 11110bbb (exkl F5-FF)
            }
            else
            {
                return false; // invalid UTF-8 char
            }

            for($iCnt2 = 0; $iCnt2 < $iN; $iCnt2++) // $iN followbytes? // 10bbbbbb
            {
                if(++$iCnt === $iStrlen || (ord($sString[$iCnt]) & 0xC0) !== 0x80)
                {
                    return false; // invalid UTF-8 char
                }
            }
        }

        return true; // no valid UTF-8 char found
    }

    /**
     * cleans up a string by removing newlines, multiple whitespaces
     * @param string $sString
     * @return string
     */
    public static function tidy(string $sString = ''): string
    {
        $sString = preg_replace('%\s+%', ' ', $sString);

        return trim($sString);
    }

    /**
     * returns a random uuid Version4 string (8-4-4-4-12)
     * @example 889abaf2-461d-42a1-86f4-07eb3e9876a5
     * @return string
     */
    public static function uuid4() : string
    {
        return sprintf(
                '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0x0fff) | 0x4000,
                mt_rand(0, 0x3fff) | 0x8000,
                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
            );
    }

    /**
     * checks whether a param is a valid uuid Version4 string
     * @param mixed $sUuid4
     * @return bool
     */
    public static function isUuid4(mixed $sUuid4): bool
    {
        return (is_string($sUuid4) && preg_match('/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i', $sUuid4));
    }

    /**
     * checks whether a string contains markup
     * @param string $sString
     * @param bool   $bPurify
     * @return bool
     */
    public static function isMarkup(string $sString = '', bool $bPurify = true) : bool
    {
        // auto-repair markup
        (true === $bPurify)
            ? $sString = HTMLPurifier::getInstance()->purify($sString)
            : false
        ;

        return (($sString != strip_tags($sString)));
    }

    /**
     * cuts off a string at given limit, appends a custom string if string to cut off is longer than limit, can purify
     * broken markup string before return
     * @param string $sString
     * @param int    $iLimit
     * @param string $sAppendix
     * @param bool   $bPurify
     * @return string
     */
    public static function cutOff(string $sString = '', int $iLimit = 0, string $sAppendix = ' […]', bool $bPurify = true) : string
    {
        // cut off
        $sStringMod = mb_substr($sString, 0, $iLimit);

        // auto-repair markup
        (true === self::isMarkup($sString) && true === $bPurify)
            ? $sStringMod = HTMLPurifier::getInstance()->purify($sStringMod)
            : false
        ;

        (true === mb_strlen($sString) > $iLimit) && $sStringMod.= $sAppendix;

        return $sStringMod;
    }

    /**
     * returns `<tag>`-encapsulated, highlighted html markup
     * @param string $sMarkup
     * @param string $sTag encapsulating tag
     * @param bool   $bPurify removes html,head,body; repairs broken html
     * @return string
     * @example
     *      Strings::highlight_html($sMarkup, 'kbd');
     *      Strings::highlight_html($sMarkup, bPurify: true);
     * @credits https://floern.com/webscripting/html-highlighter
     */
    public static function highlight_html(string $sMarkup = '', string $sTag = 'code', bool $bPurify = false) : string
    {
        $sTag = preg_replace("/[^[:alpha:]]/ui", '', $sTag);
        (true === $bPurify) && $sMarkup = HTMLPurifier::getInstance()->purify($sMarkup);

        if (!defined('HLH_TAG'))
        {
            define('HLH_TAG',       '#d02');    // HTML-Tag
            define('HLH_ATTR',      '#00d');    // HTML-Tag-Attribute
            define('HLH_ATTR_VAL',  '#090');    // HTML-Tag-Attribute-Value
            define('HLH_JS',        '#399');    // JavaScript
            define('HLH_PHP',       '#970');    // PHP
            define('HLH_COMM',      '#777');    // HTML-Comment
            define('HLH_ENT',       '#e60');    // Entity
        }

        $sMarkup = htmlspecialchars($sMarkup);
        $sMarkup = str_replace("\t", '    ', $sMarkup);
        $sMarkup = str_replace(' ', '&nbsp;', $sMarkup);
        $sMarkup = str_replace('=', '&#61;', $sMarkup);
        $sMarkup = preg_replace_callback('~&lt;\?(.*?)\?&gt;~is', '\MVC\Strings::hlh_htmlphp', $sMarkup);
        $sMarkup = preg_replace_callback('~&lt;script(.*?)&gt;(.*?)&lt;/script&gt;~is', '\MVC\Strings::hlh_htmljs', $sMarkup);
        $sMarkup = preg_replace_callback('~&lt;!--(.*?)--&gt;~is', '\MVC\Strings::hlh_htmlcomm', $sMarkup);
        $sMarkup = preg_replace('~&lt;([a-z!]{1}[a-z0-9]{0,})&gt;~is', '&lt;<span style="color:' . HLH_TAG . '">$1</span>&gt;', $sMarkup);
        $sMarkup = preg_replace_callback('~&lt;([a-z!]{1}[a-z0-9]{0,})&nbsp;(.*?)&gt;~is', '\MVC\Strings::hlh_htmltag', $sMarkup);
        $sMarkup = preg_replace('~&lt;\/([a-z]{1}[a-z0-9]{0,})&gt;~is', '&lt;/<span style="color:' . HLH_TAG . '">$1</span>&gt;', $sMarkup);
        $sMarkup = preg_replace('~&amp;([#a-z0-9]{1,20});~i', '<span style="color:' . HLH_ENT . '">&amp;$1;</span>', $sMarkup);
        $sMarkup = nl2br($sMarkup);

        return '<' . $sTag . '>' . $sMarkup . '</' . $sTag . '>';
    }

    /**
     * @param array $aCode
     * @return string
     */
    protected static function hlh_htmltag(array $aCode = array()) : string
    {
        $sTagName = $aCode[1];
        $sTagFill = $aCode[2];
        $sTmpTtag = '&lt;<span style="color:' . HLH_TAG . '">' . $sTagName . '</span>&nbsp;';
        $sTmpTtag .= preg_replace_callback('~([a-z-]+)&#61;([a-z0-9]{1,}|&quot;(.*?)&quot;|\'(.*?)\')~i', '\MVC\Strings::hlh_htmltagattr', $sTagFill);
        $sTmpTtag .= '&gt;';

        return $sTmpTtag;
    }

    /**
     * @param array $aCode
     * @return string
     */
    protected static function hlh_htmltagattr(array $aCode = array()) : string
    {
        $sAttrName = $aCode[1];
        $sAttrValue = $aCode[2];

        return '<span style="color:' . HLH_ATTR . '">' . $sAttrName . '</span>&#61;<span style="color:' . HLH_ATTR_VAL . '">' . $sAttrValue . '</span>';
    }

    /**
     * @param array $aCode
     * @return string
     */
    protected static function hlh_htmljs(array $aCode = array()) : string
    {
        $sTagFill = $aCode[1];
        $sJsCode = $aCode[2];
        $sJsCode = str_replace('&lt;', '&#60;', $sJsCode);
        $sJsCode = str_replace('&gt;', '&#62;', $sJsCode);
        $sJsCode = str_replace('&amp;', '&#38;', $sJsCode);

        return '&lt;script' . $sTagFill . '&gt;<span style="color:' . HLH_JS . '">' . $sJsCode . '</span>&lt;/script&gt;';
    }

    /**
     * @param array $aCode
     * @return string
     */
    protected static function hlh_htmlphp(array $aCode = array()) : string
    {
        $aPhpCode = $aCode[1];
        $aPhpCode = str_replace('&lt;', '&#60;', $aPhpCode);
        $aPhpCode = str_replace('&gt;', '&#62;', $aPhpCode);
        $aPhpCode = str_replace('&amp;', '&#38;', $aPhpCode);
        $aPhpCode = str_replace('&quot;', '&#34;', $aPhpCode);
        $aPhpCode = str_replace("'", '&#39;', $aPhpCode);

        return '<span style="color:' . HLH_PHP . '">&#60;?' . $aPhpCode . '?&#62;</span>';
    }

    /**
     * @param array $aCode
     * @return string
     */
    protected static function hlh_htmlcomm(array $aCode = array()) : string
    {
        $aPhpCode = $aCode[1];
        $aPhpCode = str_replace('&lt;', '&#60;', $aPhpCode);
        $aPhpCode = str_replace('&gt;', '&#62;', $aPhpCode);
        $aPhpCode = str_replace('&amp;', '&#38;', $aPhpCode);

        return '<span style="color:' . HLH_COMM . '">&#60;!--' . $aPhpCode . '--&#62;</span>';
    }

    /**
     * creates a markup <ul>/<li> list on given data (string|array)
     * @param mixed $aData string|array
     * @param array $aConfig
     * @return string
     */
    public static function ulli(mixed $aData, array $aConfig = array('ul' => 'list-group', 'li' => 'text-break list-group-item bg-transparent', 'spanPrimary' => 'text-primary', 'spanInfo' => 'text-info', 'allocator' => '=>', 'arrayIdentifier' => 'array(...')) : string
    {
        if (false === is_array($aData))
        {
            return $aData;
        }

        $sMarkup = '<ul class="' . $aConfig['ul'] . '">';

        foreach ($aData as $sKey => $mValue)
        {
            $sMarkup.= '<li class="' . $aConfig['li'] . '"><span class="' . $aConfig['spanPrimary'] . '">'
                       . trim($sKey)
                       . '</span> <span class="' . $aConfig['spanInfo'] . '">' . $aConfig['allocator'] . '</span> ';
            (true === empty($mValue)) ? $mValue = '' : false;

            if (is_array($mValue))
            {
                $sMarkup.= ' <span class="' . $aConfig['spanInfo'] . '">' . $aConfig['arrayIdentifier'] . '</span> ';
                $sMarkup.= self::ulli($mValue, $aConfig);
            }
            elseif (is_object($mValue))
            {
                ob_start();
                var_dump($mValue);
                $mValue = ob_get_contents();
                ob_end_clean();
                $sMarkup.= htmlentities(trim(preg_replace('!\s+!', ' ', $mValue)));
            }
            else
            {
                $sMarkup.= htmlentities(trim(preg_replace('!\s+!', ' ', $mValue)));
            }

            $sMarkup.= '</li>';
        }

        $sMarkup.= '</ul>';

        return $sMarkup;
    }

    /**
     * creates a password
     * @param int    $iMaxLength default=15; maximum=57
     * @param string $sCharSpecial default='#*!$.'
     * @return string
     */
    public static function createPassword(int $iMaxLength = 15, string $sCharSpecial = '#*!$.') : string
    {
        $sCharLower = 'abcdefghijklmnopqrstuvwxyz';
        $sCharUpper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $sCharInt = '123467890';

        // each special char only once
        $sCharSpecial = count_chars($sCharSpecial, 3);

        (true === empty($sCharSpecial)) ? $sCharSpecial = '#*!$.' : false;

        // first 4 chars; make sure at least one of each lower, upper, int, special char is contained
        $sStringPre = str_shuffle(
            substr(str_shuffle($sCharLower), 0, 1) .
            substr(str_shuffle($sCharUpper), 0, 1) .
            substr(str_shuffle($sCharSpecial), 0, 1) .
            substr(str_shuffle($sCharInt), 0, 1)
        );

        $sHash = substr(password_hash(str_shuffle($sCharLower . $sCharInt . $sCharSpecial . $sCharUpper),PASSWORD_DEFAULT), 7);
        $sString = $sStringPre . $sHash;
        $sString = substr($sString, 0, $iMaxLength);

        return str_shuffle($sString);
    }
}