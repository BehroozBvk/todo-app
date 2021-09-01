@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Articles') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="text" required name="term" class="form-control"
                                               placeholder="search...">
                                        @if(request()->has('term'))
                                            <a class="btn btn-danger mt-2" href="{{route('articles')}}">Remove Filter</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="form-group">
                            <a href="{{route('articles.create')}}" class="btn btn-success"><i
                                    class="fa fa-circle-plus"></i> Create Article</a>
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">title</th>
                                <th scope="col">publish at</th>
                                <th scope="col">action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($articles))
                                @foreach($articles as $key=>$article)
                                    <tr>
                                        <th scope="row">{{ $articles->firstItem() + $key }}</th>
                                        <td>
                                            <a target="_blank"
                                               href="{{route('articles.show',['article'=>$article])}}">{{$article->title}}</a>
                                        </td>
                                        <td>{{$article->created_at}}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button id="btnAction" type="button"
                                                        class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnAction">
                                                    <a class="dropdown-item"
                                                       href="{{route('articles.edit',['article'=>$article])}}">edit</a>
                                                    <form action="{{route('articles.destroy',['article'=>$article])}}"
                                                          method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">There are no articles.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        {{ $articles->appends(request()->query('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
