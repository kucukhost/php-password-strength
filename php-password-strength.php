<?php
function passwordStrength($password)
{
    $score = 0;

    if (strlen($password) == 0) {
        return 1;
    }

    $letters = str_split($password);

    $counter = 0;
    $chars = array();
    $counter = 0;
    for ($char = 0; $char < count($letters); $char++) {
        if (in_array($letters[$char], $chars)) {
            ++$counter;
            $score += 4.0 / ($counter + 1);
            continue;
        }
        else {
            $score += 4.0;
            $chars[] = $letters[$char];
        }
    }

    /*** get the length of the password ***/
    $password_length = strlen($password);
    $score = $password_length * 4;
    
        // bonus points for mixing it up
    $variations = array(
        'digits' => '/d/',
        'lower' => '/[a-z]/',
        'upper' => '/[A-Z]/',
        'nonWords' => '/W/',
    );

    $variationCount = 0;

    foreach ($variations as $regex) {
        $variationCount += preg_match($regex, $password) ? 1 : 0;
    }

    $score += ($variationCount - 1) * 8;

    $strenght = round($score / 10 + 1);
    return $strenght > 10 ? 10 : $strenght;
}

