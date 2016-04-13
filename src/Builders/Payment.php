<?php

namespace Rangka\Quickbooks\Builders;

use Rangka\Quickbooks\Builders\Traits\HasCustomer;
use Rangka\Quickbooks\Builders\Traits\Itemizable;

class Payment extends Builder {
    use HasCustomer, Itemizable;

    /**
     * Alias to setTotalAmt()
     *
     * @param  float    $amount     Payment amount
     * @return \Rangka\Quickbooks\Builders\Payment
     */
    public function setAmount($amount) {
        return $this->setTotalAmt($amount);
    }

    /**
     * Alias to setPaymentRefNum()
     *
     * @param  string $num Reference number.
     * @return void
     */
    public function setPaymentReference($num) {
        return $this->setPaymentRefNum($num);
    }

    /**
     * Alias to setTxnDate()
     *
     * @param  string $date Date in format YYYY-MM-DD (2016-12-30)
     * @return void
     */
    public function setTransactionDate($date) {
        return $this->setTxnDate($date);
    }

    /**
     * Override Builder's toArray() to accumulate Total Amount if not provided.
     * 
     * @return array
     */
    public function toArray() {
        $data = parent::toArray();

        if (!isset($data['TotalAmt'])) {
            $data['TotalAmt'] = 0;

            foreach ($data['Line'] as $line) {
                $data['TotalAmt'] += $line['Amount'];
            }
        }

        return $data;
    }
}