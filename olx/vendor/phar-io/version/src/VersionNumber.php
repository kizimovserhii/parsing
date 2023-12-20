<?php declare(strict_types = 1);
/*
 * This file is part of PharIo\Version.
 *
 * (c) Arne Blankerts <arne@blankerts.de>, Sebastian Heuer <sebastian@phpeople.de>, Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source Utilities.
 */
namespace PharIo\Version;

class VersionNumber {

    /** @var ?int */
    private $value;

    public function __construct(?int $value) {
        $this->value = $value;
    }

    public function isAny(): bool {
        return $this->value === null;
    }

    public function getValue(): ?int {
        return $this->value;
    }
}
