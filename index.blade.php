<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="app.css">
    <title>Document</title>


</head>

<body>
<header>
   <p>Todoアプリ</p>
</header>

<main class="Todo-main">

        <div class="Todo-head">
            <p class="">今日は何する？</p>
            <form action="/tasks" method="post" class="mt-10">
                @csrf

                <div class="todo-box">
                    <label>
                        <input  class="input-box" placeholder="洗濯物をする..." type="text" name="task_name" />
                        @error('task_name')
                        <div class="error">
                            <p>
                                {{ $message }}
                            </p>
                        </div>
                        @enderror
                    </label>

                    <button type="submit" class="todo-submit">
                        追加する
                    </button>
                </div>
            </form>
        </div>
        <div class="Todo-list">

            @if ($tasks->isNotEmpty())
                    <div class="task-lists">
                        <table class="list">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="task">
                                        タスク</th>
                                    <th scope="col" class="actions">
                                        <span>Actions</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($tasks as $item)
                                    <tr>
                                        <td class="Todo-name">
                                            <div>
                                                {{ $item->name }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="Todo-id">
                                                <div class="status-box">
                                                    <form action="/tasks/{{ $item->id }}"
                                                          method="post"
                                                          class=""
                                                          role="menuitem" tabindex="-1">
                                                        @csrf
                                                        @method('PUT')

                                                        {{-- 追記 --}}
                                                        <input type="hidden" name="status" value="{{$item->status}}">
                                                        {{-- 追記 --}}

                                                        <button type="submit">完了</button>
                                                    </form>
                                                </div>
                                                <div class="edit-box">
                                                    <a href="/tasks/{{ $item->id }}/edit/"
                                                       class="">編集</a>
                                                </div>
                                                <div class="delete-box">
                                                    <form onsubmit="return deleteTask();" action="/tasks/{{ $item->id }}" method="post"
                                                          class=""
                                                          role="menuitem" tabindex="-1">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="delete-box">削除</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </thead>
                         </table>
                    </div>
            @endif

        </div>

</main>
<footer class="">
    <p class="">Todoアプリ</p>
</footer>

<script>
    function deleteTask() {
        if (confirm('本当に削除しますか？')) {
            return true;
        } else {
            return false;
        }
    }
</script>
</body>
</html>
