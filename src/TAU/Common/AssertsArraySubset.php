<?php

namespace ProyectoTAU\TAU\Common;

trait AssertsArraySubset
{
    public function AssertsArrayIsASubsetOf($expected, $actual, &$message): bool
    {
        if (is_array($expected) && is_array($actual)) {
            foreach ($expected as $key => $value) {
                if ( ! array_key_exists($key, $actual)) {
                    $message = "Keys: Expected ($key) not found in Actual";
                    return false;
                } elseif ( ! $this->AssertsArrayIsASubsetOf($expected[$key], $actual[$key], $message)){
                    $message .= " with key ($key)";
                    return false;
                }
            }

            return $this->AssertsReverseArrayIsASubsetOf($actual, $expected, $message);
        }

        return $this->checkValues($expected, $actual, $message);
    }

    private function AssertsReverseArrayIsASubsetOf($actual, $expected, &$message): bool
    {
        if (is_array($expected) && is_array($actual)) {
            foreach ($actual as $key => $value) {
                if (!array_key_exists($key, $expected)) {
                    $message = "Keys: Actual ($key) unexpected";
                    return false;
                } elseif (!$this->AssertsReverseArrayIsASubsetOf($actual[$key], $expected[$key], $message)) {
                    $message .= " in key ($key)";
                    return false;
                }
            }

            return true;
        }

        return $this->checkValues($actual, $expected, $message);
    }

    private function checkValues($expected, $actual, &$message)
    {
        if (gettype($expected) != gettype($actual)) {
            $message = "Mismatched Types: Expected (gettype($expected)) != Actual (gettype($actual))";
            return false;
        } elseif (gettype($expected) == 'object' ) {
            $expected_class = get_class($expected);
            $actual_class = get_class($actual);
            if( $expected_class != $actual_class ){
                $message = "Objects classes: Expected ($expected_class) != Actual ($actual_class)";
                return false;
            }
            if( ! $expected->equals($actual) ) {
                $message = "Objects: Expected ($expected) != Actual ($actual)";
                return false;
            }
        } elseif ($expected != $actual) {
            $message = "Values: Expected ($expected) != Actual ($actual)";
            return false;
        }
        return true;
    }
}
