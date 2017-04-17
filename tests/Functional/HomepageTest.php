<?php

namespace Tests\Functional;

class HomepageTest extends BaseTestCase
{
    /**
     * Test that new values are posted
     */
    public function testWrite()
    {
        $response = $this->runApp('post', '/new/?name=foo');
        $this->assertEquals(302, $response->getStatusCode());
    }

    /**
     * Test read route displays expected value
     */
    public function testRead()
    {
        $response = $this->runApp('get', '/namedrop/');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Welcome', (string)$response->getBody());
    }

    /**
     * Messages are displayed
     */
    public function testWrote()
    {
        $response = $this->runApp('get', '/namedrop/jimjim/');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('jimjim', (string)$response->getBody());
    }

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