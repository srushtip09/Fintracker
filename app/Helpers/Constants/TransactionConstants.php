<?php

namespace App\Helpers\Constants;

class TransactionConstants
{
    /* AMT TYPE */
    public const AMT_CREDIT = "CREDIT";
    public const AMT_DEBIT = "DEBIT";
    public const AMT_TYPE = [
        self::AMT_CREDIT,
        self::AMT_DEBIT
    ];

    /* TRANSACTION TYPE */
    public const UPI = "UPI";
    public const BANK_TRANSFER = "BANK_TRANSFER";
    public const CASH = "CASH";
    public const TRANSACTION_TYPE = [
        self::UPI,
        self::BANK_TRANSFER,
        self::CASH,
    ];

}
