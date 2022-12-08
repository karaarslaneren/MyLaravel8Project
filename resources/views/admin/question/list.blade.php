<x-app-layout>
    <x-slot name="header">
    Sorular
    </x-slot>
    @include('sweetalert::alert')
    <div class="grid grid-cols-1 ">
        <div class="mb-2 grid grid-cols-1 ">
            <div class="grid grid-cols-2 mb-2">
                <form method="GET" action=" ">
                    <input type="text" name="question" placeholder="Soru Adı" class="form-control" value="{{request()->get('question')}}">
                    @if(request()->get('question'))
                        <div>
                            <a href="{{route('questions.index')}}" class="btn btn-secondary w-100">Sıfırla</a>
                        </div>
                     @endif
                </form>
            <h5 class="mb-4 text-right">
                <a href="{{route('questions.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Yeni Ekle</a>
                <a href="{{route('quizzes.index')}}" class="btn btn-sm btn-secondary"><i class="fa fa-reply"></i> Geri Dön</a>
            </h5>
            </div>
    
            @foreach($questions as $question)
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4 mb-2 mt-2">
                    <div class="grid-col">
                        <div class="grid-col text-center mt-2">
                            Quiz Bilgileri
                        </div>
                        <div class="grid-col mt-2 text-center">
                            {{$question->quiz_id}} {{$question->quiz->title}}
                        </div>
                    </div>
                    <div class="grid-col">
                        <div class="grid-col text-center mt-2">
                            Soru
                        </div>
                        <div class="grid-col mt-2 text-center">
                        {{ $question->question}}
                        </div>
                    </div>
                    <div class="grid-col text-center mt-2">
                        <div class="dropdown show mt-2">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                İşlemler
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li class="dropdown-item ">
                                    <a href="{{route('questions.edit',$question->id)}}" class="btn block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Düzenle
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <form method="POST" action="{{route('questions.destroy',[$question->id])}}" >
                                    @method('DELETE')
                                    @csrf
                                        <button type="submit" class="btn block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sil</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
        {{$questions->links()}}
    </div>
</x-app-layout>
