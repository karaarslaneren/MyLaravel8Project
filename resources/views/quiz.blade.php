<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}}
    </x-slot>
    <div class="grid grid-cols-1">
        <div class="grid grid-cols-1">
            <form method="POST" action="{{route('quiz.result',$quiz->slug)}}">
                @csrf
                @foreach($quiz->questions as $question)
                    <strong>#{{$loop->iteration}} {{$question->question}}</strong>
                    @if($question->image)
                        <div class="w-50 h-41">
                            <img src="{{asset($question->image)}}" class="img-responsive">
                        </div>
                        
                    @endif
                    @foreach($question->answers as $answer)
                    <div class="grid grid-cols-2">
                        <div class="form-check"> 
                            <input class="form-check-input" type="radio" name="{{$question->id}}" id="quiz{{$question->id}}1" value="answer1" required>
                            <label class="form-check-label" for="quiz{{$question->id}}1">
                                {{$answer->answer1}}
                            </label>
                        </div>
                        <div class="form-check"> 
                            <input class="form-check-input" type="radio" name="{{$question->id}}" id="quiz{{$question->id}}2" value="answer2" required>
                            <label class="form-check-label" for="quiz{{$question->id}}2">
                                {{$answer->answer2}}
                            </label>
                        </div>
                        <div class="form-check"> 
                            <input class="form-check-input" type="radio" name="{{$question->id}}" id="quiz{{$question->id}}3" value="answer3" required>
                            <label class="form-check-label" for="quiz{{$question->id}}3">
                                {{$answer->answer3}}
                            </label>
                        </div>
                        <div class="form-check"> 
                            <input class="form-check-input" type="radio" name="{{$question->id}}" id="quiz{{$question->id}}4" value="answer4" required>
                            <label class="form-check-label" for="quiz{{$question->id}}4">
                                {{$answer->answer4}}
                            </label>
                        </div>
                    </div>
                    @endforeach
                        <hr>
                @endforeach
                <button class="btn btn-success btn-sm w-full" type="submit">S??nav?? Bitir</button>
            </form>
        </div>
    </div>
</x-app-layout>
