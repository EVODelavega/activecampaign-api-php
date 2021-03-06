<?php

namespace AC\Models;
use \DateTime;

class Campaign extends Base
{
    const TYPE_SINGLE = 'single';
    const TYPE_RECURRING = 'recurring';
    const TYPE_SPLIT = 'split';
    const TYPE_RESPONDER = 'responder';
    const TYPE_REMINDER = 'reminder';
    const TYPE_SPECIAL = 'special';
    const TYPE_ACTIVERSS = 'activerss';
    const TYPE_TEXT = 'text';

    /**
     * @var null|DateTime
     */
    protected $ldate = null;

    /**
     * @var string
     */
    protected $type = null;

    /**
     * @var int
     */
    protected $userId = null;

    /**
     * @var string
     */
    protected $name = null;

    /**
     * @var string
     */
    protected $source = null;

    /**
     * @var int
     */
    protected $sendAmt = null;

    /**
     * @var int
     */
    protected $totalAmt = null;

    /**
     * @var int
     */
    protected $opens = null;

    /**
     * @var int
     */
    protected $uniqueopens = null;

    /**
     * @var int
     */
    protected $linkclicks = null;

    /**
     * @var int
     */
    protected $subscriberclicks = null;

    /**
     * @var int
     */
    protected $totalbounces = null;

    /**
     * @var int
     */
    protected $hardbounces = null;

    /**
     * @var int
     */
    protected $softbounces = null;

    /**
     * @var int
     */
    protected $unsubscribes = null;

    /**
     * @var int
     */
    protected $unreadCount = null;

    /**
     * @var int
     */
    protected $successfulSent = null;

    /**
     * @var int
     */
    protected $basetemplateid = null;

    /**
     * @var int
     */
    protected $basemessageid = null;

    /**
     * @var int
     */
    protected $messageid = null;

    /**
     * @var \DateTime
     */
    protected $sdate = null;

    /**
     * @var \DateTime
     */
    protected $mdate = null;

    /**
     * @var null|int
     */
    protected $status = null;

    /**
     * @var array
     */
    private static $ValidTypes = array(
        self::TYPE_ACTIVERSS,
        self::TYPE_RECURRING,
        self::TYPE_REMINDER,
        self::TYPE_RESPONDER,
        self::TYPE_SINGLE,
        self::TYPE_SPECIAL,
        self::TYPE_SPLIT,
        self::TYPE_TEXT
    );

    /**
     * @param null|string|DateTime $ldate
     * @return $this
     */
    public function setLdate($ldate)
    {
        if ($ldate)
        {
            $ldate = $ldate instanceof DateTime ? $ldate : new DateTime($ldate);
        }
        $this->ldate = $ldate;
        return $this;
    }

