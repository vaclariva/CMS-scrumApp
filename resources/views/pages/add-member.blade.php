@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-semibold leading-none text-gray-900">
                    Add Member
                </h1>
                <div class="flex items-center gap-2 text-sm font-medium text-gray-600">
                    Complete the form to add members
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto px-6">
        <div class="bg-white border border-gray-200 shadow-md rounded-lg p-8">
            <form class="flex flex-col gap-5">
                <div class="flex flex-col gap-1">
                    <label for="name" class="form-label text-gray-900">
                        Name
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="input border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="John Doe" 
                        value="{{ old('name') }}"
                    />
                </div>
                <div class="flex flex-col gap-1">
                    <label for="location" class="form-label text-gray-900">
                        Location
                    </label>
                    <input 
                        type="text" 
                        name="location" 
                        id="location" 
                        class="input border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="New York, USA" 
                        value="{{ old('location') }}"
                    />
                </div>
                <button type="submit" class="btn btn-primary bg-blue-500 text-white font-semibold px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Add Member
                </button>
            </form>
        </div>
    </div>    
@endsection
