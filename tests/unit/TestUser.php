<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use model\forum\User;

final class TestUser extends TestCase
{
    public function testCanBeCreatedFromValidEmailAddress(): void
    {
        $this->assertInstanceOf(
            User::class,
            new User(1, 'andreas', 'andreas@example.com', 'password', '10-04-2019 12:00:00', '10-04-2019 12:00:00', '94.212.253.51', -1, 1)
        );
    }
}