@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- Hero --}}
<div class="rounded-3xl bg-gradient-to-br from-rose-600 via-rose-600 to-ink-800 px-8 py-14 sm:px-12 sm:py-16 mb-10 relative overflow-hidden">
    <div class="absolute -right-10 -top-10 w-56 h-56 rounded-full bg-white/5"></div>
    <div class="absolute -right-24 top-20 w-72 h-72 rounded-full bg-white/5"></div>

    <div class="relative max-w-lg">
        <h1 class="font-display text-4xl sm:text-5xl font-semibold text-white leading-tight mb-4">
            Student Registration, made simple.
        </h1>
        <p class="text-rose-50/90 text-sm sm:text-base mb-8">
            Register new students, keep their records validated and organized, and pull up
            any student's profile in a click &mdash; all in one place.
        </p>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('students.create') }}"
               class="inline-flex items-center gap-2 rounded-full bg-white text-rose-700 text-sm font-semibold px-5 py-2.5 shadow-soft hover:bg-rose-50 transition-colors">
                Register a Student
            </a>
            <a href="{{ route('students.index') }}"
               class="inline-flex items-center gap-2 rounded-full bg-white/10 text-white text-sm font-semibold px-5 py-2.5 border border-white/30 hover:bg-white/20 transition-colors">
                View All Students
            </a>
        </div>
    </div>
</div>

{{-- Stats --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-10">
    <div class="bg-white rounded-2xl shadow-soft border border-rose-100/70 p-6">
        <p class="text-xs font-semibold tracking-widest text-ink-400 uppercase mb-2">Total Students</p>
        <p class="font-display text-3xl font-semibold text-ink-800">{{ $totalStudents }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow-soft border border-rose-100/70 p-6">
        <p class="text-xs font-semibold tracking-widest text-ink-400 uppercase mb-2">Programs Represented</p>
        <p class="font-display text-3xl font-semibold text-ink-800">{{ $perProgram->count() }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow-soft border border-rose-100/70 p-6">
        <p class="text-xs font-semibold tracking-widest text-ink-400 uppercase mb-2">Most Enrolled Program</p>
        <p class="font-display text-xl font-semibold text-ink-800">
            {{ $perProgram->first()->program ?? '—' }}
        </p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
    {{-- Per-program breakdown --}}
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-soft border border-rose-100/70 p-6">
        <h2 class="text-xs font-semibold tracking-widest uppercase text-ink-500 mb-5">By Program</h2>

        @if ($perProgram->isEmpty())
            <p class="text-sm text-ink-400">No data yet.</p>
        @else
            <div class="space-y-4">
                @foreach ($perProgram as $row)
                    <div>
                        <div class="flex justify-between text-sm mb-1.5">
                            <span class="font-medium text-ink-700">{{ $row->program }}</span>
                            <span class="text-ink-400">{{ $row->total }}</span>
                        </div>
                        <div class="h-1.5 rounded-full bg-rose-50 overflow-hidden">
                            <div class="h-full bg-rose-500 rounded-full"
                                 style="width: {{ $totalStudents > 0 ? round(($row->total / $totalStudents) * 100) : 0 }}%">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Recent registrations --}}
    <div class="lg:col-span-3 bg-white rounded-2xl shadow-soft border border-rose-100/70 p-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-xs font-semibold tracking-widest uppercase text-ink-500">Recent Registrations</h2>
            <a href="{{ route('students.index') }}" class="text-xs font-semibold text-rose-600 hover:text-rose-800">View all &rarr;</a>
        </div>

        @if ($recentStudents->isEmpty())
            <p class="text-sm text-ink-400">No students registered yet.</p>
        @else
            <ul class="divide-y divide-rose-50">
                @foreach ($recentStudents as $student)
                    <li>
                        <a href="{{ route('students.show', $student->id) }}"
                           class="flex items-center gap-3 py-3 group">
                            <img src="{{ $student->profile_picture_url }}"
                                 class="w-9 h-9 rounded-full object-cover ring-2 ring-white shadow-sm" alt="">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-ink-800 group-hover:text-rose-700 transition-colors truncate">
                                    {{ $student->full_name }}
                                </p>
                                <p class="text-xs text-ink-400 font-mono">{{ $student->student_id }}</p>
                            </div>
                            <span class="text-xs font-semibold text-ink-400">{{ $student->program }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

{{-- All Students --}}
<div class="mt-6 rounded-2xl bg-white shadow-soft border border-rose-100/70 p-8 flex flex-col sm:flex-row items-center justify-between gap-4">
    <div>
        <h2 class="font-display text-xl font-semibold text-ink-800 mb-1">All Students</h2>
        <p class="text-sm text-ink-500">Browse, search, and open the full student directory.</p>
    </div>
    <a href="{{ route('students.index') }}"
       class="inline-flex items-center gap-2 rounded-full bg-rose-600 text-white text-sm font-semibold px-5 py-2.5 shadow-soft hover:bg-rose-700 transition-colors whitespace-nowrap">
        View All Students
    </a>
</div>

@endsection
