@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h2 class="text-xl font-bold mb-4">✅ Kết quả</h2>
    <p>Bạn trả lời đúng {{ $score }} trên {{ count($questions) }} câu hỏi.</p>
    <p class="text-gray-600 mt-2">
        Tỷ lệ chính xác: <span class="font-semibold text-indigo-600">{{ $percentage }}%</span>
    </p>

    <div class="mt-6 flex gap-4" x-data="{ showModal: false }">
        <!-- Button mở modal -->
        <button @click="showModal = true"
            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow transition">
            🔁 Làm lại đề thi
        </button>

        <!-- Làm đề thi khác -->
        <a href="{{ route('exam.list') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
            🎯 Làm đề thi khác
        </a>

        <!-- Modal xác nhận -->
        <div x-show="showModal" x-cloak
             class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50"
             x-transition>
            <div @click.outside="showModal = false"
                 class="bg-white rounded-xl p-6 shadow-lg max-w-sm w-full text-center"
                 x-transition.scale>
                <h2 class="text-lg font-bold text-gray-800 mb-4">Bạn có chắc chắn muốn làm lại đề thi này?</h2>
                <div class="flex justify-center gap-4">
                    <form action="{{ route('exams.retake', $exam->id) }}" method="GET">
                        <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow">
                            Có, làm lại
                        </button>
                    </form>
                    <button @click="showModal = false"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                        Hủy
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
