<x-app-layout>
    <x-slot name="header">
        Quizler
    </x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{route('quizzes.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Yeni Ekle</a>
                <a href="{{url('/panel')}}" class="btn btn-sm btn-secondary"><i class="fa fa-reply"></i> Geri Dön</a>
            </h5>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde tempore corporis provident enim facilis omnis sapiente cum molestias et ab quam, laudantium, explicabo, dolore. Qui eos autem amet quos aliquam.
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Quiz</th>
                    <th scope="col">Soru Sayısı</th>
                    <th scope="col">Durum</th>
                    <th scope="col">Bitiş Tarihi</th>
                    <th scope="col">İşlemler</th>
                    <th scope="col">Sil</th>

                </tr>
            </thead>
            <tbody>
                @foreach($quizzes as $quiz)
                    <tr>
                        <td>{{$quiz->id}}</td>
                        <td>{{ $quiz->title }}</td>
                        <td>{{ $quiz->questions_count }}</td>
                        <td>
                            @switch($quiz->status)
                                @case('publish')
                                    <span class="badge bg-success">Aktif</span>
                                    @break
                     
                                @case('passive')
                                    <span class="badge bg-danger">Pasif</span>
                                    @break
                     
                                @case('draft')
                                    <span class="badge bg-warning">Taslak</span>
                                    @break
                            @endswitch
                        </td>
                        <td> 
                            <span title="{{$quiz->finished_at}}">
                                {{$quiz->finished_at ? $quiz->finished_at->diffForHumans() :"-"}}
                            </span> 
                        </td>
                        <td>
                            <a href="{{route('quizzes.show',$quiz->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-question"></i></a>
                            <a href="{{route('quizzes.edit',$quiz->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-pen-fancy"></i></a>
                        </td>
                        <td> 
                            <form method="POST" action="{{route('quizzes.destroy',[$quiz->id])}}" >
                            @method('DELETE')
                            @csrf
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$quizzes->links()}}
    </div>
</x-app-layout>
