@extends('layouts.profile')
@section('profile','登録済みプロフィール')

@section('introduction')
<div class="file">
    <div class="row">
        <h2>登録済みプロフィール</h2>
        <div class="col-md-8">
            <form action="{{ action('Admin\ProfileController@index') }}" method="get">
                
            </form>
        </div>
        <div class="row">
            <div class="list-profile col-md-12 mx-auto">
                <div class ="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="20%">氏名</th>
                                <th width="20%">性別</th>
                                <th width="20%">趣味</th>
                                <th widdh="20%">自己紹介</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $profiles)
                            <tr>
                                <th>{{ $profiles->id }}</th>
                                <td>{{ $profiles->name }}</td>
                                <td>{{ $profiles->gender }}</td>
                                <td>{{ $profiles->hobby }}</td>
                                <td>{{ $profiles->introduction }}</td>
                                <td>
                                    <div>
                                        <a href="{{ action('Admin\ProfileController@edit', ['id' => $profiles->id]) }}">編集</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection