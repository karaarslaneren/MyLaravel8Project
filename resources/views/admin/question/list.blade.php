<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}} Quizine Ait Sorular
    </x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{route('questions.create',$quiz->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Yeni Ekle</a>
            </h5>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Soru</th>
                    <th scope="col">Fotoğraf</th>
                    <th scope="col"style="width:75px;">1. Cevap</th>
                    <th scope="col"style="width:75px;">2. Cevap</th>
                    <th scope="col"style="width:75px;">3. Cevap</th>
                    <th scope="col"style="width:75px;">4. Cevap</th>
                    <th scope="col">Doğru Cevap</th>
                    <th scope="col">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quiz->questions as $question)
                    <tr>
                        <td>{{ $question->question}}</td>
                        <td>{{ $question->image }}</td>
                        @foreach($question->answers as $answer)
                            <td>{{ $answer->answer1 ?? null }}</td>
                            <td>{{ $answer->answer2 ?? null }}</td>
                            <td>{{ $answer->answer3 ?? null }}</td>
                            <td>{{ $answer->answer4 ?? null }}</td>
                            <td class="text-success">{{ substr($answer->correct_answer,-1) }}. Cevap</td>
                        @endforeach
                        <td style="display: contents;">
                            <a href="{{route('quizzes.edit',$question->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                            <a href="{{route('quizzes.destroy',$question->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>
