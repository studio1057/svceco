#!/usr/bin/env php
<?php

require __DIR__.'/../bootstrap/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

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

$file = new SplFileObject('./volunteers-3.csv');
$file->setCsvControl(',');
$file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
$iterator = new LimitIterator($file, 1);

$notFound = 0;
$found = 0;
foreach ($iterator as $line) {
    $fullName = trim($line[0]);
    $credits = $line[9];
    /* @var \App\User $user */
    $user = App\User::where(DB::raw('CONCAT(`last_name`, " ", `first_name`)'), '=', $line[0])->first();

    if (null === $user) {
        $notFound++;
        echo $fullName . PHP_EOL;
        continue;
    } else {
        $found++;
    }

//    $user->volunteer->current_credits = (int) $credits;
//    $user->volunteer->save();
}

echo PHP_EOL . $notFound . PHP_EOL . $found . PHP_EOL;

exit($status);
