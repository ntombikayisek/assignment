<?php

class FutureValue {
    private $investment;
    private $yearly_interest_rate;
    private $years;
    private $compound_monthly;

    public function __construct() {
        $this->investment = 10000;
        $this->yearly_interest_rate = 4;
        $this->years = 10;
        $this->compound_monthly = false;
    }

    public function setInvestment($investment){
        $this->investment = $investment;
    }
    public function getInvestment() {
        return $this->investment;
    }
    public function getInvestmentFormatted() {
        return $this->getCurrencyFormat($this->investment);
    }
    
    public function setYearlyInterestRate($yearly_interest_rate){
        $this->yearly_interest_rate = $yearly_interest_rate;
    }
    public function getYearlyInterestRate() {
        return $this->yearly_interest_rate;
    }
    public function getYearlyInterestRateFormatted() {
        return $this->getPercentFormat($this->yearly_interest_rate);
    }

    public function setYears($years){
        $this->years = $years;
    }
    public function getYears() {
        return $this->years;
    }

    public function setCompoundMonthly($compound_monthly){
        $this->compound_monthly = $compound_monthly;
    }
    public function getCompoundMonthly() {
        return $this->compound_monthly;
    }
    public function getCompoundMonthlyFormatted() {
        if ($this->compound_monthly) { return 'Yes'; }
        else { return 'No'; }
    }
    
    public function getMonths() {
        $months = $this->years * 12;
        return $months;
    }
    public function getMonthlyInterestRate() {
        $monthly_interest_rate = $this->yearly_interest_rate / 12;
        return $monthly_interest_rate;
    }

    public function getFutureValue() {
        $future_value = $this->investment;
        if ($this->compound_monthly) { // compound monthly
            $months = $this->getMonths();
            $monthly_rate = $this->getMonthlyInterestRate();
            for ($i = 1; $i <= $months; $i++) {
                $future_value = $future_value +
                    ($future_value * $monthly_rate *.01);
            }
        } else { // compound yearly
            for ($i = 1; $i <= $this->years; $i++) {
                $future_value = $future_value + 
                    ($future_value * $this->yearly_interest_rate *.01);
            }
        }
        return $future_value;
    }
    public function getFutureValueFormatted() {
        return $this->getCurrencyFormat($this->getFutureValue());
    }

    function validate() {
        // validate investmnent
        if ( $this->investment === FALSE ) {
            $error_message = 'Investment must be a valid number.'; 
        } else if ( $this->investment <= 0 ) {
            $error_message = 'Investment must be greater than zero.'; 
        // validate interest rate
        } else if ( $this->yearly_interest_rate === FALSE )  {
            $error_message = 'Interest rate must be a valid number.'; 
        } else if ( $this->yearly_interest_rate <= 0 ) {
            $error_message = 'Interest rate must be greater than zero.'; 
        // validate years
        } else if ( $this->years === FALSE ) {
            $error_message = 'Years must be a valid whole number.';
        } else if ( $this->years <= 0 ) {
            $error_message = 'Years must be greater than zero.';
        } else if ( $this->years > 30 ) {
            $error_message = 'Years must be less than 31.';
        // set error message to empty string if no invalid entries
        } else {
            $error_message = ''; 
        }

        return $error_message;
    }

    function getCurrencyFormat($value) {
        $formatted_value = '$'.number_format($value, 2);
        return $formatted_value;
    }

    function getPercentFormat($value) {
        $formatted_value = $value . '%';
        return $formatted_value;
    }
}
?>
