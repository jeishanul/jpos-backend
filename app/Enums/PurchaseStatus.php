<?php

namespace App\Enums;

enum PurchaseStatus: string
{
   case RECEIVED = 'Received';
   case PARTIAL = 'Partial';
   case PENDING = 'Pending';
   case ORDERED = 'Ordered';
}
