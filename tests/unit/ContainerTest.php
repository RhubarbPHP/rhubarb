<?php

/*
 *	Copyright 2015 RhubarbPHP
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

namespace Rhubarb\Crown\Tests;

use Rhubarb\Crown\Container;
use Rhubarb\Crown\Tests\Fixtures\DependencyInjection\DependencyWithArguments;
use Rhubarb\Crown\Tests\Fixtures\DependencyInjection\ExtendedSimpleClass;
use Rhubarb\Crown\Tests\Fixtures\DependencyInjection\OneDependency;
use Rhubarb\Crown\Tests\Fixtures\DependencyInjection\SimpleClass;
use Rhubarb\Crown\Tests\Fixtures\TestCases\RhubarbTestCase;

class ContainerTest extends RhubarbTestCase
{
    /**
     * @var Container
     */
    private $container;

    protected function setUp()
    {
        parent::setUp();

        $this->container = new Container();
    }

    public function testSimpleClassCreationNoTypeSpecified()
    {
        $object = $this->container->instance(SimpleClass::class);
        $this->assertInstanceOf(SimpleClass::class, $object);
    }

    public function testSimpleClassWithDependency()
    {
        $object = $this->container->instance(OneDependency::class);
        $this->assertInstanceOf(OneDependency::class, $object);
    }

    public function testSimpleClassWithOverrideRegistration()
    {
        $this->container->registerClass(SimpleClass::class, ExtendedSimpleClass::class);

        $object = $this->container->instance(SimpleClass::class);
        $this->assertInstanceOf(ExtendedSimpleClass::class, $object);

        $object = $this->container->instance(OneDependency::class);
        $this->assertInstanceOf(ExtendedSimpleClass::class, $object->injected);
    }

    public function testSimpleClassAsSingleton()
    {
        $this->container->registerClass(SimpleClass::class, ExtendedSimpleClass::class, true);

        $object = $this->container->instance(SimpleClass::class);
        $object->foo = "bar";

        $object = $this->container->instance(SimpleClass::class);
        $this->assertEquals("bar", $object->foo);
    }

    public function testAdditionalArgumentsCanPassToConstructor()
    {
        $this->container->registerClass(OneDependency::class, DependencyWithArguments::class);

        $object = $this->container->instance(OneDependency::class, "foo", "bar");

        $this->assertEquals("foo", $object->argument1);
        $this->assertEquals("bar", $object->argument2);
    }
}