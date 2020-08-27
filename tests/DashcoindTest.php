<?php

use Orchestra\Testbench\TestCase;
use Gegosoft\Dashcoin\Traits\Dashcoind;
use Gegosoft\Dashcoin\Client as DashcoinClient;

class DashcoindTest extends TestCase
{
    use Dashcoind;

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Gegosoft\Dashcoin\Providers\ServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Dashcoind' => 'Gegosoft\Dashcoin\Facades\Dashcoind',
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('dashcoind.user', 'testuser');
        $app['config']->set('dashcoind.password', 'testpass');
    }

    /**
     * Test service provider.
     *
     * @return void
     */
    public function testServiceIsAvailable()
    {
        $this->assertTrue($this->app->bound('dashcoind'));
    }

    /**
     * Test facade.
     *
     * @return void
     */
    public function testFacade()
    {
        $this->assertInstanceOf(DashcoinClient::class, \Dashcoind::getFacadeRoot());
    }

    /**
     * Test helper.
     *
     * @return void
     */
    public function testHelper()
    {
        $this->assertInstanceOf(DashcoinClient::class, dashcoind());
    }

    /**
     * Test trait.
     *
     * @return void
     */
    public function testTrait()
    {
        $this->assertInstanceOf(DashcoinClient::class, $this->dashcoind());
    }

    /**
     * Test Daskcoin config.
     *
     * @return void
     */
    public function testConfig()
    {
        $config = dashcoind()->getConfig();

        $this->assertEquals(
            config('dashcoind.scheme'),
            $config['base_uri']->getScheme()
        );

        $this->assertEquals(
            config('dashcoind.host'),
            $config['base_uri']->getHost()
        );

        $this->assertEquals(
            config('dashcoind.port'),
            $config['base_uri']->getPort()
        );

        $this->assertEquals(config('dashcoind.user'), $config['auth'][0]);
        $this->assertEquals(config('dashcoind.password'), $config['auth'][1]);
    }
}
