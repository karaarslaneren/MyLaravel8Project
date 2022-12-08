<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}}
    </x-slot>
    @include('sweetalert::alert')
    <a href="{{route('dashboard')}}" class="btn btn-sm btn-secondary mb-4"><i class="fa fa-reply"></i> Geri Dön</a>
    <div class="grid grid-cols-1">
        <div>
            @if($quiz->myResult == null)
                @if($quiz->status == 'publish')
                    <div class="grid grid-cols-1 mb-4">
                        {{$quiz->description}}
                        <a href="{{route('quiz.join',$quiz->slug)}}" class="btn btn-primary btn-lg btn-block w-100 mb-4">Quize Katıl</a>
                    </div>
                @else
                    <a href="{{route('quizzes.edit',$quiz->id)}}" class="btn btn-primary btn-lg btn-block w-100 mb-4">Quiz Durumunu Değiştir</a>
                @endif()
            @elseif($quiz->finished_at>now());
                <div class="grid grid-cols-1 mb-4">
                    Sınavın Katılma Süresi Dolmuştur
                </div>
            @else
                <div class="grid-cols-1 ml-6 mb-4">
                    <h4 class="text-red-500 mt-2">{{$quiz->title}} Quizine Zaten Katıldınız</h4>
                    <div class="list-group">
                        @if($quiz->my_rank)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Sıralamam
                                <span class="badge bg-info rounded-pill">{{$quiz->my_rank}}</span>
                            </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Puan
                            <span class="badge bg-info rounded-pill">{{$quiz->myResult->point}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Doğru Sayısı
                            <span class="badge bg-success rounded-pill">{{$quiz->myResult->correct_answer}} Doğru</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Yanlış Sayısı
                            <span class="badge bg-danger rounded-pill">{{$quiz->myResult->wrong_answer}} Yanlış</span>
                        </li>
                    </div>
                </div>
                <div class="grid grid-cols-1 mb-4">
                    <a href="{{route('quiz.join',$quiz->slug)}}" class="btn btn-warning btn-lg btn-block w-100">Quizi Görüntüle</a>
                </div>
            @endif
        </div>
        <div class="grid grid-cols-1">
            @if(count($quiz->topTen) > 0)
                <div class="grid grid-cols-1">
                    <h4 class="card-title mt-2 text-center text-red-500">İlk 10</h4>
                    
                    <table class="table bg-light">
                        <thead>
                            <tr>
                                <th scope="col">Sıra No</th>
                                <th scope="col">Kullanıcı Fotoğraf</th>
                                <th scope="col">Kullanıcı Ad Soyad</th>
                                <th scope="col">Kullanıcı Puan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quiz->topTen as $users)
                                <tr style="vertical-align: middle;">
                                    <td scope="col">
                                        <strong>{{$loop->index +1}}.</strong>
                                        @if($users->user->id == auth()->user()->id) 
                                            <i class="fa fa-trophy text-warning"></i> 
                                        @endif
                                    </td>
                                    <td scope="col">
                                        <img class="w-8 h-8 rounded-full" src="{{$users->user->profile_photo_url}}">
                                    </td>
                                    <td scope="col">
                                        {{$users->user->name}} 
                                    </td>
                                    <td scope="col">
                                        <span class="badge bg-success rounded-pill">
                                            {{$users->point}}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    
</x-app-layout>
