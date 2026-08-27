@extends('layouts.app')

@section('title', 'Register Student')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <p class="text-xs font-semibold tracking-widest text-rose-600 uppercase mb-2">New Enrollment</p>
        <h1 class="font-display text-3xl font-semibold text-ink-800">Student Registration</h1>
        <p class="mt-2 text-sm text-ink-500">Fill in the details below to add a new student to the system.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-2xl bg-white border border-red-100 shadow-soft px-5 py-4">
            <p class="text-sm font-semibold text-red-600 mb-2">Please fix the following before continuing:</p>
            <ul class="space-y-1 text-sm text-ink-600">
                @foreach ($errors->all() as $error)
                    <li class="flex gap-2">
                        <span class="text-red-400">&bull;</span>{{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Identification --}}
        <div class="bg-white rounded-2xl shadow-soft border border-rose-100/70 p-6">
            <div class="flex items-center gap-2 mb-5">
                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                <h2 class="text-xs font-semibold tracking-widest uppercase text-ink-500">Identification</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-ink-700 mb-1.5">Student ID</label>
                    <input type="text" name="student_id" value="{{ old('student_id') }}"
                           class="w-full rounded-xl border-ink-100 bg-rose-50/50 focus:bg-white focus:border-rose-400 focus:ring-rose-400 text-sm px-4 py-2.5 transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-ink-700 mb-1.5">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full rounded-xl border-ink-100 bg-rose-50/50 focus:bg-white focus:border-rose-400 focus:ring-rose-400 text-sm px-4 py-2.5 transition-colors">
                </div>
            </div>
        </div>

        {{-- Personal Info --}}
        <div class="bg-white rounded-2xl shadow-soft border border-rose-100/70 p-6">
            <div class="flex items-center gap-2 mb-5">
                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                <h2 class="text-xs font-semibold tracking-widest uppercase text-ink-500">Personal Information</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-medium text-ink-700 mb-1.5">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}"
                           class="w-full rounded-xl border-ink-100 bg-rose-50/50 focus:bg-white focus:border-rose-400 focus:ring-rose-400 text-sm px-4 py-2.5 transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-ink-700 mb-1.5">Middle Name</label>
                    <input type="text" name="middle_name" value="{{ old('middle_name') }}"
                           class="w-full rounded-xl border-ink-100 bg-rose-50/50 focus:bg-white focus:border-rose-400 focus:ring-rose-400 text-sm px-4 py-2.5 transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-ink-700 mb-1.5">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}"
                           class="w-full rounded-xl border-ink-100 bg-rose-50/50 focus:bg-white focus:border-rose-400 focus:ring-rose-400 text-sm px-4 py-2.5 transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-ink-700 mb-1.5">Mobile Number</label>
                    <input type="text" name="mobile_number" value="{{ old('mobile_number') }}"
                           class="w-full rounded-xl border-ink-100 bg-rose-50/50 focus:bg-white focus:border-rose-400 focus:ring-rose-400 text-sm px-4 py-2.5 transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-ink-700 mb-1.5">Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                           class="w-full rounded-xl border-ink-100 bg-rose-50/50 focus:bg-white focus:border-rose-400 focus:ring-rose-400 text-sm px-4 py-2.5 transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-ink-700 mb-1.5">Gender</label>
                    <select name="gender"
                            class="w-full rounded-xl border-ink-100 bg-rose-50/50 focus:bg-white focus:border-rose-400 focus:ring-rose-400 text-sm px-4 py-2.5 transition-colors">
                        <option value="">Select&hellip;</option>
                        <option value="male" @selected(old('gender') == 'male')>Male</option>
                        <option value="female" @selected(old('gender') == 'female')>Female</option>
                        <option value="other" @selected(old('gender') == 'other')>Other</option>
                    </select>
                </div>
            </div>
            <div class="mt-5">
                <label class="block text-sm font-medium text-ink-700 mb-1.5">Address</label>
                <textarea name="address" rows="2"
                          class="w-full rounded-xl border-ink-100 bg-rose-50/50 focus:bg-white focus:border-rose-400 focus:ring-rose-400 text-sm px-4 py-2.5 transition-colors">{{ old('address') }}</textarea>
            </div>
        </div>

        {{-- Academic Info --}}
        <div class="bg-white rounded-2xl shadow-soft border border-rose-100/70 p-6">
            <div class="flex items-center gap-2 mb-5">
                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                <h2 class="text-xs font-semibold tracking-widest uppercase text-ink-500">Academic Information</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-ink-700 mb-1.5">Program</label>
                    <input type="text" name="program" value="{{ old('program') }}" placeholder="e.g. BSIT"
                           class="w-full rounded-xl border-ink-100 bg-rose-50/50 focus:bg-white focus:border-rose-400 focus:ring-rose-400 text-sm px-4 py-2.5 transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-ink-700 mb-1.5">Year Level</label>
                    <select name="year_level"
                            class="w-full rounded-xl border-ink-100 bg-rose-50/50 focus:bg-white focus:border-rose-400 focus:ring-rose-400 text-sm px-4 py-2.5 transition-colors">
                        <option value="">Select&hellip;</option>
                        <option value="1st Year" @selected(old('year_level') == '1st Year')>1st Year</option>
                        <option value="2nd Year" @selected(old('year_level') == '2nd Year')>2nd Year</option>
                        <option value="3rd Year" @selected(old('year_level') == '3rd Year')>3rd Year</option>
                        <option value="4th Year" @selected(old('year_level') == '4th Year')>4th Year</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Profile Picture --}}
        <div class="bg-white rounded-2xl shadow-soft border border-rose-100/70 p-6">
            <div class="flex items-center gap-2 mb-5">
                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                <h2 class="text-xs font-semibold tracking-widest uppercase text-ink-500">Profile Picture</h2>
            </div>

            <label id="upload-dropzone"
                   class="flex flex-col items-center justify-center gap-2 rounded-xl border-2 border-dashed border-rose-200 bg-rose-50/50 hover:bg-rose-50 py-8 cursor-pointer transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-rose-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.25 13.25a.75.75 0 001.5 0V4.636l2.955 3.129a.75.75 0 001.09-1.03l-4.25-4.5a.75.75 0 00-1.09 0l-4.25 4.5a.75.75 0 101.09 1.03L9.25 4.636v8.614z" clip-rule="evenodd" />
                    <path d="M3.5 12.75a.75.75 0 00-1.5 0v2.5A2.75 2.75 0 004.75 18h10.5A2.75 2.75 0 0018 15.25v-2.5a.75.75 0 00-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5z" />
                </svg>
                <span class="text-sm font-medium text-ink-600">Click to upload a photo</span>
                <span class="text-xs text-ink-400">JPEG or PNG, max 2MB</span>
                <input id="profile-picture-input" type="file" name="profile_picture" accept="image/*" class="hidden">
            </label>

            {{-- Live preview, hidden until a file is chosen --}}
            <div id="picture-preview-wrap" class="hidden mt-4 flex items-center gap-4">
                <img id="picture-preview" src="" alt="Selected photo preview"
                     class="w-20 h-20 rounded-2xl object-cover ring-2 ring-rose-100 shadow-soft">
                <div class="text-sm">
                    <p class="font-medium text-ink-700" id="picture-preview-name"></p>
                    <button type="button" id="picture-preview-clear"
                            class="text-rose-600 hover:text-rose-800 font-semibold text-xs mt-1">
                        Remove photo
                    </button>
                </div>
            </div>
        </div>

        <button type="submit"
                class="w-full rounded-full bg-rose-600 text-white font-semibold text-sm py-3.5 shadow-soft hover:bg-rose-700 transition-colors">
            Complete Registration
        </button>
    </form>
</div>

<script>
    (function () {
        const input = document.getElementById('profile-picture-input');
        const dropzone = document.getElementById('upload-dropzone');
        const wrap = document.getElementById('picture-preview-wrap');
        const preview = document.getElementById('picture-preview');
        const nameLabel = document.getElementById('picture-preview-name');
        const clearBtn = document.getElementById('picture-preview-clear');

        input.addEventListener('change', function () {
            const file = input.files && input.files[0];

            if (!file) {
                wrap.classList.add('hidden');
                dropzone.classList.remove('hidden');
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                nameLabel.textContent = file.name;
                wrap.classList.remove('hidden');
                dropzone.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        });

        clearBtn.addEventListener('click', function () {
            input.value = '';
            preview.src = '';
            wrap.classList.add('hidden');
            dropzone.classList.remove('hidden');
        });
    })();
</script>
@endsection
