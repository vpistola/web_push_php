<?php

declare(strict_types=1);

namespace SpomkyLabs\Pki\X501\ASN1\AttributeValue;

use SpomkyLabs\Pki\ASN1\Type\UnspecifiedType;
use SpomkyLabs\Pki\X501\ASN1\AttributeType;
use SpomkyLabs\Pki\X501\ASN1\AttributeValue\Feature\PrintableStringValue;

/**
 * 'serialNumber' attribute value.
 *
 * @see https://www.itu.int/ITU-T/formal-language/itu-t/x/x520/2012/SelectedAttributeTypes.html#SelectedAttributeTypes.serialNumber
 */
final class SerialNumberValue extends PrintableStringValue
{
    /**
     * @param string $value String value
     */
    protected function __construct(string $value)
    {
        parent::__construct(AttributeType::OID_SERIAL_NUMBER, $value);
    }

    public static function create(string $value): self
    {
        return new self($value);
    }

    public static function fromASN1(UnspecifiedType $el): self
    {
        return self::create($el->asPrintableString()->string());
    }
}
