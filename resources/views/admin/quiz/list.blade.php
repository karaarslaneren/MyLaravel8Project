<x-app-layout>
    <x-slot name="header">
        Quizler
    </x-slot>
    @include('sweetalert::alert')
    <div class="grid grid-cols-1">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <form method="GET" action=" ">
                    <div class="mb-2">
                        <input type="text" name="title" placeholder="Quiz Adı" class="form-control" value="{{request()->get('title')}}">
                    </div>
                    <div class="mb-2">
                        <select class="form-control" onchange="this.form.submit()" name="status">
                            <option value="">Durum Seçiniz</option>
                            <option @if(request()->get('status')=='publish') selected @endif value="publish">Aktif</option>
                            <option @if(request()->get('status')=='passive') selected @endif value="passive">Pasif</option>
                            <option @if(request()->get('status')=='draft') selected @endif value="draft">Taslak</option>
                        </select>
                    </div>
                    @if(request()->get('title') || request()->get('status'))
                        <div>
                            <a href="{{route('quizzes.index')}}" class="btn btn-secondary w-100">Sıfırla</a>
                        </div>
                    @endif
                </form>
            </div>
            <div class="text-right">
                <div>
                    <h5>
                        <a href="{{url('/panel')}}" class="btn btn-sm btn-secondary"><i class="fa fa-reply"></i> Geri Dön</a>
                    </h5>
                </div>
                <div>
                    <h5>
                        <a href="{{route('quizzes.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Yeni Ekle</a>
                    </h5>
                </div> 
            </div>
        </div>        
        <div class="grid grid-cols-1">
            <table class="table-auto table-md  text-sm text-left">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Id
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Quiz
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Soru Sayısı
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Durum
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Bitiş Tarihi
                        </th>
                        <th scope="col" class="py-3 px-6">
                            İşlemler
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quizzes as $quiz)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$quiz->id}}
                            </th>
                            <td class="py-4 px-6">
                                {{ $quiz->title }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $quiz->questions_count }}
                            </td>
                            <td class="py-4 px-6">
                                @switch($quiz->status)
                                    @case('publish')

                                        @if(!$quiz->finished_at)
                                            <span class="badge bg-success">Aktif</span>
                                        @elseif($quiz->finished_at > now())
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-info">Katılım Süresi Dolmuştur.</span>
                                        @endif
                                        
                                        @break
                         
                                    @case('passive')
                                        <span class="badge bg-danger">Pasif</span>
                                        @break
                         
                                    @case('draft')
                                        <span class="badge bg-warning">Taslak</span>
                                        @break
                                @endswitch
                            </td>
                            <td class="py-4 px-6">
                                {{$quiz->finished_at ? $quiz->finished_at :"-"}}
                            </td>
                            <td>
                                <div class="dropdown show">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        İşlemler
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li class="dropdown-item ">
                                            <a href="{{route('quizzes.show',$quiz->id)}}" class="btn block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                Quiz Detayı
                                            </a>
                                        </li>
                                        <li class="dropdown-item ">
                                            <a href="{{route('quizzes.edit',$quiz->id)}}" class="btn block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
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
        {{$quizzes->links()}}
    </div>
</x-app-layout>
