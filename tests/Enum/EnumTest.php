<?php
namespace Enum;

class EnumSampleEmpty extends Enum {

}

class EnumSample extends Enum
{
    const FOO = 'foo';
    const BAR = 'bar';
    const YADA = 'yada';
}

class EnumTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Enum\EnumException
     * @expectedExceptionMessage Enum does not define any values
     */
    public function testEmpty()
    {
        new EnumSampleEmpty('foobar');
    }

    /**
     * @dataProvider dataProvider
     */
    public function testInstanceFromArgumentValue($name, $value)
    {
        $this->assertEquals($value, (string) new EnumSample($value));
    }

    /**
     * @dataProvider dataProvider
     */
    public function testInstanceFromStaticValue($name, $value)
    {
        $this->assertEquals($value, (string) EnumSample::$value());
    }

    /**
     * @dataProvider dataProvider
     */
    public function testInstanceFromArgumentName($name, $value)
    {
        $this->assertEquals($value, (string) new EnumSample($name));
    }

    /**
     * @dataProvider dataProvider
     */
    public function testInstanceFromStaticName($name, $value)
    {
        $this->assertEquals($value, (string) EnumSample::$name());
    }

    /**
     * @expectedException \Enum\EnumException
     * @expectedExceptionMessage Invalid value
     */
    public function testInvalidInstance()
    {
        new EnumSample('foobar');
    }

    public function testDefaultValue() {
        $enum = new EnumSample();
        $this->assertEquals((string) new EnumSample('foo'), $enum->value());
    }

    /**
     * @dataProvider dataProvider
     */
    public function testValue($name, $value)
    {
        $enum = new EnumSample($value);
        $this->assertEquals($value, $enum->value());
    }

    /**
     * @dataProvider dataProvider
     */
    public function testName($name, $value)
    {
        $enum = new EnumSample($name);
        $this->assertEquals($name, $enum->name());
    }

    /**
     * @dataProvider dataProvider
     */
    public function testEqual($name, $value)
    {
        $enum1 = new EnumSample($name);
        $enum2 = new EnumSample($value);
        $this->assertTrue($enum1->equals($enum2));
    }

    public function testNotEqualByInstance()
    {
        $enum = new EnumSample('FOO');
        $this->assertFalse($enum->equals($this->getMock('\Enum\EnumInterface')));
    }

    public function testNotEqualByValue()
    {
        $enum1 = new EnumSample('FOO');
        $enum2 = new EnumSample('BAR');
        $this->assertFalse($enum1->equals($enum2));
    }

    public function dataProvider()
    {
        return array(
            array('FOO', 'foo'),
            array('BAR', 'bar'),
            array('YADA', 'yada')
        );
    }
}
 