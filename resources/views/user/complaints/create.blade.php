@extends('user.layout')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8">
            <button onclick="history.back()"
                class="flex items-center space-x-2 text-gray-600 hover:text-gray-800 transition-colors">
                <i class="ph ph-arrow-left text-xl"></i>
                <span class="font-medium">Back</span>
            </button>
            <h1 class="text-2xl font-bold text-gray-800">Submit a Complaint</h1>
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

        <!-- User Profile Card -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8 border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-16 h-16 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white text-2xl">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800">{{ auth()->user()->name ?? 'Guest' }}</h2>
                        <p class="text-gray-500 text-sm">Member since
                            {{ auth()->user()->created_at?->format('M Y') ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Complaint Form -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-6">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="ph ph-chat-circle-dots text-blue-500 mr-3 text-xl"></i>
                    Submit Your Complaint
                </h2>
            </div>
            <div class="p-6">
                <form action="{{ route('user.complaints.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <div class="relative">
                            <input type="text" id="name" name="name"
    value="{{ old('name', auth()->user()->name ?? '') }}" required
    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-black transition-all">

                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="ph ph-user text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <div class="relative">
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', auth()->user()->email ?? '') }}" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="ph ph-envelope text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Message -->
                        <div>
    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Complaint Details</label>
    <div class="relative">
        <textarea id="message" name="message" rows="5" required
            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-black transition-all"
            placeholder="Describe your complaint or issue in detail...">{{ old('message') }}</textarea>
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none top-3">
            <i class="ph ph-chat-teardrop-text text-gray-400"></i>
        </div>
    </div>
</div>


                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium py-3 px-4 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all shadow-sm flex items-center justify-center">
                            <i class="ph ph-paper-plane-right mr-2"></i> Submit Complaint
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tips for Submitting Complaints -->
        <div class="mt-8 bg-blue-50 rounded-2xl p-6 border border-blue-100">
            <h3 class="flex items-center text-blue-800 font-medium mb-3">
                <i class="ph ph-info text-blue-500 mr-2"></i> Tips for Submitting a Complaint
            </h3>
            <ul class="space-y-2 text-sm text-blue-700">
                <li class="flex items-start">
                    <i class="ph ph-check-circle text-blue-500 mr-2 mt-0.5"></i>
                    <span>Clearly describe the issue or concern you are facing.</span>
                </li>
                <li class="flex items-start">
                    <i class="ph ph-check-circle text-blue-500 mr-2 mt-0.5"></i>
                    <span>Include relevant details such as dates, times, or locations if applicable.</span>
                </li>
                <li class="flex items-start">
                    <i class="ph ph-check-circle text-blue-500 mr-2 mt-0.5"></i>
                    <span>Maintain a professional and respectful tone in your message.</span>
                </li>
            </ul>
        </div>
    </div>
@endsection