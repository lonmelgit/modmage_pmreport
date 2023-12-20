<?php

namespace ModMage\PmReport\Model\Ways\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'ok', 'label' => __('OK')],
            ['value' => 'warning', 'label' => __('Warning')]
        ];
    }
}
