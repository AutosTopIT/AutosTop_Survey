@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>{{ $questionnaire->title }}</h1>
            @if ($questionnaire->purpose)
                <p class="text-muted">{{ $questionnaire->purpose }}</p>
            @endif

            <form action="/surveys/{{$questionnaire->id}}-{{ Str::slug($questionnaire->title) }}" method="post" id="surveyForm">
            @csrf

            @foreach($questionnaire->questions as $key => $question)
            <div class="card mt-4">
                <div class="card-header"><strong>{{$key + 1}}</strong> {{$question->question}}</div>
                    <div class="card-body">

                        @error('responses.' . $key . '.answer_id')
                            <small class="text-danger">{{$message}}</small>
                        @enderror

                        <ul class="list-group">
                            @foreach($question->answers as $answer)
                                <label for="answer{{$answer->id}}">
                                    <li class="list-group-item">
                                    <input type="checkbox" name="responses[{{ $key }}][answer_id]" value="{{ $answer->id }}" {{ (old('responses.' . $key . '.answer_id') == $answer->id) ? 'checked' : '' }}>
                                    {{$answer->answer}}
                                    <input type="hidden" name="responses[{{ $key }}][question_id]" value="{{$question->id}}">
                                    </li>
                                </label>
                            @endforeach
                            <div class="form-group mt-2">
                                <label for="comment{{$answer->id}}">Vaš komentar</label>
                                <input name="responses[{{ $key }}][comments][{{$answer->id}}]" type="text" class="form-control" id="comment{{$answer->id}}" aria-describedby="commentHelp" placeholder="Unesite komentar ovde">
                            </div>
                        </ul>
                    </div>
                </div>      
            </div>
            @endforeach     
                            <div>
                                <button type="button" class="btn btn-dark" id="completeSurvey">Complete Survey</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
