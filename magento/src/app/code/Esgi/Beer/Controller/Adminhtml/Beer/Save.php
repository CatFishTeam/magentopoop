<?php

namespace Esgi\Beer\Controller\Adminhtml\Beer;

use Magento\Backend\App\Action\Context;
use Esgi\Beer\Model\Beer;
use Esgi\Beer\Model\BeerFactory;
use Esgi\Beer\Model\ResourceModel\Beer as BeerResourceModel;
use Esgi\Beer\Api\BeerRepositoryInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Esgi\Beer\Controller\Adminhtml\Beer
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * Description $beerRepository field
     *
     * @var BeerRepositoryInterface $beerRepository
     */
    protected $beerRepository;
    /**
     * Description $beerFactory field
     *
     * @var BeerFactory $beerFactory
     */
    protected $beerFactory;
    /**
     * Description $beerResourceModel field
     *
     * @var BeerResourceModel $beerResourceModel
     */
    protected $beerResourceModel;

    /**
     * Save constructor
     *
     * @param Context                       $context
     * @param \Magento\Framework\Registry   $coreRegistry
     * @param DataPersistorInterface        $dataPersistor
     * @param BeerRepositoryInterface    $beerRepository
     * @param BeerFactory                $beerFactory
     * @param BeerResourceModel       $beerResourceModel
     */
    public function __construct(
        Context $context,
        \Magento\Framework\Registry $coreRegistry,
        DataPersistorInterface $dataPersistor,
        BeerRepositoryInterface $beerRepository,
        BeerFactory $beerFactory,
        BeerResourceModel $beerResourceModel
    ) {
        parent::__construct($context, $coreRegistry);

        $this->dataPersistor        = $dataPersistor;
        $this->beerRepository    = $beerRepository;
        $this->beerFactory       = $beerFactory;
        $this->beerResourceModel = $beerResourceModel;
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data           = $this->getRequest()->getPostValue();
        if ($data) {
            if (empty($data['entity_id'])) {
                $data['entity_id'] = null;
            }

            /** @var Beer $model */
            $model = $this->beerFactory->create();

            $id = $this->getRequest()->getParam('entity_id');
            if ($id) {
                try {
                    $model = $this->beerRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This beer no longer exists.'));

                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->beerRepository->save($model);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the beer.'));
            }

            $this->dataPersistor->set('beer_beer', $data);

            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
