<?php
namespace Esgi\Beer\Controller\Adminhtml\Beer;

class Delete extends \Esgi\Beer\Controller\Adminhtml\Beer
{
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Esgi\Beer\Model\Beer::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('You deleted the beer.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a beer to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
