<?php

namespace ModMage\PmReport\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class WaysActions extends Column
{
    const CMS_URL_PATH_EDIT = 'payment_history/ways/edit';
    const CMS_URL_PATH_DELETE = 'payment_history/ways/delete';
    protected $urlBuilder;
    private $editUrl;
    private $escaper;

    public function __construct(
        ContextInterface   $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface       $urlBuilder,
        Escaper            $escaper,
        array              $components = [],
        array              $data = [],
                           $editUrl = self::CMS_URL_PATH_EDIT
    )
    {
        $this->urlBuilder = $urlBuilder;
        $this->editUrl = $editUrl;
        $this->escaper = $escaper;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }


    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl($this->editUrl, ['id' => $item['id']]),
                        'label' => __('Edit')
                    ];
                    $title = $this->escaper->escapeHtml($item['pm']);
                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(self::CMS_URL_PATH_DELETE, ['id' => $item['id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete %1', $title),
                            'message' => __('Are you sure you want to delete a %1 record?', $title)
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
