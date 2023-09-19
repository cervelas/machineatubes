<?php
require __DIR__ . '/vendor/autoload.php';

use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\PinInterface;

// Create a GPIO object
$gpio = new GPIO();

// Retrieve pin 17 and configure it as an output pin
$pin = $gpio->getOutputPin(17);

if(isset($_GET['gpio']) && $_GET['gpio']=="on"){

    // Set the value of the pin high (turn it on)
    $pin->setValue(PinInterface::VALUE_HIGH);
}else{
    // Set the value of the pin high (turn it on)
    $pin->setValue(PinInterface::VALUE_LOW);
}