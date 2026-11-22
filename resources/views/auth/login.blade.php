<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-sm p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6">Login Admin</h2>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if(session('status'))
            <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
                <ul class="list-disc pl-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                  <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                  <input id="password" type="password" name="password" required
                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                  @if($errors->has('password'))
                      <p class="text-red-600 text-sm mt-1">{{ $errors->first('password') }}</p>
                  @endif
            </div>

            <!-- Button -->
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Login
                </button>
            </div>
        </form>
    </div>

</body>
</html>
