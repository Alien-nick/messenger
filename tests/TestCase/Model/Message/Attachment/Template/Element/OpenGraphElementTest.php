<?php

declare(strict_types=1);

namespace Kerox\Messenger\Test\TestCase\Model\Message\Attachment\Element;

use Kerox\Messenger\Exception\MessengerException;
use Kerox\Messenger\Model\Common\Button\Postback;
use Kerox\Messenger\Model\Message\Attachment\Template\Element\OpenGraphElement;
use Kerox\Messenger\Test\TestCase\AbstractTestCase;

class OpenGraphElementTest extends AbstractTestCase
{
    public function testInvalidButton(): void
    {
        $this->expectException(MessengerException::class);
        $this->expectExceptionMessage('Buttons can only be an instance of web_url');

        $element = OpenGraphElement::create('https://open.spotify.com/track/7GhIk7Il098yCjg4BQjzvb')
            ->setButtons([
                Postback::create('Learn More', 'LEARN_MORE'),
            ]);
    }
}
