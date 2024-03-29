@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1 class="my-4">Панель управления<br>
            <small>Статьи</small>
        </h1>
        <br>
        <a href="{!!  route('articles.add') !!}" class="btn btn-info">Добавить статью</a>
        <br>
        <br>
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Наименование</th>
                <th>Автор</th>
                <th>Дата добавления</th>
                <th>Действия</th>
            </tr>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                   {{-- <td>{!! $article->author !!}</td>--}}
                    <td>{{ $article->created_at->format('d-m-Y H:i') }}</td>

                    <td><a href="{!! route('articles.edit', ['id' => $article->article_id]) !!}">Редактировать</a> |
                        <a href="" class="delete" rel="{{ $article->article_id }}">Удалить</a></td>
                    <a><td>
                        @if ($article->status)
                            Опубликована
                            <a href="{!! route('articles.decline', ['id' => $article->article_id]) !!}">Снять с публикации</a>
                        @else
                            На модерации
                            <a href="{!! route('articles.accepted', ['id' => $article->article_id]) !!}">Опубликовать</a>
                        @endif
                        </td>
                    </a>
                </tr>
            @endforeach
        </table>
    </main>
@stop

@section('js')
    <script>
        $(function () {
            $('.delete').on ('click', function () {
                if (confirm('Вы дйствительно хотите удалить эту запись?')) {
                    let id = $(this).attr("rel");
                    $.ajax({
                        type: "DELETE",
                        url: "{!! route('articles.delete') !!}",
                        data: {_token:"{{csrf_token()}}", id:id},
                        success: function() {
                            alertify.alert(" Успешно удалено ");
                            alertify.success("{!! session()->get('success')  !!}");
                            // location.reload();
                        },
                        error: function () {
                            alertify.alert(" Ошибка ");
                            alertify.error("{!! session()->get('error')  !!}");
                        }
                    })
                } else {
                    alertify.error("Действие отменено пользователем");
                }
            })
        })
    </script>
@stop