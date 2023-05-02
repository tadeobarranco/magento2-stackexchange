<?php declare(strict_types=1);

namespace Barranco\StackExchange\Ui\Component\Listing\Column;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Helper\View;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Customer extends Column
{
    private CustomerRepositoryInterface $customerRepository;

    private View $customerViewHelper;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param CustomerRepositoryInterface $customerRepository
     * @param View $customerViewHelper
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        CustomerRepositoryInterface $customerRepository,
        View $customerViewHelper,
        array $components = [],
        array $data = []
    ) {
        $this->customerRepository = $customerRepository;
        $this->customerViewHelper = $customerViewHelper;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }

        foreach ($dataSource['data']['items'] as & $item) {
            $item[$this->getData('name')] = $this->getCustomerName((int)$item['customer_id']);
        }

        return $dataSource;
    }

    /**
     * @param int $customerId
     * @return string
     */
    private function getCustomerName(int $customerId): string
    {
        $customerData = $this->customerRepository->getById($customerId);

        return $this->customerViewHelper->getCustomerName($customerData);
    }
}
