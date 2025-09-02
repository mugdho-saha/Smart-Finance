<?php
if (! function_exists('bd_money_format')) {
    function bd_money_format($amount, $withSymbol = true) {
        // Ensure it's numeric
        $amount = (float) $amount;

        // Split into integer and decimal part
        $decimal = sprintf("%0.2f", $amount - floor($amount));
        $integer = floor($amount);

        $integerStr = (string) $integer;
        $lastThree = substr($integerStr, -3);
        $rest = substr($integerStr, 0, -3);

        if ($rest != '') {
            $rest = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $rest);
            $formatted = $rest . "," . $lastThree;
        } else {
            $formatted = $lastThree;
        }

        // Add decimal part
        $formatted .= substr($decimal, 1);

        // Add currency symbol if required
        return $withSymbol ? $formatted . ' ৳' : $formatted;
    }
}
