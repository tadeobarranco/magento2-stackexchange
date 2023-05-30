<?php declare(strict_types=1);

namespace Barranco\StackExchange\Ui\DataProvider\Wishlist;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder as ApiSearchCriteriaBuilder;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;

class WishlistDataProvider extends DataProvider
{
    private CustomerRepositoryInterface $customerRepository;

    private ApiSearchCriteriaBuilder $apiSearchCriteriaBuilder;

    /**
     * Class constructor
     *
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param ReportingInterface $reporting
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RequestInterface $request
     * @param FilterBuilder $filterBuilder
     * @param CustomerRepositoryInterface $customerRepository
     * @param ApiSearchCriteriaBuilder $apiSearchCriteriaBuilder
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        CustomerRepositoryInterface $customerRepository,
        ApiSearchCriteriaBuilder $apiSearchCriteriaBuilder,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $searchCriteriaBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );
        $this->customerRepository = $customerRepository;
        $this->apiSearchCriteriaBuilder = $apiSearchCriteriaBuilder;
    }

    /**
     * @inheritdoc
     * @throws LocalizedException
     */
    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        if ($filter->getField() === 'customer_id') {
            $customerIds = $this->getCustomerIdsByName($filter->getValue());
            $filter->setValue(implode(',', $customerIds));
            $filter->setConditionType('in');
        }

        parent::addFilter($filter);
    }

    /**
     * Get customer ids from repository filter by customer name
     * @param string $customerName
     * @return array
     * @throws LocalizedException
     */
    private function getCustomerIdsByName(string $customerName): array
    {
        $searchFields = ['firstname', 'lastname'];
        $filters = [];
        $customerIds = [];

        foreach ($searchFields as $field) {
            $filters[] = $this->filterBuilder
                ->setField($field)
                ->setConditionType('like')
                ->setValue('%' . $customerName . '%')
                ->create();
        }

        $this->apiSearchCriteriaBuilder->addFilters($filters);
        $searchCriteria = $this->apiSearchCriteriaBuilder->create();

        $searchResults = $this->customerRepository->getList($searchCriteria);

        foreach ($searchResults->getItems() as $customer) {
            $customerIds[] = $customer->getId();
        }

        return $customerIds;
    }
}
