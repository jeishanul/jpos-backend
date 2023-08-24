<?php

namespace App\Enums;

enum SaleType: string
{
   case INSTOCK = 'In Stock';
   case SALE = 'Sale';
   case REFUND = 'Refund';
}
