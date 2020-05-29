<?php
function calculate_future_value($investment, $yearly_rate, $years,
        $compound_monthly = false) {
    $future_value = $investment;
    if ($compound_monthly) {
        // compound monthly
        $months = $years * 12;
        $monthly_rate = $yearly_rate / 12;
        for ($i = 1; $i <= $months; $i++) {
            $future_value = $future_value + ($future_value * $monthly_rate *.01);
        }
    } else {
        // compound yearly
        for ($i = 1; $i <= $years; $i++) {
            $future_value = $future_value + ($future_value * $yearly_rate *.01);
        }
    }
    return $future_value;
}

function get_currency_format($value) {
    $formatted_value = '$'.number_format($value, 2);
    return $formatted_value;
}

function get_percent_format($value) {
    $formatted_value = $value . '%';
    return $formatted_value;
}
?>
