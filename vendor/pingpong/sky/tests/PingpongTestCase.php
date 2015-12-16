<?php

abstract class PingpongTestCase extends \Pingpong\Testing\TestCase {

    /**
     * @return string
     */
    public function getBasePath()
    {
        return realpath(__DIR__ . '/../fixture');
    }

    /**
     * @return \Illuminate\Foundation\Application
     */
    public function getApplication()
    {
        return $this->app;
    }

    /**
     * @return \Illuminate\Foundation\Application
     */
    public static function getLaravel()
    {
        return (new static)->getApplication();
    }

    protected function getPackageProviders()
    {
        return [
            'Pingpong\Trusty\TrustyServiceProvider',
            'Pingpong\Menus\MenusServiceProvider',
            'Pingpong\Widget\WidgetServiceProvider',
            'Pingpong\Themes\ThemesServiceProvider',
            'Pingpong\Shortcode\ShortcodeServiceProvider',
            'Pingpong\Generators\GeneratorsServiceProvider',
            'Pingpong\Modules\ModulesServiceProvider',
        ];
    }

    protected function getPackageAliases()
    {
        return [];
    }


}