<?php

namespace Pasls\OmnipayEsewa\Message;


use Omnipay\Common\Message\ResponseInterface;

class EpayPostAuthorizeRequest extends AbstractEpayRequest
{
    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $this->validate('amount', 'returnUrl');

        $data = array();
        $data['scd'] = $this->getServiceCode();

        $data['amt'] = $this->getAmount();
        $data['txAmt'] = 0;
        $data['psc'] = 0;
        $data['pdc'] = 0;
        $data['tAmt'] = $this->getAmount();

        $data['pid'] = $this->getTransactionId();
        $data['su'] = $this->getReturnUrl();
        $data['fu'] = $this->getCancelUrl();
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        return $this->response = new EpayAuthorizeResponse($this, $data, $this->getEndpoint());
    }

} 