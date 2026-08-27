@extends('layouts.app')

@section('title', 'Registered Students')

@section('content')
<div class="flex items-end justify-between mb-8">
    <div>
        <p class="text-xs font-semibold tracking-widest text-rose-600 uppercase mb-2">Directory</p>
        <h1 class="font-display text-3xl font-semibold text-ink-800">Registered Students</h1>
    </div>
    <span class="text-sm text-ink-500">{{ $students->count() }} {{ Str::plural('student', $students->count()) }}</span>
</div>

@if ($students->isEmpty())
    <div class="rounded-2xl border border-dashed border-rose-200 bg-white/60 py-16 text-center">
        <p class="text-ink-500 text-sm mb-4">No students registered yet.</p>
        <a href="{{ route('students.create') }}"
           class="inline-flex items-center gap-2 rounded-full bg-rose-600 text-white text-sm font-semibold px-5 py-2.5 hover:bg-rose-700 transition-colors">
            Register the first student
        </a>
    </div>
@else
    <div class="bg-white rounded-2xl shadow-soft border border-rose-100/70 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead>
                    <tr class="bg-rose-50/70 text-ink-500 uppercase text-xs tracking-wider">
                        <th class="px-6 py-3.5 font-semibold">Student</th>
                        <th class="px-6 py-3.5 font-semibold">Student ID</th>
                        <th class="px-6 py-3.5 font-semibold">Program</th>
                        <th class="px-6 py-3.5 font-semibold">Year Level</th>
                        <th class="px-6 py-3.5"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-rose-50">
                    @foreach ($students as $student)
                        <tr class="hover:bg-rose-50/40 transition-colors">
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $student->profile_picture_url }}"
                                         class="w-9 h-9 rounded-full object-cover ring-2 ring-white shadow-sm" alt="">
                                    <span class="font-medium text-ink-800">{{ $student->full_name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3.5 text-ink-500 font-mono text-xs">{{ $student->student_id }}</td>
                            <td class="px-6 py-3.5 text-ink-600">{{ $student->program }}</td>
                            <td class="px-6 py-3.5">
                                <span class="inline-flex items-center rounded-full bg-rose-100 text-rose-700 text-xs font-semibold px-2.5 py-1">
                                    {{ $student->year_level }}
                                </span>
                            </td>
                            <td class="px-6 py-3.5 text-right">
                                <a href="{{ route('students.show', $student->id) }}"
                                   class="text-rose-600 font-semibold hover:text-rose-800 text-sm">View &rarr;</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection
