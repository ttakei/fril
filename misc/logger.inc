<?php

class Logger
{
    const LOG_LEVEL_CRIT = 0;
    const LOG_LEVEL_ERR = 1;
    const LOG_LEVEL_WARN = 2;
    const LOG_LEVEL_NOTICE = 3;
    const LOG_LEVEL_INFO = 4;
    const LOG_LEVEL_DEBUG = 5;

    public static $level = self::LOG_LEVEL_WARN;
    public static $file = null;

    public static function crit() {
        $level = static::LOG_LEVEL_CRIT;
        static::_write($level, func_get_args());
        return;
    }

    public static function err() {
        $level = static::LOG_LEVEL_ERR;
        static::_write($level, func_get_args());
        return;
    }

    public static function warn() {
        $level = static::LOG_LEVEL_WARN;
        static::_write($level, func_get_args());
        return;
    }

    public static function notice() {
        $level = static::LOG_LEVEL_NOTICE;
        static::_write($level, func_get_args());
        return;
    }

    public static function info() {
        $level = static::LOG_LEVEL_INFO;
        static::_write($level, func_get_args());
        return;
    }

    public static function debug() {
        $level = static::LOG_LEVEL_DEBUG;
        static::_write($level, func_get_args());
        return;
    }

    protected static function _write($level, $arr) {
        if (static::$level < $level || !isset($arr[0])) {
            return;
        }

        if (isset($arr[1])) {
            $format = array_shift($arr);
            $str = vsprintf($format, $arr). "\n";
        } else {
            $str = array_shift($arr). "\n";
        }
        $str = str_replace("\r", "\\r", str_replace("\n", "\\n", $str));
        if (isset(static::$file)) {
            $fh = fopen(static::$file, 'a');
            if (!$fh) {
                fputs(
                    STDERR,
                    sprintf("failed open log file %s", static::$file)
                );
                return;
            }
            if (fputs($fh, $str) === false) {
                fputs(
                    STDERR,
                    sprintf("failed write log file %s", static::$file)
                );
                return;
            }
            fclose($fh);
        } else {
            fputs(STDERR, $str);
        }
        return;
    }
}
