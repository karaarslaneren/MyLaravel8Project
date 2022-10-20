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
                    <th scope="col">Quiz Durum</th>
                    <th scope="col">Bitiş Tarihi</th>

                </tr>
            </thead>
            <tbody>
                <td>{{$quiz->status}}</td>
                <td>{{ $quiz->finished_at ?? "-"}} </td>
            </tbody> 
        </table>
	<table class="table table-bordered">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{route('questions.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Yeni Ekle</a>
                <a href="{{url('/panel')}}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i> Geri Dön</a>
            </h5>
        </div>
            <thead>
                <tr>
                    <th scope="col">Soru</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                    <tr>
                        <td>{{ $question->question }}</td>
                        <td> 
                        <form method="POST" action="{{route('questions.destroy',[$question->id])}}" >
                        @method('DELETE')
                        @csrf
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                        </form>
                    </td>
                    </tr>
                @endforeach


            </tbody> 
        </table>
</x-app-layout>	