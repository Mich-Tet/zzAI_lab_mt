<?php
class CalcForm {
    public $amount;
    public $years;
    public $rate;

    public function __construct($amount = null, $years = null, $rate = null) {
        $this->amount = $amount;
        $this->years = $years;
        $this->rate = $rate;
    }

    public static function fromRequest() {
        return new CalcForm(
            isset($_REQUEST['amount']) ? trim($_REQUEST['amount']) : null,
            isset($_REQUEST['years']) ? trim($_REQUEST['years']) : null,
            isset($_REQUEST['rate']) ? trim($_REQUEST['rate']) : null
        );
    }
}
?>
