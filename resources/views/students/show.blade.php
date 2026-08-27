@extends('layouts.app')

@section('title', 'Student Profile')

@section('content')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('students.index') }}"
       class="inline-flex items-center gap-1.5 text-sm text-ink-500 hover:text-rose-600 mb-6 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
        </svg>
        Back to directory
    </a>

    {{-- Signature element: student profile card --}}
    <div class="rounded-3xl overflow-hidden shadow-soft border border-rose-100/70 bg-white">

        {{-- Profile header --}}
        <div class="bg-gradient-to-br from-rose-600 via-rose-600 to-ink-800 px-8 py-8">
            <div class="flex items-center gap-5">
                <img src="{{ $student->profile_picture_url }}" alt="Profile Picture"
                     class="w-20 h-20 rounded-full object-cover ring-4 ring-white/40 shadow-soft bg-rose-100 flex-shrink-0">
                <div class="min-w-0">
                    <h1 class="font-display text-2xl sm:text-3xl font-semibold text-white leading-tight truncate">
                        {{ $student->full_name }}
                    </h1>
                    <p class="mt-1.5 text-sm font-mono tracking-widest text-rose-50/90">{{ $student->student_id }}</p>
                </div>
            </div>
        </div>

        {{-- Details --}}
        <div class="px-8 py-8">
            <div class="mb-5 pb-5 border-b border-rose-50">
                <p class="text-xs font-semibold tracking-widest text-ink-400 uppercase mb-1">College</p>
                <p class="text-sm text-ink-700">College of Information Technology</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5">
                <div>
                    <p class="text-xs font-semibold tracking-widest text-ink-400 uppercase mb-1">Email</p>
                    <p class="text-sm text-ink-700">{{ $student->email }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold tracking-widest text-ink-400 uppercase mb-1">Mobile Number</p>
                    <p class="text-sm text-ink-700">{{ $student->mobile_number }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold tracking-widest text-ink-400 uppercase mb-1">Gender</p>
                    <p class="text-sm text-ink-700">{{ ucfirst($student->gender) }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold tracking-widest text-ink-400 uppercase mb-1">Date of Birth</p>
                    <p class="text-sm text-ink-700">{{ $student->date_of_birth->format('F d, Y') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold tracking-widest text-ink-400 uppercase mb-1">Program</p>
                    <p class="text-sm text-ink-700">{{ $student->program }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold tracking-widest text-ink-400 uppercase mb-1">Year Level</p>
                    <p class="text-sm text-ink-700">{{ $student->year_level }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold tracking-widest text-ink-400 uppercase mb-1">Address</p>
                    <p class="text-sm text-ink-700">{{ $student->address }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
