<?php

namespace AlwaysBlank\Rotary;

class Constants
{
    const REGEX = '/^(?<second>\d{4})(?<first>\d{3})(?<area>\d{3})?(?<intl>\d{1,5})?/';
    const REGEX_CLEAN = '/[^0-9]/';

    /**
     * Templates
     */
    const TEMPLATE_SIMPLE          = "%s-%s";
    const TEMPLATE_SIMPLE_AREA     = "%s %s-%s";
    const TEMPLATE_PRETTY_AREA     = "(%s) %s-%s";
    const TEMPLATE_HREF            = "tel:%s%s";
    const TEMPLATE_HREF_AREA       = "tel:+1%s%s%s";
    const TEMPLATE_NORMALIZED      = "%s%s";
    const TEMPLATE_NORMALIZED_AREA = "%s%s%s";
}
