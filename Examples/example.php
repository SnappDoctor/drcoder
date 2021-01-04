<?php

use DrCoder\EncoderService\EncoderService;

echo EncoderService::driver()
    ->encode(['first', 'second'])[0];
