<?php declare(strict_types=1);

namespace Barranco\StackExchange\Controller\Adminhtml\Reports;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Wishlist extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Barranco_StackExchange::wishlist';

    private PageFactory $pageFactory;

    /**
     * Class constructor
     *
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    /**
     * Class execution
     *
     * @return Page
     */
    public function execute(): Page
    {
        $page = $this->pageFactory->create();
        $page->setActiveMenu('Barranco_StackExchange::wishlist');
        $page->getConfig()->getTitle()->prepend(__('Wishlist'));

        return $page;
    }
}
