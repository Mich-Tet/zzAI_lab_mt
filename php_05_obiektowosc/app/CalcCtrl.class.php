<?php
require_once __DIR__.'/CalcForm.class.php';
require_once __DIR__.'/CalcResult.class.php';
require_once __DIR__.'/lib/Messages.class.php';

class CalcCtrl {
    private $form;
    private $result;
    private $messages;

    public function __construct() {
        $this->form = CalcForm::fromRequest();
        $this->result = new CalcResult();
        $this->messages = new Messages();
    }

    public function validate() {
        if (!isset($this->form->amount) || $this->form->amount === '') {
            $this->messages->add('Nie podano kwoty');
        }
        if (!isset($this->form->years) || $this->form->years === '') {
            $this->messages->add('Nie podano liczby lat');
        }
        if (!isset($this->form->rate) || $this->form->rate === '') {
            $this->messages->add('Nie podano oprocentowania');
        }

        if (!$this->messages->isEmpty()) return false;

        if (!is_numeric($this->form->amount)) $this->messages->add('Kwota musi być liczbą');
        if (!is_numeric($this->form->years)) $this->messages->add('Ilość lat musi być liczbą');
        if (!is_numeric($this->form->rate)) $this->messages->add('Oprocentowanie musi być liczbą');

        return $this->messages->isEmpty();
    }

    public function process() {
        if (!$this->validate()) return;

        $amount = floatval($this->form->amount);
        $years = intval($this->form->years);
        $ratePercent = floatval($this->form->rate);

        $monthlyRate = ($ratePercent * 0.01) / 12.0;
        $n = $years * 12;

        if ($monthlyRate == 0) {
            $monthly = $amount / $n;
        } else {
            $monthly = $amount * ($monthlyRate * pow(1 + $monthlyRate, $n) / (pow(1 + $monthlyRate, $n) - 1));
        }

        $this->result->monthlyPayment = round($monthly, 2);
    }

    public function getMessages() { return $this->messages; }
    public function getForm() { return $this->form; }
    public function getResult() { return $this->result; }
}
?>
