<?php

return [
    'plugin' => [
        'name' => 'Backend Lock',
        'description' => 'Secure your back-end when you step away from the computer. Reenter your credentials to resume where you left off.',
        'tab' => 'Customization',
    ],
    'menu' => [
        'item_tooltip' => 'Lock session',
        'confirm' => 'Are you sure you would like to lock the back-end session? You will be required to re-enter your credentials to resume where you left off.',
    ],
    'modal' => [
        'title' => 'Resume your session',
        'label_password' => 'Enter your password to continue where you left off',
    ],
    'error' => [
        'unauthorized' => 'You must re-enter your credentials to complete this action.',
        'password' => 'The password you entered was invalid.',
    ],
];
