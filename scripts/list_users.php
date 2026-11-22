<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$users = User::select('id','username','email','password')->limit(5)->get()->makeVisible('password')->toArray();
echo json_encode($users, JSON_PRETTY_PRINT) . PHP_EOL;
