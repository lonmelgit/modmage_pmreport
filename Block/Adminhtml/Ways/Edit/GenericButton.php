<?php

namespace ModMage\PmReport\Block\Adminhtml\Ways\Edit;

use Magento\Backend\Block\Widget\Context;
use ModMage\PmReport\Api\WaysRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class GenericButton
{
    protected $context;

    protected $waysRepository;

    public function __construct(
        Context                 $context,
        WaysRepositoryInterface $waysRepository
    )
    {
        $this->context = $context;
        $this->waysRepository = $waysRepository;
    }

    public function getId()
    {
        try {
            return $this->waysRepository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
