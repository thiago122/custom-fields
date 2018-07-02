<?php
/**
 * Class to handle coupon operations
 * Changes by Alex Rabinovich
 *
 * @author Joash Pereira
 * @date  2015-06-05
 */
class Coupon {

    public function generate($options = []) {
        $uppercase    = ['Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', 'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Z', 'X', 'C', 'V', 'B', 'N', 'M'];
        $lowercase    = ['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'z', 'x', 'c', 'v', 'b', 'n', 'm'];
        $numbers      = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

        $coupon = '';

            for ($i = 0; $i < 3; $i++) {
                $coupon .= $lowercase[mt_rand(0, count($lowercase) - 1)];
            }
            for ($i = 0; $i < 4; $i++) {
                $coupon .= $numbers[mt_rand(0, count($numbers) - 1)];
            }

        return $coupon;

    }

}
