<?php

/*
* This file is part of the Storage package
*
* (c) Michal Wachowski <wachowski.michal@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Common\Enum;

/**
 * Enumerable
 *
 * @author  Michal Wachowski <wachowski.michal@gmail.com>
 * @package Common\Enum
 */
abstract class Enum implements EnumInterface
{
    protected $value;
    protected $name;

    /**
     * Konstruktor
     *
     * @param int|string $value
     *
     * @throws EnumException
     */
    public function __construct($value = null)
    {
        $values = $this->values();

        if ($value === null) {
            $value = reset($values);
        }

        if (array_key_exists($value, $values)) {
            $this->value = $values[$value];
            $this->name = $value;

            return;
        }

        if (in_array($value, $values)) {
            $this->value = $value;
            $this->name = array_search($value, $values);

            return;
        }

        throw new EnumException(sprintf('Invalid value "%s" for enum "%s". Only "%s" are permitted.', $value, get_class($this), implode(', ', array_keys($values))));
    }

    /**
     * Returns array with enum values
     *
     * @return array
     * @throws EnumException
     */
    public function values()
    {
        $values = array();

        $ref = new \ReflectionObject($this);
        foreach ($ref->getConstants() as $name => $value) {
            $values[$name] = $value;
        }

        if (empty($values)) {
            throw new EnumException('Enum does not define any values');
        }

        return $values;
    }

    /**
     * Returns enums value
     *
     * @return int
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Returns enums name
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Checks if enums are equal
     *
     * @param EnumInterface $other
     *
     * @return bool
     */
    public function equals(EnumInterface $other)
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->value === $other->value;
    }

    /**
     * Creates new enum instance from static call
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return $this
     */
    public static function __callStatic($name, $arguments)
    {
        return new static($name);
    }

    /**
     * Returns enum value as string
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value();
    }
}