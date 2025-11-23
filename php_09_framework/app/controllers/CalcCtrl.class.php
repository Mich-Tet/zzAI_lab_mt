<?php
namespace app\controllers;

use core\App;
use core\Utils;
use core\Validator;
use app\model\CalcForm;
use app\model\CalcResult;

class CalcCtrl {
    private $form;
    private $result;

    public function __construct() {
        $this->form = new CalcForm();
        $this->result = new CalcResult();
    }

    public function action_calc() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form = CalcForm::fromRequest();
            if ($this->validate()) {
                $this->calculate();
            }
        }
        $this->generateView();
    }

    private function validate() {
        $v = new Validator();
        
        $validations = [
            'amount' => ['required' => true, 'numeric' => true],
            'years' => ['required' => true, 'int' => true],
            'rate' => ['required' => true, 'float' => true]
        ];

        foreach ($validations as $field => $rules) {
            $this->form->$field = $v->validateFromRequest($field, $rules);
        }

        return App::getMessages()->isEmpty();
    }

    private function calculate() {
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

    private function generateView() {
        $form = $this->form;
        $result = $this->result;
        $messages = App::getMessages()->getMessages();
        
        require_once App::getConf()->root_path . '/app/views/CalcView.class.php';
    }
}