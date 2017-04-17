<?php

namespace Tests\Unit;

require __DIR__ . '/../../../namedrop/public/dlib.php';

class ValidationTest extends BaseTestCase
{
    /**
     * Data provider for name validator
     * @return array
     */
    public function nameValidateProvider()
    {
        return [
            // Edge cases - length
            ["", ["was not submitted"]],
            ["D", ["short"]],
            ["Da", ["short"]],
            ["Dam", []],
            ["Daaaaaaaaaamien", []], // length 15
            ["Daaaaaaaaaaamien", ["long"]], // length 16
            // Multiple errors
            ["1x", ["short", "number"]],
            ["1xxxxxxxxxxxxxxx", ["long", "number"]],
            ["x111111111111111", ["long", "number"]],
            // Tricky characters
            ["'''", []],
            ['"""', []],
            ["~!@#$%^&*", []],
            ["()_+=-`", []],
            ["[]\\;',./'", []],
            ["{}|:\"<>?", []],
        ];
    }
    /**
     * @dataProvider nameValidateProvider
     * @param $name Sample name string to test
     * @param $messageStrings String[] Strings expected in returned messages
     */
    public function testNameValidation($name, $messageStrings)
    {
        $messages = validateName($name);
        if (count($messageStrings) == 0) {
            $this->assertEmpty($messages);
        } else {
            foreach($messageStrings as $message) {
                $this->assertContains($message, $messages);
            }
        }
    }
}