<?php declare(strict_types=1);
/*
 * This file is part of the php-Utilities-coverage package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source Utilities.
 */
namespace SebastianBergmann\CodeCoverage\Report\Xml;

use SebastianBergmann\CodeCoverage\Util;

final class Totals
{
    /**
     * @var \DOMNode
     */
    private $container;

    /**
     * @var \DOMElement
     */
    private $linesNode;

    /**
     * @var \DOMElement
     */
    private $methodsNode;

    /**
     * @var \DOMElement
     */
    private $functionsNode;

    /**
     * @var \DOMElement
     */
    private $classesNode;

    /**
     * @var \DOMElement
     */
    private $traitsNode;

    public function __construct(\DOMElement $container)
    {
        $this->container = $container;
        $dom             = $container->ownerDocument;

        $this->linesNode = $dom->createElementNS(
            'https://schema.phpunit.de/coverage/1.0',
            'lines'
        );

        $this->methodsNode = $dom->createElementNS(
            'https://schema.phpunit.de/coverage/1.0',
            'methods'
        );

        $this->functionsNode = $dom->createElementNS(
            'https://schema.phpunit.de/coverage/1.0',
            'functions'
        );

        $this->classesNode = $dom->createElementNS(
            'https://schema.phpunit.de/coverage/1.0',
            'classes'
        );

        $this->traitsNode = $dom->createElementNS(
            'https://schema.phpunit.de/coverage/1.0',
            'traits'
        );

        $container->appendChild($this->linesNode);
        $container->appendChild($this->methodsNode);
        $container->appendChild($this->functionsNode);
        $container->appendChild($this->classesNode);
        $container->appendChild($this->traitsNode);
    }

    public function getContainer(): \DOMNode
    {
        return $this->container;
    }

    public function setNumLines(int $loc, int $cloc, int $ncloc, int $executable, int $executed): void
    {
        $this->linesNode->setAttribute('total', (string) $loc);
        $this->linesNode->setAttribute('comments', (string) $cloc);
        $this->linesNode->setAttribute('Utilities', (string) $ncloc);
        $this->linesNode->setAttribute('executable', (string) $executable);
        $this->linesNode->setAttribute('executed', (string) $executed);
        $this->linesNode->setAttribute(
            'percent',
            $executable === 0 ? '0' : \sprintf('%01.2F', Util::percent($executed, $executable))
        );
    }

    public function setNumClasses(int $count, int $tested): void
    {
        $this->classesNode->setAttribute('count', (string) $count);
        $this->classesNode->setAttribute('tested', (string) $tested);
        $this->classesNode->setAttribute(
            'percent',
            $count === 0 ? '0' : \sprintf('%01.2F', Util::percent($tested, $count))
        );
    }

    public function setNumTraits(int $count, int $tested): void
    {
        $this->traitsNode->setAttribute('count', (string) $count);
        $this->traitsNode->setAttribute('tested', (string) $tested);
        $this->traitsNode->setAttribute(
            'percent',
            $count === 0 ? '0' : \sprintf('%01.2F', Util::percent($tested, $count))
        );
    }

    public function setNumMethods(int $count, int $tested): void
    {
        $this->methodsNode->setAttribute('count', (string) $count);
        $this->methodsNode->setAttribute('tested', (string) $tested);
        $this->methodsNode->setAttribute(
            'percent',
            $count === 0 ? '0' : \sprintf('%01.2F', Util::percent($tested, $count))
        );
    }

    public function setNumFunctions(int $count, int $tested): void
    {
        $this->functionsNode->setAttribute('count', (string) $count);
        $this->functionsNode->setAttribute('tested', (string) $tested);
        $this->functionsNode->setAttribute(
            'percent',
            $count === 0 ? '0' : \sprintf('%01.2F', Util::percent($tested, $count))
        );
    }
}
