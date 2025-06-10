<?php

namespace Tests\Unit\Enums;

use PHPUnit\Framework\TestCase;

use App\Enums\UserRole;
use App\Enums\TypeFinance;

class EnumsTest extends TestCase
{
    public function test_user_role_labels_and_admin_check(): void
    {
        $this->assertSame('Jogador', UserRole::Player->label());
        $this->assertSame('Moderador', UserRole::Moderator->label());
        $this->assertSame('Administrador', UserRole::Administrator->label());
        $this->assertTrue(UserRole::Administrator->isAdmin());
        $this->assertFalse(UserRole::Player->isAdmin());
    }

    public function test_type_finance_labels(): void
    {
        $this->assertSame('Custos', TypeFinance::COSTS->label());
        $this->assertSame('Empréstimo', TypeFinance::LOAN->label());
    }
}
