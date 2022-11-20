<?php

/**
 * Helper Class for GUID
 * @version 1.0
 * @author Thomas Kirsch <t.kirsch@webcito.de>
 * @copyright (c) 2022, Thomas Kirsch
 */
class GUID
{
    /**
     * Pattern for valid GUID in lower case
     * @access protected
     * @var string
     */
    protected static string $pattern = "/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}?$/";

    /**
     * Pattern for empty protected GUID
     * @access protected
     * @var string
     */
    protected static string $patternEmpty = "/^[0]{8}(-[0]{4}){4}[0]{8}?$/";

    /**
     * An empty protected GUID
     * @access protected
     * @var string
     */
    protected static string $empty = "00000000-0000-0000-0000-000000000000";

    /**
     * Checks whether the GUID is valid
     * @access public
     * @param string $guid the guid as string
     * @param bool $only_case_insensitive default false for accept lowercase letters
     * @return bool
     * @noinspection PhpUnused
     */
    public static function isValid(string $guid, bool $only_case_insensitive = false): bool
    {
        return !empty(preg_match(self::$pattern . (!$only_case_insensitive ? 'i' : ''), trim($guid)));
    }

    /**
     * Checks whether the GUID is protected and contains only zeros
     * @access public
     * @param string $guid
     * @return bool
     * @noinspection PhpUnused
     */
    public static function isEmpty(string $guid): bool
    {
        return !empty(preg_match(self::$patternEmpty, trim($guid)));
    }

    /**
     * Get an empty protected GUID
     * @access public
     * @return string
     * @noinspection PhpUnused
     */
    public static function getEmpty(): string
    {
        return self::$empty;
    }

    /**
     * @throws Exception
     */
    public static function generateWithUnderlines(bool $only_case_insensitive = false): string
    {
        $guid = self::generate($only_case_insensitive);
        return str_replace('-', '_', $guid);
    }

    /**
     * Generate a new GUID
     * @access public
     * @param bool $only_case_insensitive default false for accept lowercase letters
     * @return string
     * @throws Exception
     */
    public static function generate(bool $only_case_insensitive = false): string
    {
        if (function_exists('com_create_guid') === true): // only windows
            $guid = trim(com_create_guid(), '{}'); // generate and clean from spaces
        else:
			$guid = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', random_int(0, 65535), random_int(0, 65535), random_int(0, 65535), random_int(16384, 20479), random_int(32768, 49151), random_int(0, 65535), random_int(0, 65535), random_int(0, 65535));
        endif;

        return !$only_case_insensitive ? strtolower($guid) : $guid;
    }

    /**
     * Checks for equality
     * @access public
     * @param string $sourceGuid
     * @param string $targetGuid
     * @return bool
     * @noinspection PhpUnused
     */
    public static function equals(string $sourceGuid, string $targetGuid): bool
    {
        return $sourceGuid === $targetGuid;
    }


    /**
     * @access public
     * @return string
     * @throws Exception
     * @example echo new \GUID();
     */
    public function __toString(): string
    {
        return self::generate();
    }

}
