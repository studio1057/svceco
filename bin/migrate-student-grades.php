#!/usr/bin/env php
<?php

require __DIR__ . '/../bootstrap/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Artisan Application
|--------------------------------------------------------------------------
|
| When we run the console application, the current CLI command will be
| executed in this console and the response sent back to a terminal
| or another output device for the developers. Here goes nothing!
|
*/

$kernel = $app->make('Illuminate\Contracts\Console\Kernel');


$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\ArgvInput,
    new Symfony\Component\Console\Output\ConsoleOutput
);
$kernel->terminate($input, $status);

$file = new SplFileObject('./grades.csv');
$file->setCsvControl(',');
$file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
$iterator = new LimitIterator($file, 1);

foreach ($iterator as $line) {
    $email = trim($line[2]);
    $grade = (int)$line[3];

    /* @var \App\User $user */
    $user = App\User::whereEmail($email)->first();

    if (null === $user) {
        echo ($email) . PHP_EOL;
        continue;
    }

    $volunteer        = $user->volunteer;

    $volunteer->birthdate = $volunteer->birthdate->year(2016 - $grade - 5);
    $volunteer->grade = $grade;
    $volunteer->save();
}

die('done');

exit($status);
