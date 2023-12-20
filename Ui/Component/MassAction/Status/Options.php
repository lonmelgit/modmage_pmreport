<?php

namespace ModMage\PmReport\Ui\Component\MassAction\Status;

use Magento\Framework\UrlInterface;
use Zend\Stdlib\JsonSerializable;


class Options implements JsonSerializable
{
    protected $options;
    protected $data;
    protected $urlBuilder;
    protected $urlPath;
    protected $paramName;
    protected $additionalData = [];


    public function __construct(
        UrlInterface $urlBuilder,
        array $data = []
    ) {
        $this->data = $data;
        $this->urlBuilder = $urlBuilder;
    }


    public function jsonSerialize() :mixed
    {
        if ($this->options === null) {
            $options = array(
                array(
                    "value" => "1",
                    "label" => ('ok'),
                ),
                array(
                    "value" => "2",
                    "label" => ('warning'),
                )
            );
            $this->prepareData();
            foreach ($options as $optionCode) {
                $this->options[$optionCode['value']] = [
                    'type' => 'status_' . $optionCode['value'],
                    'label' => $optionCode['label'],
                ];

                if ($this->urlPath && $this->paramName) {
                    $this->options[$optionCode['value']]['url'] = $this->urlBuilder->getUrl(
                        $this->urlPath,
                        [$this->paramName => $optionCode['value']]
                    );
                }

                $this->options[$optionCode['value']] = array_merge_recursive(
                    $this->options[$optionCode['value']],
                    $this->additionalData
                );
            }
            $this->options = array_values($this->options);
        }
        return $this->options;
    }

    protected function prepareData()
    {
        foreach ($this->data as $key => $value) {
            switch ($key) {
                case 'urlPath':
                    $this->urlPath = $value;
                    break;
                case 'paramName':
                    $this->paramName = $value;
                    break;
                default:
                    $this->additionalData[$key] = $value;
                    break;
            }
        }
    }
}
