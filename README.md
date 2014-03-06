# Enum for PHP

## Usage

Definition

```php
class EnumSample extends \Enum\Enum
{
    const FOO = 'foo';
    const BAR = 'bar';
    const YADA = 'yada';
}
```

There are four ways to create enum instance, each will create same value object.
By constants name, by method with same name or with constants value

```php
$enum = new EnumSample('FOO');
$enum = EnumSample::FOO();

$enum = new EnumSample('foo');
$enum = EnumSample::foo();
```

## Why do it at all

It's easier to limit values accepted by argument to those in enumerable (enum).
 Just hint type in argument and thats it.

```php
function imUsingEnum(EnumSample $sample) {
	echo $sample->value();
}
```
