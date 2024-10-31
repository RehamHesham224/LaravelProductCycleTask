<?php

namespace App\Enums;

enum OrderStatusEnum : string
{
    case Pending = "pending";
    case Rejected = "rejected";
    case Accepted = "accepted";
    case Delivered = "delivered";
    case Failed = "failed";
}
