<?php

namespace AlwaysBlank\Rotary;

class Constants
{
    const REGEX = '/^(?:\D*(\d{3})){0,1}\D*(\d{3})\D*(\d{3,4})$/m';

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