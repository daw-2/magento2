<?php

namespace Boxydev\Quotation\Controller\Quotation;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

class Index extends Action
{
    public function execute()
    {
        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $name = $request->getParam('name');
            $email = $request->getParam('email');
            $hasError = false;

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $hasError = true;
                $this->messageManager->addErrorMessage('Cet email n\'est pas valide.');
            }

            if (strlen($name) < 10) {
                $hasError = true;
                $this->messageManager->addErrorMessage('Votre nom est trop court.');
            }

            if (!$hasError) {
                $this->messageManager->addSuccessMessage('Votre devis a bien été envoyé.');
            }
        }

        return $page;
    }
}
