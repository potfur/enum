<?php

/*
* This file is part of the Storage package
*
* (c) Michal Wachowski <wachowski.michal@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Enum;


interface EnumInterface
{

    /**
     * Returns array with enum values
     *
     * @return array
     * @throws EnumException
     */
    public function values();

    /**
     * Returns enums value
     *
     * @return int
     */
    public function value();

    /**
     * Returns enums name
     *
     * @return string
     */
    public function name();

    /**
     * Checks if enums are equal
     *
     * @param EnumInterface $other
     *
     * @return bool
     */
    public function equals(EnumInterface $other);

    /**
     * Creates new enum instance from static call
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return $this
     */
    public static function __callStatic($name, $arguments);

    /**
     * Returns enum value as string
     *
     * @return string
     */
    public function __toString();
} 