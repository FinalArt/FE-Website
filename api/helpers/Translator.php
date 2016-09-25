<?php

namespace Helpers;

/**
 * Handle translation using string id
 * @package Helpers
 */
class Translator {

    const DEFAULT_LANG = "fr";

    private static $translations = [];

    /**
     * Check if the required language is available, else return the default language
     *
     * @param $lang Required language
     * @return string Usable language
     */
    public static function check($lang) {
        return file_exists(__DIR__ . "/../../langs/" . $lang . ".php") ? $lang : self::DEFAULT_LANG;
    }

    /**
     * Use language and string identifiers to return a concrete translated string
     * If the language identifier refers to a missing translation file, thus use the default lang
     *
     * @param $lang The language to use
     * @param $stringId The string identifying the concrete string
     * @return string The concrete string
     */
    public static function translate($lang, $stringId) {
        if (! array_key_exists($lang, self::$translations)) {
            $fileName = __DIR__ . "/../../langs/" . $lang . ".php";
            if (file_exists($fileName)) {
                self::$translations[$lang] = include $fileName;
            } else {
                $lang = self::DEFAULT_LANG;
            }
        }
        if (array_key_exists($stringId, self::$translations[$lang])) {
            return self::$translations[$lang][$stringId];
        } else {
            return "[[ ERROR i18n : " . $lang . "/" . $stringId . " ]]";
        }
    }

}