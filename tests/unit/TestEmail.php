<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use model\forum\Email;
final class TestEmail extends TestCase
{
    public function testCanBeCreatedFromValidEmailAddress(): void
    {
        $this->assertInstanceOf(
            Email::class,
            new Email('user@example.com')
        );
    }

    public function testCannotBeCreatedFromInvalidEmailAddress(): void
    {
        $email = new Email('user');
        $this->assertFalse($email->getValid());
        $this->assertEquals($email->getEmail(), 'invalid');
    }

    public function testCanBeUsedAsString(): void
    {
        $this->assertEquals(
            'user@example.com',
            new Email('user@example.com')
        );
    }
}