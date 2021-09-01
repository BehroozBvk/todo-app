@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Articles</h1>
        <hr>
        <div class="row justify-content-center">
            @if(!empty($articles))
                @foreach($articles as $key=>$article)
                    <div class="col-md-8 mb-2">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{route('articles.show',['article'=>$article])}}"><b>{{$article->title}}</b></a>
                                <span style="float: right"><b>Author:</b> {{$article->user->name}}</span>
                            </div>
                            <div class="card-body">
                                {{$article->description}}
                            </div>
                        </div>
                    </div>

                @endforeach
            @else
                <p>There are no articles.</p>
            @endif
        </div>
        <div class="row justify-content-center">
            {{ $articles->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