    /**
     * @param bool $asString = true
     * @return DateTime|null|string
     */
    public function getLdate($asString = true)
    {
        $rval = $this->ldate;
        if ($rval instanceof DateTime && $asString)
        {
            $rval = $rval->format('Y-m-d H:i:s');
        }
        return $rval;
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $mid
     * @return $this
     */
    public function setMessageid($mid)
    {
        $this->messageid = (int) $mid;
        return $this;
    }

    /**
     * @return int
     */
    public function getMessageid()
    {
        return $this->messageid;
    }

    /**
     * @param int $basemessageid
     * @return $this
     */
    public function setBasemessageid($basemessageid)
    {
        $this->basemessageid = (int) $basemessageid;
        return $this;
    }

    /**
     * @return int
     */
    public function getBasemessageid()
    {
        return $this->basemessageid;
    }

    /**
     * @param int $basetemplateid
     * @return $this
     */
    public function setBasetemplateid($basetemplateid)
    {
        $this->basetemplateid = (int) $basetemplateid;
        return $this;
    }

    /**
     * @return int
     */
    public function getBasetemplateid()
    {
        return $this->basetemplateid;
    }

    /**
     * @param int $tb
     * @return $this
     */
    public function setTotalbounces($tb)
    {
        $this->totalbounces = $tb;
        return $this;
    }

    /**
     * @param int $hardbounces
     * @return $this
     */
    public function setHardbounces($hardbounces)
    {
        $this->hardbounces = (int) $hardbounces;
        return $this;
    }

    /**
     * @return int
     */
    public function getHardbounces()
    {
        return $this->hardbounces;
    }

    /**
     * @param int $linkclicks
     * @return $this
     */
    public function setLinkclicks($linkclicks)
    {
        $this->linkclicks = (int) $linkclicks;
        return $this;
    }

    /**
     * @return int
     */
    public function getLinkclicks()
    {
        return $this->linkclicks;
    }

    /**
     * @param \DateTime $mdate
     * @return $this
     */
    public function setMdate($mdate)
    {
        $this->mdate = $mdate instanceof DateTime ? $mdate : new DateTime($mdate);
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getMdate()
    {
        return $this->mdate;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $opens
     * @return $this
     */
    public function setOpens($opens)
    {
        $this->opens = (int) $opens;
        return $this;
    }

    /**
     * @return int
     */
    public function getOpens()
    {
        return $this->opens;
    }

    /**
     * @param \DateTime $sdate
     * @return $this
     */
    public function setSdate($sdate)
    {
        $this->sdate = $sdate instanceof DateTime ? $sdate : new DateTime($sdate);
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSdate()
    {
        return $this->sdate;
    }

    /**
     * @param int $sendAmt
     * @return $this
     */
    public function setSendAmt($sendAmt)
    {
        $this->sendAmt = (int) $sendAmt;
        return $this;
    }

    /**
     * @return int
     */
    public function getSendAmt()
    {
        return $this->sendAmt;
    }

    /**
     * @param int $softbounces
     * @return $this
     */
    public function setSoftbounces($softbounces)
    {
        $this->softbounces = (int) $softbounces;
        return $this;
    }

    /**
     * @return int
     */
    public function getSoftbounces()
    {
        return $this->softbounces;
    }

    /**
     * @param string $source
     * @return $this
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param int $subscriberclicks
     * @return $this
     */
    public function setSubscriberclicks($subscriberclicks)
    {
        $this->subscriberclicks = (int) $subscriberclicks;
        return $this;
    }

    /**
     * @return int
     */
    public function getSubscriberclicks()
    {
        return $this->subscriberclicks;
    }

    /**
     * @param int $successfulSent
     * @return $this
     */
    public function setSuccessfulSent($successfulSent)
    {
        $comp = $v = (int) $successfulSent;
        if ($this->totalAmt !== null || $this->sendAmt !== null)
            $comp = $this->totalAmt !== null ? $this->totalAmt : $this->sendAmt;
        if ($v > $comp)
            throw new \InvalidArgumentException(
                sprintf(
                    'Successful count cannot excede total sent! (%d > %d)',
                    $v,
                    $comp
                )
            );
        $this->successfulSent = $v;
        return $this;
    }

    /**
     * @return int
     */
    public function getSuccessfulSent()
    {
        if ($this->successfulSent === null)
        {
            $this->setSuccessfulSent(
                $this->sendAmt - $this->getTotalbounces()
            );
        }
        return $this->successfulSent;
    }

    /**
     * @return int
     */
    public function getTotalbounces()
    {
        if ($this->totalbounces === null)
            return $this->hardbounces + $this->softbounces;
        return $this->totalbounces;
    }

    /**
     * @param int $totalAmt
     * @return $this
     */
    public function setTotalAmt($totalAmt)
    {
        $this->totalAmt = (int) $totalAmt;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalAmt()
    {
        return $this->totalAmt;
    }

    /**
     * @param string $type
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setType($type)
    {
        if (!in_array($type, static::$ValidTypes))
            throw new \InvalidArgumentException(
                sprintf(
                    '%s is not a valid type, please use class constants',
                    $type
                )
            );
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $uniqueopens
     * @return $this
     */
    public function setUniqueopens($uniqueopens)
    {
        $this->uniqueopens = (int) $uniqueopens;
        return $this;
    }

    /**
     * @return int
     */
    public function getUniqueopens()
    {
        return $this->uniqueopens;
    }

    /**
     * @param int $unreadCount
     * @return $this
     */
    public function setUnreadCount($unreadCount)
    {
        $v = (int) $unreadCount;
        $comp = $this->sendAmt - $this->getTotalbounces();
        $comp -= $this->getUniqueopens();
        if ($comp <= 0)
            $comp = $v;
        if ($v > $comp)
            throw new \InvalidArgumentException(
                sprintf(
                    'Unread count cannot be higher than sent count minus bounces, minus opens (%d > %d - (%d + %d)',
                    $v,
                    $this->getSendAmt(),
                    $this->getTotalbounces(),
                    $this->getUniqueopens()
                )
            );
        $this->unreadCount = $v;
        return $this;
    }

    /**
     * @return int
     */
    public function getUnreadCount()
    {
        if ($this->unreadCount === null)
        {
            $total = $this->sendAmt ? : $this->totalAmt;
            if ($total)
                $this->setUnreadCount(
                    $total - (
                        $this->getTotalbounces() + $this->getUniqueopens()
                    )
                );
            else
                $this->setUnreadCount($total);
        }
        return $this->unreadCount;
    }

    /**
     * @param int $unsubscribes
     * @return $this
     */
    public function setUnsubscribes($unsubscribes)
    {
        $this->unsubscribes = (int) $unsubscribes;
        return $this;
    }

    /**
     * @return int
     */
    public function getUnsubscribes()
    {
        return $this->unsubscribes;
    }

    /**
     * @param int $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = (int) $userId;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }


}