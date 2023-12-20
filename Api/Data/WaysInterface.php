<?php

namespace ModMage\PmReport\Api\Data;

interface WaysInterface
{
    const ID = 'id';
    const DATE = 'date';
    const PM = 'pm';
    const QTY = 'qty';
    const STATUS = 'status';


    public function getId();

    public function getDate();

    public function getPm();

    public function getQty();

    public function getStatus();


    public function setId($id);

    public function setDate($date);

    public function setPm($pm);

    public function setQty($qty);

    public function setStatus($status);


}
