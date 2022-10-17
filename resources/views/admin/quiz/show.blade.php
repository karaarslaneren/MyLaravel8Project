<x-app-layout>
	<x-slot name="header">{{$quiz->title}}</x-slot>
	<table class="table table-bordered">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{route('questions.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Yeni Ekle</a>
                <a href="{{url('/panel')}}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i> Geri Dön</a>
            </h5>
        </div>
            <thead>
                <tr>
                    <th scope="col">Quiz</th>
                    <th scope="col">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                    <tr>
                        <td>{{ $question->question }}</td>
                        <td>
                            <a href="{{route('questions.edit',$quiz->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-pen-fancy"></i></a>
                            <a href="{{route('questions.destroy',$quiz->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody> 
        </table>
</x-app-layout>	