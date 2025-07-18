@extends('layouts.master-layout')
@section('content')


   <div class="p-6 text-gray-900 dark:text-gray-100">
        <b>
            <h1 class="text-3xl">Hai, {{ Auth::user()->name }} 👋</h1>
        </b>
        <p class="mt-4">Welcome to your profile. <br>
            Here you can update your profile information, change your password, or delete your account.
        </p>
        <button id="theme-toggle" type="button"
            class="w-full flex items-center p-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 mt-4">
            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 me-2" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 me-2" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                    fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
            <span class="">Toggle dark mode</span>
        </button>
        {{-- layout --}}
        <div class="grid grid-cols-1 gap-4 mt-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
            <button class="btn-toggle-form" data-target="form-update-profile">
                <div class="p-4 dark:bg-gray-700 dark:text-gray-200 shadow-md rounded-lg">
                    <h5 class="text-lg font-semibold">Update Profile</h5>
                        Open
                </div>
            </button>
            <button class="btn-toggle-form" data-target="form-update-password">
                <div class="p-4 dark:bg-gray-700 dark:text-gray-200 shadow-md rounded-lg">
                    <h2 class="text-lg font-semibold">Update Password</h2>
                        Open
                </div>
            </button>
            <button class="btn-toggle-form" data-target="form-delete-account">
                <div class="p-4 dark:bg-gray-700 dark:text-gray-200 shadow-md rounded-lg">
                    <h2 class="text-lg font-semibold">Delete Account</h2>
                        Open
                    </div>
            </button>
        </div>
        
    </div>
    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div id="form-update-profile" class="form-section hidden">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div id="form-update-password" class="form-section hidden">
                @include('profile.partials.update-password-form')
            </div>

            <div id="form-delete-account" class="form-section hidden">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
