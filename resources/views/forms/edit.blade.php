@extends("layouts.app")

@section("content")
    <form class="row d-flex flex-column justify-content-center align-items-center" method="post" action="{{ route("update_position", ["id"=> request()->route("id")]) }}">
        @csrf
        <h3>
            Должность
        </h3>
        <a href = "{{ route("position") }}">Добавить</a>
        <div class="col-md-6 d-flex flex-row">
            <select class="custom-select" name = "position">
                <option selected>Выберите должность:</option>
                @foreach($positions as $position)
                    <option value="{{ $position["id"] }}">{{ $position["name"] }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary ml-3">Применить</button>
        </div>
    </form>
    <form class="row mt-5 d-flex flex-column justify-content-center align-items-center" method="post" action="{{ route("skill_create", ["id"=> request()->route("id")]) }}">
        @csrf
        <h3>
            Навыки
        </h3>
        <div class="col-md-6 d-flex flex-column align-items-center">
            @foreach($skills as $skill)
                <div class = "d-flex justify-content-between w-100 mt-3">
                    <p>{{ $skill["name"] }}</p>
                    <a class="btn btn-danger" href="{{ route("skill_delete", ["id"=>$skill["id"]]) }}">Удалить</a>
                </div>
            @endforeach
        </div>
        <div class="col-md-6 d-flex flex-row mt-4">
            <div class = "custom-control w-100 pl-0">
                <input type="text" class="form-control" id="skill" name = "skill" placeholder="DevOps">
            </div>
            <button type="submit" class="btn btn-primary ml-3">Добавить</button>
        </div>
    </form>
@endsection
