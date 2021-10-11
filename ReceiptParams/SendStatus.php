<?php
/*
 * SendStatus.php  23.09.2021, 19:49
 * Created for project Receipts package
 * subpackage com_receipts
 * version 1.0.0
 * www.econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2021 Econsult Lab.
 */

namespace Pay54ru\ReceiptParams;

use Pay54ru\Common\ReceiptParam;


/**
 * Статус передачи чека в ОФД
 *
 * @package     Pay54ru\ReceiptParams
 *
 * @since       version 1.0
 */
class SendStatus extends ReceiptParam
{
    /**
     * Статус отправки чека - новый
     * @since 1.0.0
     */
    public const SEND_STATUS_NEW = 0;

    /**
     * Статус отправки чека - сформирован, но не отправлен в ОФД
     * @since 1.0.0
     */
    public const SEND_STATUS_NOT_SEND = 1;

    /**
     * Статус отправки чека - сформирован и отправлен в ОФД
     * @since 1.0.0
     */
    public const SEND_STATUS_SENDED = 2;

    /**
     * Статус отправки чека - еуыещвый чек???
     * @since 1.0.0
     */
    public const SEND_STATUS_TEST = 3;

}