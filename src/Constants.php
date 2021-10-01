<?php

namespace AlwaysBlank\Rotary;

class Constants
{
    const REGEX = '/^(?<second>\d{4})(?<first>\d{3})(?<area>\d{3})?(?<intl>\d{1,5})?/';
    const REGEX_CLEAN = '/[^0-9]/';

    /**
     * Templates
     */
    const TEMPLATE_SIMPLE = [
        'intl' => '%intl% ',
        'area' => '%area% ',
        'first' => '%first%-',
        'second' => '%second%',
    ];
    const TEMPLATE_PRETTY = [
        'intl' => '%intl% ',
        'area' => '(%area%) ',
        'first' => '%first%-',
        'second' => '%second%',
    ];
    const TEMPLATE_HREF = [
        'pre' => 'tel:',
        'intl' => '+%intl%',
        'area' => '+1%area%',
        'first' => '%first%',
        'second' => '%second%',
    ];
    const TEMPLATE_HREF_INTL = [
        'pre' => 'tel:',
        'intl' => '+%intl%',
        'area' => '%area%',
        'first' => '%first%',
        'second' => '%second%',
    ];
    const TEMPLATE_NORMALIZED = [
        'intl' => '%intl%',
        'area' => '%area%',
        'first' => '%first%',
        'second' => '%second%',
    ];
}
