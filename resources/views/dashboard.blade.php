<x-app-layout>
    <x-slot name="header">
        Anasayfa
    </x-slot>
    @include('sweetalert::alert')
    <div class="grid grid-cols-1 gap-4 mb-10" >
        @forelse($quizzes as $quiz)
            @if(!$quiz->myResult == null)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-red-500">
                    <div class="grid-col">
                        <div class="text-center mt-4 text-white">
                            Quiz Adı
                        </div>
                        <div class="mt-4 text-white ml-2">
                            <a href="{{route('quiz.detail',$quiz->slug)}}" class="list-group-item list-group-item-action flex-column align-items-start"> 
                                {{$quiz->title }} 
                            </a>  
                        </div>
                    </div>
                    <div class="grid-col">
                        <div class="text-center mt-4 text-white">
                            Puan
                        </div>
                        <div class="text-center mt-4 text-white">
                            {{$quiz->myResult->point}}
                        </div>
                    </div>
                    <div class="grid-col">
                        <div class="text-center mt-4 text-white">
                            Katılım Tarihi
                        </div>
                        <div class="text-center mt-4 text-white">
                            {{$quiz->myResult->created_at->format('d/m/y')}}
                        </div>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-300">
                    <div class="grid-col">
                        <div class="text-center mt-4 text-red-500 text-center">
                            Quiz Adı
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{route('quiz.detail',$quiz->slug)}}" class="list-group-item list-group-item-action flex-column align-items-start ml-2"> 
                                {{$quiz->title }} 
                            </a>  
                        </div>
                    </div>
                    <div>
                        <div class="text-center mt-4 text-red-500">
                            Bitiş Tarihi
                        </div>
                        <div class="text-center mt-4">
                                {{$quiz->finished_at ? $quiz->finished_at->diffForHumans().' bitiyor.' : null}}
                        </div>
                    </div>
                    <div class="grid-col">
                        <div class="text-center mt-4 text-red-500">
                            Soru Sayısı
                        </div>
                        <div class="text-center mt-4">
                            {{$quiz->questions_count}} Soru
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="grid-col bg-gray-200">
                <div class="grid-col text-center text-xl">
                    Şuanda aktif bir quiz yoktur.
                </div>
            </div>
            <div class="grid-col bg-gray-200">
                <div class="grid-col text-center text-xl">
                    Daha önce hiç bir quize girmediniz.
                </div>
            </div>
        @endforelse
    </div>
    @forelse($results as $result)
        <div class="grid grid-cols-1 bg-indigo-400">
            @if(!$result == null)
                   
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-10">
                    <div class="grid grid-cols-1 mt-2 text-center">
                        <div class="text-red-500">
                             
                            Sıra No
                        </div>
                        <div>
                            @if($result->user_id == auth()->user()->id) 
                                <i class="fa fa-trophy text-warning"></i> 
                            @endif
                            {{($loop->index)+1}}
                        </div>
                    </div>
                    <div class="grid grid-cols-1 mt-2">
                        <div class="text-red-500">
                            Quiz Başlığı
                        </div>
                        <div>
                            {{$result->quizResult->slug}}
                        </div>
                    </div>
                    <div class="grid grid-cols-1 mt-2 text-center">
                        <div class="text-red-500">
                            Puan
                        </div>
                        <div >
                            {{$result->point}}
                        </div>
                    </div>
                    <div class="grid grid-cols-1 mt-2">
                        <div class="text-red-500">
                            Kullanıcı Bilgileri
                        </div>
                        <div>
                            <div class="grid grid-cols-1 mt-2">
                                <p class="flex align-items-center">
                                    <img class="w-8 h-8 rounded-full mr-1" 
                                    src="{{$result->userResult->profile_photo_url}}">
                                   <strong>{{$result->userResult->name}}</strong> 
                                </p>
                            </div>                                
                        </div>
                    </div>      
                </div> 
            @endif
        </div>
    @empty
        <div class="grid-col bg-gray-200">
            <div class="grid-col text-center text-xl">
                Daha önce quize giren kullanıcı bulunamadı.
            </div>
        </div>
    @endforelse
    
</x-app-layout>
