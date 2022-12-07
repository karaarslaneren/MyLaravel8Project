<x-app-layout>
    @include('sweetalert::alert')
	<x-slot name="header">Soru Düzenle</x-slot>
    <div class="flex flex-md-column text-center">
        <form method="POST" action="{{route('questions.update',$question->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Soru Açıklama</label> 
                    <textarea name="description" rows="4" class="w-full bg-gray-200">{{$question->question}}
                    </textarea>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6 w-full">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Fotoğraf</label>
                    <div class="inline-block relative w-64">
                        @if($question->image)
                            <a href="{{asset($question->image)}}"target="_blank">
                                <img src="{{asset($question->image)}}" style="width:200px">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 -mx-3 mb-6">
                @foreach($question->answers as $answer)
                    <div class="mr-4">
                        <label>1.Cevap</label>
                            <textarea name="answer1" class="form-control" rows="4">{{$answer->answer1}}</textarea>
                    </div>
                    <div class="mr-4">
                        <label>2.Cevap</label>
                        <textarea name="answer2" class="form-control" rows="4">{{$answer->answer2}}</textarea>
                    </div>
                    <div class="mr-4">
                        <label>3.Cevap</label>
                        <textarea name="answer3" class="form-control" rows="4">{{$answer->answer3}}</textarea>
                    </div>
                    <div class="mr-4">
                        <label>4.Cevap</label>
                        <textarea name="answer4" class="form-control" rows="4">{{$answer->answer4}}</textarea>
                    </div>
                @endforeach
            </div>
            <div>
                <button class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 w-full"> Quiz Güncelle</button>
            </div>
        </form>
    </div>
</x-app-layout>	