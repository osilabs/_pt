<?php

namespace Tests\Functional;

require __DIR__ . '/../../../namedrop/public/dlib.php';

class HomepageTest extends BaseTestCase
{
    public function testCreateName()
    {
        $response = $this->runApp('post', '/new/?name=foo');

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testRead()
    {
        $response = $this->runApp('get', '/namedrop/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Welcome', (string)$response->getBody());
    }


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
            ["", []],
            ["", []],
            ["", []],
            ["", []],
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
        }
        foreach($messageStrings as $message) {
            $this->assertContains($message, $messages);
        }
    }



    // ------------------------------------------------------------------------

    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
//    public function testGetHomepageWithoutName()
//    {
//        $response = $this->runApp('GET', '/');
//
//        $this->assertEquals(200, $response->getStatusCode());
//        $this->assertContains('SlimFramework', (string)$response->getBody());
//        $this->assertNotContains('Hello', (string)$response->getBody());
//    }
//
//    /**
//     * Test that the index route with optional name argument returns a rendered greeting
//     */
//    public function testGetHomepageWithGreeting()
//    {
//        $response = $this->runApp('GET', '/name');
//
//        $this->assertEquals(200, $response->getStatusCode());
//        $this->assertContains('Hello name!', (string)$response->getBody());
//    }
//
    /**
     * Test that the index route won't accept a post request
     */
    public function testPostHomepageNotAllowed()
    {
        $response = $this->runApp('POST', '/', ['test']);

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string)$response->getBody());
    }
}