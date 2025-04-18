<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center h-screen bg-gray-100">
  <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center text-gray-700">Register</h2>
    <form action="{{route('register.post')}}" method="POST" class="space-y-4">
      @csrf
      <div>
        <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
        <input type="name" name="name" id="name" required
          class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-indigo-300 focus:outline-none">
      </div>
      <div>
        <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
        <input type="email" name="email" id="email" required
          class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-indigo-300 focus:outline-none">
      </div>
      <div>
        <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
        <input type="password" name="password" id="password" required
          class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-indigo-300 focus:outline-none">
      </div>
      <div>
        <label for="userType" class="block text-sm font-medium text-gray-600">User Type</label>
        <select name="userType" id="userType" required
          class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-indigo-300 focus:outline-none">
          <option value="admin">Admin</option>
          <option value="hr">HR</option>
          <option value="author">Author</option>
        </select>
      </div>
      <div class="flex items-center justify-between">
        <label class="flex items-center">
          <input type="checkbox" name="remember" class="text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
          <span class="ml-2 text-sm text-gray-600">Remember Me</span>
        </label>
        <a href="#" class="text-sm text-indigo-600 hover:underline">Forgot Password?</a>
      </div>
      <button type="submit"
        class="w-full px-4 py-2 font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none">
        Register
      </button>
    </form>
    <p class="text-sm text-center text-gray-600">Don't have an account? <a href="/login" class="text-indigo-600 hover:underline">Sign in</a></p>
  </div>
</body>

</html>