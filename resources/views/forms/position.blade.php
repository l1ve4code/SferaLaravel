@extends("layouts.app")

@section("content")
    <form class="row mt-5 d-flex flex-column justify-content-center align-items-center" method="post" action="{{ route("create_position") }}">
        @csrf
        <h3>
            Список должностей
        </h3>
        <div class="col-md-6 d-flex flex-column align-items-center">
            @foreach($positions as $position)
                <div class = "d-flex justify-content-between w-100 mt-3">
                    <p>{{ $position["name"] }}</p>
                    <a class="btn btn-danger" href="{{ route("delete_position", ["id"=>$position["id"]]) }}">Удалить</a>
                </div>
            @endforeach
        </div>
        <div class="col-md-6 d-flex flex-row mt-4">
            <div class = "custom-control w-100 pl-0">
                <input type="text" class="form-control" id="position" name = "position" placeholder="Стажер">
            </div>
            <button type="submit" class="btn btn-primary ml-3">Добавить</button>
        </div>
    </form>
@endsection
