<?php

namespace Pasls\OmnipayEsewa\Message;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class EpayCompletePurchaseRequest extends AbstractEpayRequest
{
    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return [];
    }

    private function verifyPayment($data)
    {
        $query = [
            'amt'   =>  $this->getAmount(),
            'pid'   =>  $data['oid'],
            'rid'   =>  $data['refId'],
            'scd'   =>  $this->getServiceCode()
        ];

        $client = new Client();
        try{
            $response = $client->request('GET', $this->getVerifyEndpoint(), [
                'query' => $query
            ]);
            $raw = $response->getBody()->getContents();

            $resXml = new \SimpleXMLElement($raw);
            $state = (string) $resXml->response_code;
            $verification_status = strtolower(trim($state));
            $data['purchaseResponse'] = (string) $raw;

        } catch(RequestException $e ){
            if ($e->hasResponse()) {
                $response = (string) $e->getResponse()->getBody()->getContents();
                $data['purchaseResponse'] = $response;
            }else{
                $data['purchaseResponse'] = $e->getMessage();
            }
            $verification_status = 'failed';
        }

        $data['purchaseRequest'] =  $query;
        $data['verification_status'] =  $verification_status;

        return $data;

    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
//        if (!$this->verifyPayment($data) ) {
//            throw new InvalidRequestException('Man in the middle attack');
//        }

        $data = array_merge($data,$this->verifyPayment($data));

        return $this->response = new EpayCompletePurchaseResponse($this, $data);
    }

}