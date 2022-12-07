<x-app-layout>
	<x-slot name="header">Yeni soru oluştur</x-slot>
    <div>
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">
                <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                    <form method="POST" action="{{route('questions.store')}}" enctype="multipart/form-data" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-gray-700" for="question">
                                Soru
                            </label>
                           <textarea name="question" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="4">{{old('question')}}</textarea>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-bold text-gray-700" for="password">
                                Fotoğraf
                            </label>
                            <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="file" name="image" placeholder="180" />
                        </div>

                        <div class="grid items-center mt-4 gap-x-2">
                            <select name="quiz_id">
                                <option>Quiz Seçiniz.</option>
                                    @foreach($quizzes as $quiz)
                                    <option value="{{$quiz->id}}">{{$quiz->id}}-{{$quiz->title}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-2 mt-4">
                            <div class="grid mr-4">
                                <label class="text-center">1.Cevap</label>
                                <textarea name="answer1" class="form-control" rows="4">{{old('answer1')}}</textarea>
                            </div>
                            <div class="grid mr-4">
                                <label class="text-center">2.Cevap</label>
                                <textarea name="answer2" class="form-control" rows="4">{{old('answer2')}}</textarea>
                            </div>
                            <div class="grid mt-4 mr-4">
                                <label class="text-center">3.Cevap</label>
                                <textarea name="answer3" class="form-control" rows="4">{{old('answer3')}}</textarea>
                            </div>
                            <div class="grid mt-4 mr-4">
                                <label class="text-center">4.Cevap</label>
                                <textarea name="answer4" class="form-control" rows="4">{{old('answer4')}}</textarea>
                            </div>
                        </div>
                        <div class="grid items-center mt-4 gap-x-2">
                            <label class="text-center">Doğru Cevap</label>
                            <select name="correct_answer" class="grid-cols-1">
                                <option @if(old('correct_answer')=='answer1') selected @endif value="answer1">1.Cevap</option>
                                <option @if(old('correct_answer')=='answer2') selected @endif value="answer2">2.Cevap</option>
                                <option @if(old('correct_answer')=='answer3') selected @endif value="answer3">3.Cevap</option>
                                <option @if(old('correct_answer')=='answer4') selected @endif value="answer4">4.Cevap</option>
                            </select>
                        </div>
                        <div class="grid items-center mt-4 gap-x-2">
                            <button type="submit" class="px-6 py-2 text-sm font-semibold rounded-md shadow-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
                                Soru Oluştur
                            </button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>	