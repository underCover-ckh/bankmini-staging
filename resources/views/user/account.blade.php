@extends('user.layout')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('user.dashboard') }}"
            class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white transition-colors">
                <i class="ph ph-arrow-left text-xl"></i>
                <span class="font-medium">Back</span>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Account Settings</h1>
            <div class="w-8"></div> <!-- Spacer for balance -->
        </div>

        <!-- Notifications -->
        <div class="space-y-4 mb-8">
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <i class="ph ph-check-circle text-green-500 text-xl mr-3"></i>
                        <div class="text-green-700 font-medium">{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm">
                    <div class="flex items-start">
                        <i class="ph ph-warning-circle text-red-500 text-xl mr-3"></i>
                        <div>
                            <h3 class="text-red-700 font-medium mb-2">There were errors with your submission:</h3>
                            <ul class="list-disc pl-5 text-red-600 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8 border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-16 h-16 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white text-2xl">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">{{ $user->name }}</h2>
                        <p class="text-gray-500 text-sm">Member since {{ $user->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Name Section -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm overflow-hidden mb-6">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center">
                <i class="ph ph-user-circle text-blue-500 mr-3 text-xl"></i>
                Update Profile Information
            </h2>
        </div>
        <div class="p-6">
            <form action="{{ route('user.account.updateName') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
                        <div class="relative">
                            <input type="text" id="name" name="name" value="{{ $user->name }}" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-600 
                                    bg-white dark:bg-gray-900 
                                    text-gray-900 dark:text-white 
                                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all 
                                    placeholder-gray-400 dark:placeholder-gray-500">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="ph ph-user text-gray-400 dark:text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium py-3 px-4 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all shadow-sm flex items-center justify-center">
                        <i class="ph ph-floppy-disk mr-2"></i> Save Changes
                    </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Update Password Section -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="ph ph-lock-key text-blue-500 mr-3 text-xl"></i>
                    Change Password
                </h2>
            </div>
            <div class="p-6">
                <form action="{{ route('user.account.updatePassword') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Current
                                Password</label>
                            <div class="relative">
                                <input type="password" id="current_password" name="current_password" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="ph ph-key text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">New
                                Password</label>
                            <div class="relative">
                                <input type="password" id="new_password" name="new_password" required minlength="6"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="ph ph-lock text-gray-400"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Minimum 6 characters</p>
                        </div>

                        <div>
                            <label for="new_password_confirmation"
                                class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                            <div class="relative">
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                    required minlength="6"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="ph ph-lock text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium py-3 px-4 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all shadow-sm flex items-center justify-center">
                            <i class="ph ph-key mr-2"></i> Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Security Tips -->
        <div class="mt-8 bg-blue-50 rounded-2xl p-6 border border-blue-100">
            <h3 class="flex items-center text-blue-800 font-medium mb-3">
                <i class="ph ph-shield-check text-blue-500 mr-2"></i> Security Tips
            </h3>
            <ul class="space-y-2 text-sm text-blue-700">
                <li class="flex items-start">
                    <i class="ph ph-check-circle text-blue-500 mr-2 mt-0.5"></i>
                    <span>Use a unique password that you don't use elsewhere</span>
                </li>
                <li class="flex items-start">
                    <i class="ph ph-check-circle text-blue-500 mr-2 mt-0.5"></i>
                    <span>Change your password regularly</span>
                </li>
                <li class="flex items-start">
                    <i class="ph ph-check-circle text-blue-500 mr-2 mt-0.5"></i>
                    <span>Never share your password with anyone</span>
                </li>
            </ul>
        </div>
    </div>
@endsection