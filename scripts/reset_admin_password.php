<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$username = 'admin';
$newPassword = 'Test1234!';

$user = User::where('username', $username)->first();
if (! $user) {
    echo "User not found\n";
    exit(1);
}

$user->password = Hash::make($newPassword);
$user->save();

echo "Password for user '$username' set to '$newPassword'. Please login using this password and change it immediately.\n"; 
