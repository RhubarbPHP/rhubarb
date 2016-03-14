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

namespace Rhubarb\Crown\Encryption;

use Rhubarb\Crown\Application;
use Rhubarb\Crown\DependencyInjection\Container;
use Rhubarb\Crown\DependencyInjection\ProviderInterface;
use Rhubarb\Crown\DependencyInjection\ProviderTrait;
use Rhubarb\Crown\Exceptions\ImplementationException;

/**
 * Provides a framework for providing encryption services.
 */
abstract class EncryptionProvider implements ProviderInterface
{
    use ProviderTrait;

    /**
     * Returns the encrypted data.
     *
     * @param $data
     * @param string $keySalt An optional piece of data possibly used by the encryption algorithm to derive the key
     * @return string
     */
    abstract public function encrypt($data, $keySalt = "");

    /**
     * Returns the decrypted data
     *
     * @param $data
     * @param string $keySalt An optional piece of data possibly used by the encryption algorithm to derive the key
     * @return mixed
     */
    abstract public function decrypt($data, $keySalt = "");
}
