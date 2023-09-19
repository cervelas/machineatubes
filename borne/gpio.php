<?php
require __DIR__ . '/vendor/autoload.php';

use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\PinInterface;

// Create a GPIO object
$gpio = new GPIO();

// Retrieve pin 18 and configure it as an output pin
$pin = $gpio->getOutputPin(17);
// Set the value of the pin high (turn it on)
$pin->setValue(PinInterface::VALUE_HIGH);

sleep(5);

// Set the value of the pin high (turn it on)
$pin->setValue(PinInterface::VALUE_LOW);