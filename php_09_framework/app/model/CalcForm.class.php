<?php
namespace app\model;

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
            $_POST['amount'] ?? null,
            $_POST['years'] ?? null,
            $_POST['rate'] ?? null
        );
    }
}