<?php

namespace Anibal\PhpSimpleDotenv;

/**
 * A simple dotenv loader for PHP applications.
 * 
 * This class provides functionality to load environment variables from .env files
 * and make them available through PHP's getenv() function.
 */
class SimpleDotenv
{
    /**
     * Load environment variables from a .env file.
     * 
     * Reads the specified .env file, parses key=value pairs, and sets them as
     * environment variables. Comments (lines starting with #) and empty lines
     * are ignored. Values can be wrapped in single or double quotes.
     * 
     * @param string|null $dotenv_path Path to the .env file. Defaults to '.env' in the current directory.
     * 
     * @return void
     * 
     * @throws \Exception When the specified .env file does not exist or cannot be read.
     * 
     * @example
     * ```php
     * // Load from default .env file
     * SimpleDotenv::load();
     * 
     * // Load from custom path
     * SimpleDotenv::load('/path/to/custom.env');
     * 
     * // Access loaded variables
     * $value = getenv('MY_VARIABLE');
     * ```
     */
    public static function load(?string $dotenv_path = '.env'): void
    {
        $dotenv_content = file_get_contents($dotenv_path);

        print_r($dotenv_content);

        if ($dotenv_content !== false) {
            $dotenv_lines = array_filter(
                explode("\n", $dotenv_content),
                fn ($line) => !empty(trim($line) && !str_starts_with(trim($line), '#'))
            );

            if (count($dotenv_lines) > 0) {
                foreach ($dotenv_lines as $dotenv_line) {
                    list($key, $value) = explode('=', $dotenv_line);

                    $value = trim($value, " \t\n\r\0\x0B'\"");

                    putenv(join('=', array_map('strval', [$key, $value])));
                }
            }
        } else {
            throw new \Exception('no such a dotenv file in this project');
        }
    }
}
