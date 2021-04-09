@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Сайты</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Последняя проверка</th>
                    <th>Код ответа</th>
                </tr>
                @foreach($urls as $url)
                    <tr>
                        <td>{{ $url->id }}</td>
                        <td><a href="{{ route('url.show', $url->id)  }}">{{ $url->name }}</a></td>
                        <td>
                            @if($url->checks()->exists())
                                {{ $url->latestCheck()->created_at }}
                            @endif
                        </td>
                        <td>
                            @if($url->checks()->exists())
                                {{ $url->latestCheck()->status_code }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
@endsection
