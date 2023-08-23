<?php

namespace App\Enums;

enum Role: string
{
   case ADMIN = 'Admin';
   case SUPPLIER = 'Supplier';
   case CUSTOMER = 'Customer';
   case USER = 'User';
}
