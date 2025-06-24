<?php

use Anibal\PhpSimpleDotenv\SimpleDotenv;

describe('SimpleDotenv::load', function () {
    it('loads environment variables from a default .env file', function () {
        file_put_contents('.env', "TEST_KEY_1=test_value_1\nTEST_KEY_2='test_value_2'\n#comment\n\nTEST_KEY_3=\"test_value_3\"");

        SimpleDotenv::load();

        expect(getenv('TEST_KEY_1'))->toBe('test_value_1');
        expect(getenv('TEST_KEY_2'))->toBe('test_value_2');
        expect(getenv('TEST_KEY_3'))->toBe('test_value_3');

        unlink('.env');
    });

    it('loads environment variables from a specific .env file', function () {
        file_put_contents('.env.production', "TEST_KEY_1=test_value_1\nTEST_KEY_2='test_value_2'\n#comment\n\nTEST_KEY_3=\"test_value_3\"");

        SimpleDotenv::load('.env.production');

        expect(getenv('TEST_KEY_1'))->toBe('test_value_1');
        expect(getenv('TEST_KEY_2'))->toBe('test_value_2');
        expect(getenv('TEST_KEY_3'))->toBe('test_value_3');

        unlink('.env.production');
    });
});
