<?php

namespace Rhubarb\Crown\Tests\Fixtures\UrlHandlers\NamespaceMappedHandlerTests\SubFolder;

use Rhubarb\Crown\Response\GeneratesResponse;

class index implements GeneratesResponse
{
    public function generateResponse($request = null)
    {
        return "index";
    }
}