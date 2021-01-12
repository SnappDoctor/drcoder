<?php

use DrCoder\EncoderService;

echo EncoderService::driver()
    ->encode(['first', 'second'])[0];
