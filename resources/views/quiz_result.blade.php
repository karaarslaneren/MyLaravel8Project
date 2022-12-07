<x-app-layout>
    <a href="{{route('quiz.detail',$quiz->slug)}}" class="btn btn-sm btn-secondary"><i class="fa fa-reply"></i> Geri Dön</a>
    <x-slot name="header">
        {{$quiz->title}} Adlı Quizin Sonucu
        <div class=" bg-gray-300">
            <ul class="p-2">
                <li>
                    Puanınız: {{$quiz->myResult->point}}
                </li>
                <li>
                    <i class="fa-regular fa-square-check text-warning"></i> İşaretlediğin Şık
                </li>
                <li>
                    <i class="fa fa-check text-success"></i> Doğru Cevap
                </li>
                <li>
                    <i class="fa fa-exclamation-triangle text-danger"></i> Yanlış Cevap
                </li>
            </ul>
        </div>
    </x-slot>
    <div class="card">
        <div class="card-body">
            @foreach($quiz->questions as $question)
                    <small>Ortalama Doğru Cevap Yüzdesi: 
                        <strong>
                            {{$question->true_percent}}%
                        </strong>
                    </small>
                    <br/>
                    <strong>#{{$loop->iteration}} {{$question->question}}</strong>
                    @if($question->image)
                        <div class="w-50 h-41">
                            <img src="{{asset($question->image)}}" class="img-responsive">
                        </div>
                    @endif
                @foreach($question->answers as $answer)
                    @if($answer->correct_answer == $question->myAnswer->answer)
                        <i class="fa-solid fa-check-double text-success"></i>
                    @else
                        <i class="fa fa-exclamation-triangle text-danger"></i>
                    @endif
                    <div class="form-check"> 
                        @if('answer1' == $answer->correct_answer)
                            <i class="fa fa-check text-success"></i>
                        @elseif('answer1' == $question->myAnswer->answer)
                            <i class="fa-regular fa-square-check text-warning"></i>
                        @endif
                        <label class="form-check-label" for="quiz{{$question->id}}1">
                            {{$answer->answer1}}
                        </label>
                    </div>
                    <div class="form-check"> 
                        @if('answer2' == $answer->correct_answer)
                            <i class="fa fa-check text-success"></i>
                        @elseif('answer2' == $question->myAnswer->answer)
                            <i class="fa-regular fa-square-check text-warning"></i>
                        @endif
                        <label class="form-check-label" for="quiz{{$question->id}}2">
                            {{$answer->answer2}}
                        </label>
                    </div>
                    <div class="form-check"> 
                        @if('answer3' == $answer->correct_answer)
                            <i class="fa fa-check text-success"></i>
                        @elseif('answer3' == $question->myAnswer->answer)
                            <i class="fa-regular fa-square-check text-warning"></i>
                        @endif
                        <label class="form-check-label" for="quiz{{$question->id}}3">
                            {{$answer->answer3}}
                        </label>
                    </div>
                    <div class="form-check"> 
                        @if('answer4' == $answer->correct_answer)
                            <i class="fa fa-check text-success"></i>
                        @elseif('answer4' == $question->myAnswer->answer)
                            <i class="fa-regular fa-square-check text-warning"></i>
                        @endif
                        <label class="form-check-label" for="quiz{{$question->id}}4">
                            {{$answer->answer4}}
                        </label>
                    </div>
                        <hr>
                @endforeach
            @endforeach
        </div>
    </div>
</x-app-layout>
