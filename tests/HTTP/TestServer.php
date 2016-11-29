<?php

namespace IMSGlobal\LTI\Test\HTTP;

class TestServer
{
    const RETURN_NOTHING = 0;
    const RETURN_VALUE = 1;
    const RETURN_INPUT = 2;
    const RETURN_HEADER = 3;
    
    private $testServerPid;

    /**
     * Starts a test server so that methods using functions like curl_exec can be tested.
     *
     * The test server is implemented using PHP's built-in server. The PID has to be tracked in order to shut it down.
     */
    public function start()
    {
        // Run the server
        $dir = __DIR__;
        $port = $this->getPort();
        $this->testServerPid = @exec("php -S localhost:{$port} -t {$dir} {$dir}/server.php &> /dev/null & echo $!");
        
        // Wait a little bit for the server to come online.
        usleep(100000);
    }

    /**
     * Determines if the server is running.
     *
     * @return bool
     */
    public function isRunning()
    {
        $ping = @file_get_contents($url = $this->getUrl(200, self::RETURN_VALUE, 'ping'));
        return $ping === 'ping';
    }

    /**
     * Gets the URL to the test server.
     *
     * @return string Test server's URL
     */
    public function getUrl($status = 200, $type = self::RETURN_NOTHING, $value = null)
    {
        $port = $this->getPort();
        $query = http_build_query(compact('status', 'type', 'value'));

        return "http://localhost:{$port}/?{$query}";
    }

    /**
     *  Stop the test server, if it's running, and the PID is known.
     */
    public function stop()
    {
        if (is_numeric($this->testServerPid)) {
            @exec("kill {$this->testServerPid}");
        }
    }

    /**
     * Get the test server port, as provided in phpunit.xml(.dist).
     *
     * @return int
     */
    private function getPort()
    {
        if (isset($_SERVER['TEST_SERVER_PORT']) && is_numeric($_SERVER['TEST_SERVER_PORT'])) {
            return (int) $_SERVER['TEST_SERVER_PORT'];
        } else {
            throw new \RuntimeException('TEST_SERVER_PORT is not defined as a $_SERVER variable in your phpunit.xml');
        }
    }
}
