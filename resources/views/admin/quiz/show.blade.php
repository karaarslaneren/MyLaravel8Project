<x-app-layout>
	<x-slot name="header">{{$quiz->title}}</x-slot>
    <h5 class="card-title">
                <a href="{{route('question_create',$quiz->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Yeni Soru Ekle</a>
                <a href="{{url('/panel')}}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i> Geri Dön</a>
            </h5>
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-blue-100 dark:text-blue-100 mt-2">
            <thead class="text-xs text-white uppercase bg-blue-600 border-b border-blue-400 dark:text-white">
                <tr>
                    @if($quiz->finished_at)
                        <th scope="col" class="py-3 px-6 bg-blue-500">
                            Son Katılım Tarihi 
                        </th>
                        <th scope="col" class="py-3 px-6 bg-blue-500 text-center">
                            <span title="{{$quiz->finished_at}}" class="badge bg-secondary rounded-pill">{{$quiz->finished_at->diffForHumans()}}
                            </span>
                        </th>
                    @endif
                </tr>
                <tr>
                    <th scope="col" class="py-3 px-6 bg-blue-500">
                        Soru Sayısı </span>
                    </th>
                    <th scope="col" class="py-3 px-6 bg-blue-500 text-center">
                        <span class="badge bg-secondary rounded-pill">
                            {{$questions->count()}}
                        </span>
                    </th>
                </tr>
                @if($quiz->details)
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Katılımcı Sayısı
                        </th>
                        <th scope="col" class="py-3 px-6 text-center">
                            <span class="badge bg-secondary rounded-pill">
                                {{$quiz->details['join_count']}}
                            </span>
                        </th>
                    </tr>
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-blue-500">
                            Ortalama Puan
                        </th>
                        <th scope="col" class="py-3 px-6 bg-blue-500 text-center">
                            <span class="badge bg-secondary rounded-pill">
                                {{$quiz->details['average']}}
                            </span>
                        </th>
                    </tr>
                @endif
            </thead>
        </table>
    </div>

    <div class="overflow-x-auto relative shadow-md sm:rounded-lg mt-2">
        <table class="w-full text-sm text-left text-blue-100 dark:text-blue-100">
            <thead class="text-xs text-white uppercase bg-blue-600 border-b border-blue-400 dark:text-white">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Sıra No
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Kullanıcı Fotoğraf
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Kullanıcı Ad Soyad
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Kullanıcı Puan
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach($quiz->results as $result)
                    <tr class="bg-blue-600 border-b border-blue-400 hover:bg-blue-500">
                        <th scope="row" class="py-4 px-6 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                            {{$loop->index +1}}
                        </th>
                        <td class="py-4 px-6">
                            <img class="w-8 h-8 rounded-full" src="{{$result->user->profile_photo_url ?? '-' }}">
                        </td>
                        <td class="py-4 px-6">
                            {{$result->user->name ?? '-' }}
                        </td>
                        <td class="py-4 px-6">
                            {{$result->point ?? '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg mt-2">
            <table class="w-full text-sm text-left text-blue-100 dark:text-blue-100">
                <thead class="text-xs text-white uppercase bg-blue-600 border-b border-blue-400 dark:text-white">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-blue-500">
                            Soru
                        </th>
                        <th scope="col" class="py-3 px-6 bg-blue-500">
                            İşlemler
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $question)
                        <tr class="bg-blue-600 border-b border-blue-400">
                            <th scope="row" class="py-4 px-6 font-medium text-blue-50 whitespace-nowrap bg-blue-500 dark:text-blue-100">
                                {{ $question->question }}
                            </th>
                            <td class="py-4 px-6 bg-blue-500">
                                <div class="dropdown show">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        İşlemler
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li class="dropdown-item ">
                                            <a href="{{route('questions.edit',[$question->id])}}" class="btn block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                Düzenle
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <form method="POST" action="{{route('quizzes.destroy',[$quiz->id])}}" >
                                            @method('DELETE')
                                            @csrf
                                                <button type="submit" class="btn block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sil</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</x-app-layout>	