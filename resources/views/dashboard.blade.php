<x-app-layout>
    <x-slot name="header">
        Anasayfa
    </x-slot>
    <div class="grid grid-cols-2">
        <div class="grid-row-md-2 mb-6 mr-4"><h4 class="text-center">Sınavlar</h4>
            <div class="list-group">
                @foreach($quizzes as $quiz)
                    <a href="{{route('quiz.detail',$quiz->slug)}}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{$quiz->title}}</h5>
                            <small>{{$quiz->finished_at ? $quiz->finished_at->diffForHumans().' bitiyor.' : null}}</small>
                        </div>
                        <p class="mb-1">{{Str::limit($quiz->description,100)}}</p>
                        <small>{{$quiz->questions_count}} Soru</small>
                    </a>
                @endforeach
                <div class="mt-2">{{$quizzes->links() }}</div>
            </div>
    </div>
        <div class="grid-row-md-2 mb-6"><h4 class="text-center">En Yüksek Puanlar</h4>
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Sıra No</th>
                            <th scope="col">Kullanıcı Adı</th>
                            <th scope="col">Puan</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                    </tbody>
                </table>
            </div>

        </div>
            
        <div class="grid-cols-md-6"><h4>Hakkımızda</h4></div>
        
    </div>

</x-app-layout>
