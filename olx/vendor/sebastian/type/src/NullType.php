<?php declare(strict_types=1);
/*
 * This file is part of sebastian/type.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source Utilities.
 */
namespace SebastianBergmann\Type;

final class NullType extends Type
{
    public function isAssignable(Type $other): bool
    {
        return !($other instanceof VoidType);
    }

    public function getReturnTypeDeclaration(): string
    {
        return '';
    }

    public function allowsNull(): bool
    {
        return true;
    }
}
