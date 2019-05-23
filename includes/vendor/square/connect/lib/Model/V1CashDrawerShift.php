<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * V1CashDrawerShift Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class V1CashDrawerShift implements ArrayAccess
{
    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'id' => 'string',
        'event_type' => 'string',
        'opened_at' => 'string',
        'ended_at' => 'string',
        'closed_at' => 'string',
        'employee_ids' => 'string[]',
        'opening_employee_id' => 'string',
        'ending_employee_id' => 'string',
        'closing_employee_id' => 'string',
        'description' => 'string',
        'starting_cash_money' => '\SquareConnect\Model\V1Money',
        'cash_payment_money' => '\SquareConnect\Model\V1Money',
        'cash_refunds_money' => '\SquareConnect\Model\V1Money',
        'cash_paid_in_money' => '\SquareConnect\Model\V1Money',
        'cash_paid_out_money' => '\SquareConnect\Model\V1Money',
        'expected_cash_money' => '\SquareConnect\Model\V1Money',
        'closed_cash_money' => '\SquareConnect\Model\V1Money',
        'device' => '\SquareConnect\Model\Device',
        'events' => '\SquareConnect\Model\V1CashDrawerEvent[]'
    );
  
    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'id' => 'id',
        'event_type' => 'event_type',
        'opened_at' => 'opened_at',
        'ended_at' => 'ended_at',
        'closed_at' => 'closed_at',
        'employee_ids' => 'employee_ids',
        'opening_employee_id' => 'opening_employee_id',
        'ending_employee_id' => 'ending_employee_id',
        'closing_employee_id' => 'closing_employee_id',
        'description' => 'description',
        'starting_cash_money' => 'starting_cash_money',
        'cash_payment_money' => 'cash_payment_money',
        'cash_refunds_money' => 'cash_refunds_money',
        'cash_paid_in_money' => 'cash_paid_in_money',
        'cash_paid_out_money' => 'cash_paid_out_money',
        'expected_cash_money' => 'expected_cash_money',
        'closed_cash_money' => 'closed_cash_money',
        'device' => 'device',
        'events' => 'events'
    );
  
    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'id' => 'setId',
        'event_type' => 'setEventType',
        'opened_at' => 'setOpenedAt',
        'ended_at' => 'setEndedAt',
        'closed_at' => 'setClosedAt',
        'employee_ids' => 'setEmployeeIds',
        'opening_employee_id' => 'setOpeningEmployeeId',
        'ending_employee_id' => 'setEndingEmployeeId',
        'closing_employee_id' => 'setClosingEmployeeId',
        'description' => 'setDescription',
        'starting_cash_money' => 'setStartingCashMoney',
        'cash_payment_money' => 'setCashPaymentMoney',
        'cash_refunds_money' => 'setCashRefundsMoney',
        'cash_paid_in_money' => 'setCashPaidInMoney',
        'cash_paid_out_money' => 'setCashPaidOutMoney',
        'expected_cash_money' => 'setExpectedCashMoney',
        'closed_cash_money' => 'setClosedCashMoney',
        'device' => 'setDevice',
        'events' => 'setEvents'
    );
  
    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'id' => 'getId',
        'event_type' => 'getEventType',
        'opened_at' => 'getOpenedAt',
        'ended_at' => 'getEndedAt',
        'closed_at' => 'getClosedAt',
        'employee_ids' => 'getEmployeeIds',
        'opening_employee_id' => 'getOpeningEmployeeId',
        'ending_employee_id' => 'getEndingEmployeeId',
        'closing_employee_id' => 'getClosingEmployeeId',
        'description' => 'getDescription',
        'starting_cash_money' => 'getStartingCashMoney',
        'cash_payment_money' => 'getCashPaymentMoney',
        'cash_refunds_money' => 'getCashRefundsMoney',
        'cash_paid_in_money' => 'getCashPaidInMoney',
        'cash_paid_out_money' => 'getCashPaidOutMoney',
        'expected_cash_money' => 'getExpectedCashMoney',
        'closed_cash_money' => 'getClosedCashMoney',
        'device' => 'getDevice',
        'events' => 'getEvents'
    );
  
    /**
      * $id The shift's unique ID.
      * @var string
      */
    protected $id;
    /**
      * $event_type The shift's current state. See [V1CashDrawerShiftEventType](#type-v1cashdrawershifteventtype) for possible values
      * @var string
      */
    protected $event_type;
    /**
      * $opened_at The time when the shift began, in ISO 8601 format.
      * @var string
      */
    protected $opened_at;
    /**
      * $ended_at The time when the shift ended, in ISO 8601 format.
      * @var string
      */
    protected $ended_at;
    /**
      * $closed_at The time when the shift was closed, in ISO 8601 format.
      * @var string
      */
    protected $closed_at;
    /**
      * $employee_ids The IDs of all employees that were logged into Square Register at some point during the cash drawer shift.
      * @var string[]
      */
    protected $employee_ids;
    /**
      * $opening_employee_id The ID of the employee that started the cash drawer shift.
      * @var string
      */
    protected $opening_employee_id;
    /**
      * $ending_employee_id The ID of the employee that ended the cash drawer shift.
      * @var string
      */
    protected $ending_employee_id;
    /**
      * $closing_employee_id The ID of the employee that closed the cash drawer shift by auditing the cash drawer's contents.
      * @var string
      */
    protected $closing_employee_id;
    /**
      * $description The time when the timecard was created, in ISO 8601 format.
      * @var string
      */
    protected $description;
    /**
      * $starting_cash_money The amount of money in the cash drawer at the start of the shift.
      * @var \SquareConnect\Model\V1Money
      */
    protected $starting_cash_money;
    /**
      * $cash_payment_money The amount of money added to the cash drawer from cash payments.
      * @var \SquareConnect\Model\V1Money
      */
    protected $cash_payment_money;
    /**
      * $cash_refunds_money The amount of money removed from the cash drawer from cash refunds. This value is always negative or zero.
      * @var \SquareConnect\Model\V1Money
      */
    protected $cash_refunds_money;
    /**
      * $cash_paid_in_money The amount of money added to the cash drawer for reasons other than cash payments.
      * @var \SquareConnect\Model\V1Money
      */
    protected $cash_paid_in_money;
    /**
      * $cash_paid_out_money The amount of money removed from the cash drawer for reasons other than cash refunds.
      * @var \SquareConnect\Model\V1Money
      */
    protected $cash_paid_out_money;
    /**
      * $expected_cash_money The amount of money that should be in the cash drawer at the end of the shift, based on the shift's other money amounts.
      * @var \SquareConnect\Model\V1Money
      */
    protected $expected_cash_money;
    /**
      * $closed_cash_money The amount of money found in the cash drawer at the end of the shift by an auditing employee.
      * @var \SquareConnect\Model\V1Money
      */
    protected $closed_cash_money;
    /**
      * $device The device running Square Register that was connected to the cash drawer.
      * @var \SquareConnect\Model\Device
      */
    protected $device;
    /**
      * $events All of the events (payments, refunds, and so on) that involved the cash drawer during the shift.
      * @var \SquareConnect\Model\V1CashDrawerEvent[]
      */
    protected $events;

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initializing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            if (isset($data["id"])) {
              $this->id = $data["id"];
            } else {
              $this->id = null;
            }
            if (isset($data["event_type"])) {
              $this->event_type = $data["event_type"];
            } else {
              $this->event_type = null;
            }
            if (isset($data["opened_at"])) {
              $this->opened_at = $data["opened_at"];
            } else {
              $this->opened_at = null;
            }
            if (isset($data["ended_at"])) {
              $this->ended_at = $data["ended_at"];
            } else {
              $this->ended_at = null;
            }
            if (isset($data["closed_at"])) {
              $this->closed_at = $data["closed_at"];
            } else {
              $this->closed_at = null;
            }
            if (isset($data["employee_ids"])) {
              $this->employee_ids = $data["employee_ids"];
            } else {
              $this->employee_ids = null;
            }
            if (isset($data["opening_employee_id"])) {
              $this->opening_employee_id = $data["opening_employee_id"];
            } else {
              $this->opening_employee_id = null;
            }
            if (isset($data["ending_employee_id"])) {
              $this->ending_employee_id = $data["ending_employee_id"];
            } else {
              $this->ending_employee_id = null;
            }
            if (isset($data["closing_employee_id"])) {
              $this->closing_employee_id = $data["closing_employee_id"];
            } else {
              $this->closing_employee_id = null;
            }
            if (isset($data["description"])) {
              $this->description = $data["description"];
            } else {
              $this->description = null;
            }
            if (isset($data["starting_cash_money"])) {
              $this->starting_cash_money = $data["starting_cash_money"];
            } else {
              $this->starting_cash_money = null;
            }
            if (isset($data["cash_payment_money"])) {
              $this->cash_payment_money = $data["cash_payment_money"];
            } else {
              $this->cash_payment_money = null;
            }
            if (isset($data["cash_refunds_money"])) {
              $this->cash_refunds_money = $data["cash_refunds_money"];
            } else {
              $this->cash_refunds_money = null;
            }
            if (isset($data["cash_paid_in_money"])) {
              $this->cash_paid_in_money = $data["cash_paid_in_money"];
            } else {
              $this->cash_paid_in_money = null;
            }
            if (isset($data["cash_paid_out_money"])) {
              $this->cash_paid_out_money = $data["cash_paid_out_money"];
            } else {
              $this->cash_paid_out_money = null;
            }
            if (isset($data["expected_cash_money"])) {
              $this->expected_cash_money = $data["expected_cash_money"];
            } else {
              $this->expected_cash_money = null;
            }
            if (isset($data["closed_cash_money"])) {
              $this->closed_cash_money = $data["closed_cash_money"];
            } else {
              $this->closed_cash_money = null;
            }
            if (isset($data["device"])) {
              $this->device = $data["device"];
            } else {
              $this->device = null;
            }
            if (isset($data["events"])) {
              $this->events = $data["events"];
            } else {
              $this->events = null;
            }
        }
    }
    /**
     * Gets id
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
  
    /**
     * Sets id
     * @param string $id The shift's unique ID.
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * Gets event_type
     * @return string
     */
    public function getEventType()
    {
        return $this->event_type;
    }
  
    /**
     * Sets event_type
     * @param string $event_type The shift's current state. See [V1CashDrawerShiftEventType](#type-v1cashdrawershifteventtype) for possible values
     * @return $this
     */
    public function setEventType($event_type)
    {
        $this->event_type = $event_type;
        return $this;
    }
    /**
     * Gets opened_at
     * @return string
     */
    public function getOpenedAt()
    {
        return $this->opened_at;
    }
  
    /**
     * Sets opened_at
     * @param string $opened_at The time when the shift began, in ISO 8601 format.
     * @return $this
     */
    public function setOpenedAt($opened_at)
    {
        $this->opened_at = $opened_at;
        return $this;
    }
    /**
     * Gets ended_at
     * @return string
     */
    public function getEndedAt()
    {
        return $this->ended_at;
    }
  
    /**
     * Sets ended_at
     * @param string $ended_at The time when the shift ended, in ISO 8601 format.
     * @return $this
     */
    public function setEndedAt($ended_at)
    {
        $this->ended_at = $ended_at;
        return $this;
    }
    /**
     * Gets closed_at
     * @return string
     */
    public function getClosedAt()
    {
        return $this->closed_at;
    }
  
    /**
     * Sets closed_at
     * @param string $closed_at The time when the shift was closed, in ISO 8601 format.
     * @return $this
     */
    public function setClosedAt($closed_at)
    {
        $this->closed_at = $closed_at;
        return $this;
    }
    /**
     * Gets employee_ids
     * @return string[]
     */
    public function getEmployeeIds()
    {
        return $this->employee_ids;
    }
  
    /**
     * Sets employee_ids
     * @param string[] $employee_ids The IDs of all employees that were logged into Square Register at some point during the cash drawer shift.
     * @return $this
     */
    public function setEmployeeIds($employee_ids)
    {
        $this->employee_ids = $employee_ids;
        return $this;
    }
    /**
     * Gets opening_employee_id
     * @return string
     */
    public function getOpeningEmployeeId()
    {
        return $this->opening_employee_id;
    }
  
    /**
     * Sets opening_employee_id
     * @param string $opening_employee_id The ID of the employee that started the cash drawer shift.
     * @return $this
     */
    public function setOpeningEmployeeId($opening_employee_id)
    {
        $this->opening_employee_id = $opening_employee_id;
        return $this;
    }
    /**
     * Gets ending_employee_id
     * @return string
     */
    public function getEndingEmployeeId()
    {
        return $this->ending_employee_id;
    }
  
    /**
     * Sets ending_employee_id
     * @param string $ending_employee_id The ID of the employee that ended the cash drawer shift.
     * @return $this
     */
    public function setEndingEmployeeId($ending_employee_id)
    {
        $this->ending_employee_id = $ending_employee_id;
        return $this;
    }
    /**
     * Gets closing_employee_id
     * @return string
     */
    public function getClosingEmployeeId()
    {
        return $this->closing_employee_id;
    }
  
    /**
     * Sets closing_employee_id
     * @param string $closing_employee_id The ID of the employee that closed the cash drawer shift by auditing the cash drawer's contents.
     * @return $this
     */
    public function setClosingEmployeeId($closing_employee_id)
    {
        $this->closing_employee_id = $closing_employee_id;
        return $this;
    }
    /**
     * Gets description
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
  
    /**
     * Sets description
     * @param string $description The time when the timecard was created, in ISO 8601 format.
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    /**
     * Gets starting_cash_money
     * @return \SquareConnect\Model\V1Money
     */
    public function getStartingCashMoney()
    {
        return $this->starting_cash_money;
    }
  
    /**
     * Sets starting_cash_money
     * @param \SquareConnect\Model\V1Money $starting_cash_money The amount of money in the cash drawer at the start of the shift.
     * @return $this
     */
    public function setStartingCashMoney($starting_cash_money)
    {
        $this->starting_cash_money = $starting_cash_money;
        return $this;
    }
    /**
     * Gets cash_payment_money
     * @return \SquareConnect\Model\V1Money
     */
    public function getCashPaymentMoney()
    {
        return $this->cash_payment_money;
    }
  
    /**
     * Sets cash_payment_money
     * @param \SquareConnect\Model\V1Money $cash_payment_money The amount of money added to the cash drawer from cash payments.
     * @return $this
     */
    public function setCashPaymentMoney($cash_payment_money)
    {
        $this->cash_payment_money = $cash_payment_money;
        return $this;
    }
    /**
     * Gets cash_refunds_money
     * @return \SquareConnect\Model\V1Money
     */
    public function getCashRefundsMoney()
    {
        return $this->cash_refunds_money;
    }
  
    /**
     * Sets cash_refunds_money
     * @param \SquareConnect\Model\V1Money $cash_refunds_money The amount of money removed from the cash drawer from cash refunds. This value is always negative or zero.
     * @return $this
     */
    public function setCashRefundsMoney($cash_refunds_money)
    {
        $this->cash_refunds_money = $cash_refunds_money;
        return $this;
    }
    /**
     * Gets cash_paid_in_money
     * @return \SquareConnect\Model\V1Money
     */
    public function getCashPaidInMoney()
    {
        return $this->cash_paid_in_money;
    }
  
    /**
     * Sets cash_paid_in_money
     * @param \SquareConnect\Model\V1Money $cash_paid_in_money The amount of money added to the cash drawer for reasons other than cash payments.
     * @return $this
     */
    public function setCashPaidInMoney($cash_paid_in_money)
    {
        $this->cash_paid_in_money = $cash_paid_in_money;
        return $this;
    }
    /**
     * Gets cash_paid_out_money
     * @return \SquareConnect\Model\V1Money
     */
    public function getCashPaidOutMoney()
    {
        return $this->cash_paid_out_money;
    }
  
    /**
     * Sets cash_paid_out_money
     * @param \SquareConnect\Model\V1Money $cash_paid_out_money The amount of money removed from the cash drawer for reasons other than cash refunds.
     * @return $this
     */
    public function setCashPaidOutMoney($cash_paid_out_money)
    {
        $this->cash_paid_out_money = $cash_paid_out_money;
        return $this;
    }
    /**
     * Gets expected_cash_money
     * @return \SquareConnect\Model\V1Money
     */
    public function getExpectedCashMoney()
    {
        return $this->expected_cash_money;
    }
  
    /**
     * Sets expected_cash_money
     * @param \SquareConnect\Model\V1Money $expected_cash_money The amount of money that should be in the cash drawer at the end of the shift, based on the shift's other money amounts.
     * @return $this
     */
    public function setExpectedCashMoney($expected_cash_money)
    {
        $this->expected_cash_money = $expected_cash_money;
        return $this;
    }
    /**
     * Gets closed_cash_money
     * @return \SquareConnect\Model\V1Money
     */
    public function getClosedCashMoney()
    {
        return $this->closed_cash_money;
    }
  
    /**
     * Sets closed_cash_money
     * @param \SquareConnect\Model\V1Money $closed_cash_money The amount of money found in the cash drawer at the end of the shift by an auditing employee.
     * @return $this
     */
    public function setClosedCashMoney($closed_cash_money)
    {
        $this->closed_cash_money = $closed_cash_money;
        return $this;
    }
    /**
     * Gets device
     * @return \SquareConnect\Model\Device
     */
    public function getDevice()
    {
        return $this->device;
    }
  
    /**
     * Sets device
     * @param \SquareConnect\Model\Device $device The device running Square Register that was connected to the cash drawer.
     * @return $this
     */
    public function setDevice($device)
    {
        $this->device = $device;
        return $this;
    }
    /**
     * Gets events
     * @return \SquareConnect\Model\V1CashDrawerEvent[]
     */
    public function getEvents()
    {
        return $this->events;
    }
  
    /**
     * Sets events
     * @param \SquareConnect\Model\V1CashDrawerEvent[] $events All of the events (payments, refunds, and so on) that involved the cash drawer during the shift.
     * @return $this
     */
    public function setEvents($events)
    {
        $this->events = $events;
        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset 
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }
  
    /**
     * Gets offset.
     * @param  integer $offset Offset 
     * @return mixed 
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }
  
    /**
     * Sets value based on offset.
     * @param  integer $offset Offset 
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }
  
    /**
     * Unsets offset.
     * @param  integer $offset Offset 
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
  
    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) {
            return json_encode(\SquareConnect\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        } else {
            return json_encode(\SquareConnect\ObjectSerializer::sanitizeForSerialization($this));
        }
    }
}
