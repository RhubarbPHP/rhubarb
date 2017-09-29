<?php

/**
 * Copyright (c) 2016 RhubarbPHP.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Rhubarb\Crown\Sendables\SMS;

use Rhubarb\Crown\Sendables\Sendable;

/**
 * Represents and channels delivery of a SMS.
 *
 * This class is abstract as the getText() method must be implemented to satisfy the implementation.
 */
abstract class SMS extends Sendable
{
    public function addRecipientByNumber($recipientNumber)
    {
        $this->addRecipient(new SMSRecipient($recipientNumber));

        return $this;
    }

    public function addRecipientsByNumber($recipients)
    {
        if (!is_array($recipients)) {
            $recipients = [$recipients];
        }

        foreach ($recipients as $recipient) {
            $this->addRecipientByNumber($recipient);
        }

        return $this;
    }

    public function getRecipientList()
    {
        return implode(", ", $this->getRecipients());
    }

    public function getRecipients()
    {
        $smsSettings = SMSSettings::singleton();

        if ($smsSettings->onlyRecipient) {
            // Only send sms to a test recipient, to prevent messaging real customers from a development environment
            return [$smsSettings->onlyRecipient];
        }

        return parent::getRecipients();
    }

    public function getSendableType()
    {
        return "SMS";
    }

    public function getProviderClassName()
    {
        return SMSProvider::class;
    }
}