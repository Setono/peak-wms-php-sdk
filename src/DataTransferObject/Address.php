<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject;

/**
 * See https://api.peakwms.com/api/documentation/index.html#model-AddressDto
 */
final class Address extends AbstractDataTransferObject
{
    public function __construct(
        public string $customerName,
        public string $address1,
        public string $postalCode,
        public string $city,
        public string $country,
        public ?string $address2 = null,
        public ?string $stateCode = null,
        /** Two-letter ISO code */
        public ?string $company = null,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $shippingComment = null,
    ) {
    }
}
