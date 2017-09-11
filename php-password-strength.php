<?php

function passwordStrength($password)
{
    $score = 0;

    if (strlen($password) == 0) {
        return 1;
    }

    $chars = str_split($password);
    for ($i = 0; $i < count($chars); $i++) {
        $score += 5.0 / ($i + 1);
    }

    /*** get the length of the password ***/
    $password_length = strlen($password);


    if ($password_length < 5)
        {
        $score += 5;
    }
    else if ($password_length > 4 && $password_length < 8)
        {
        $score += 10;
    }
    else if ($score > 7)
        {
        $score += 25;
    }

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

    $score += ($variationCount - 1) * 10;

    return round($score / 10 + 1);
}

