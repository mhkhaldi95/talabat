<?php
/**
 * Created by PhpStorm.
 * User: Eng samer i. alkahlout
 * Date: 12/1/2018
 * Time: 8:08 AM
 */


namespace App\Constants;

class Enum
{

    // System Messages Enum
    const DONE_SUCCESSFULLY = '200.0.0';
    const CREATED_SUCCESSFULLY = '200.202.0';
    const UPDATED_SUCCESSFULLY = '200.202.4';
    const DELETED_SUCCESSFULLY = '200.204.01';
    const _SUCCESSFULLY = '200.202.0';
    const CREATED_WITHOUT_SEND_SMS = '200.202.2';


    const UNAUTHORIZED = '400.401.000';
    const INVALID_OLD_PASSWORD = '400.422.001';

    const NOT_FOUND = '400.404.0';
    const GENERAL_ERROR = '500.000.0';


    // role user

    const SUPER_ADMIN = 1;
    const ADMIN = 2;
    const Branch = 3;
    const CUSTOMER = 4;

    // user gender

    const MALE = 1;
    const FEMALE = 2;


    // product status

    const PUBLISHED = 'published';
    const INACTIVE = 'inactive';

    // discount type

    const NO_DISCOUNT = 1;
    const DISCOUNT_PERCENTAGE = 2;
    const DISCOUNT_FIXED = 3;


    // branch status
    const BRANCH_OPEN = 'open';
    const BRANCH_CLOSED = 'closed';


    // type discount coupon
    const FIXED = 'fixed';
    const PERCENTAGE = 'percentage';


    // type discount coupon
    const INITIATED = 'initiated';
    const PAID = 'paid';
    const ACCEPT = 'accept';
    const REJECT = 'reject';
    const DONE = 'done';


}

