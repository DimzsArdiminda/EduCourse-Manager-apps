@extends('layouts.master-layout')
@section('content')


   <div class="p-6 text-gray-900 dark:text-gray-100">
        <b>
            <h1 class="text-3xl">Hai, {{ Auth::user()->name }} 👋</h1>
        </b>
        <p class="mt-4">Welcome to your profile. <br>
            Here you can update your profile information, change your password, or delete your account.
        </p>

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
