<?php

namespace Tests\Unit\Core;

use App\Core\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    public function test_it_should_get_right_configuration_with_right_key()
    {
        $configs = [
            'app' => [
                'app_name' => 'APPLICATION_TEST',
                'version' => 1
            ]
        ];

        $configuration = new Configuration($configs);

        $expectedApplicationName = 'APPLICATION_TEST';
        $expectedApplicationVersion = 1;

        $this->assertEquals($expectedApplicationName, $configuration->get('app', 'app_name'));
        $this->assertEquals($expectedApplicationVersion, $configuration->get('app', 'version'));
    }

    public function test_it_should_return_null_when_container_not_exists()
    {
        $configs = [];

        $configuration = new Configuration($configs);

        $this->assertNull($configuration->get('app', 'app_name'));
    }

    public function test_it_should_return_null_when_key_not_exists()
    {
        $configs = [
            'app' => [
                'some_key' => 'value'
            ]
        ];

        $configuration = new Configuration($configs);

        $this->assertNull($configuration->get('app', 'other_key'));
    }

    public function test_item_should_be_exists_and_valid_when_its_added()
    {
        $configuration = new Configuration();

        $configuration->add('app', ['app_name' => 'TEST']);

        $this->assertEquals('TEST', $configuration->get('app', 'app_name'));
    }

    public function test_its_should_return_false_when_key_doesnt_exists()
    {
        $configuration = new Configuration(['app' => ['some_key' => 'value']]);

        $this->assertFalse($configuration->has('app', 'non_exists_key'));
    }

    public function test_its_should_return_true_when_key_exists()
    {
        $configuration = new Configuration(['app' => ['some_key' => 'value']]);

        $this->assertTrue($configuration->has('app', 'some_key'));
    }
}