<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject;

/**
 * See https://api.peakwms.com/api/documentation/index.html#model-AddressDto
 */
final class Address extends AbstractDataTransferObject
{
    public function __construct(
        public ?string $customerName = null,
        public ?string $address1 = null,
        public ?string $address2 = null,
        public ?string $postalCode = null,
        public ?string $city = null,
        public ?string $stateCode = null,
        /** Two-letter ISO code */
        public ?string $country = null,
        public ?string $company = null,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $shippingComment = null,
    ) {
    }
}
