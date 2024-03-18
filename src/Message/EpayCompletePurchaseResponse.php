<?php

namespace Pasls\OmnipayEsewa\Message;


use Omnipay\Common\Message\AbstractResponse;

class EpayCompletePurchaseResponse extends AbstractResponse
{
    /**
     * @{@inheritdoc}
     */
    public function isSuccessful()
    {
        return $this->data['verification_status'] === "success";
    }

    /**
     * @{@inheritdoc}
     */
    public function getTransactionReference()
    {
        return $this->data['refId'];
    }

    public function getPurchaseRequest()
    {
        return $this->data['purchaseRequest'];
    }

    public function getPurchaseResponse()
    {
        return $this->data['purchaseResponse'];
    }

} 