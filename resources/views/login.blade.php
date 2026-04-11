<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @vite(['resources/css/app.css'])
    
</head>

<body>
<div class="w-[500px] p-8 rounded-3xl bg-white/10 backdrop-blur-md border border-white/20 shadow-lg text-white ">
    
    <!-- Logo -->
    <div class="flex justify-center mb-1">
      <img src="{{ asset('images/LOGO-LIGHT.png') }}" alt="logo">
    </div>

    <!-- Title -->
    <p class="text-center text-sm text-white/80 mb-6">
      Welcome back! Please enter your details.
    </p>

    <!-- Email -->
    <div class="mb-2">
      <label class="text-sm">Email</label>
      <input type="email"
        placeholder="Enter your email"
        class="w-full mt-1 px-3 py-2 rounded-lg bg-transparent border border-white/30 focus:outline-none focus:ring-2 focus:ring-orange-400 placeholder-white/50">
    </div>

    <!-- Password -->
    <div class="mb-2">
      <label class="text-sm">Password</label>
      <input type="password"
        placeholder="••••••••"
        class="w-full mt-1 px-3 py-2 rounded-lg bg-transparent border border-white/30 focus:outline-none focus:ring-2 focus:ring-orange-400 placeholder-white/50">
    </div>

    <!-- Remember + Forgot -->
    <div class="flex justify-between items-center text-sm mb-2">
      <label class="flex items-center gap-2">
        <input type="checkbox" class="accent-orange-400">
        Remember me
      </label>
      <a href="#" class="text-orange-200 hover:underline">Forgot password</a>
    </div>

    <!-- Button -->
    <button style="border-radius: 10px;" class="w-full rounded-lg bg-gray-900 text-white py-2  hover:bg-black transition">
      Sign innn
    </button>

    
    <!-- Register -->
    <p class="text-center text-xs mt-4 text-white/70">
      Don’t have an account?
      <a href="#" class="text-orange-300 hover:underline">Sign up for free</a>
    </p>

  </div>

</body>
</html>