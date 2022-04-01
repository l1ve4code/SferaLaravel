@extends("layouts.app")
@section("content")
    <div class="d-flex">
        <div class="dropdown show">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Алфавит
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="?alphabet=asc">По возрастанию</a>
                <a class="dropdown-item" href="?alphabet=desc">По убыванию</a>
            </div>
        </div>
        <div class="dropdown show ml-4">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Дата создания
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="?creation=asc">По возрастанию</a>
                <a class="dropdown-item" href="?creation=desc">По убыванию</a>
            </div>
        </div>
        <div class="dropdown show ml-4">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Должность
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                @foreach($positions as $position)
                    <a class="dropdown-item" href="?position={{ $position["id"] }}">{{ $position["name"] }}</a>
                @endforeach
            </div>
        </div>
        <div class="dropdown show ml-4">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Навык
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                @foreach($skills as $skill)
                    <a class="dropdown-item" href="?skill={{ $skill["name"] }}">{{ $skill["name"] }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-3 pl-0 mt-3">
        <form method="post" action="{{ route("find") }}">
            @csrf
            <div class="input-group">
                <input type="text" name="label" class="form-control rounded" placeholder="Search" aria-label="Search"
                       aria-describedby="search-addon"/>
                <button type="submit" class="btn btn-outline-primary">Поиск</button>
            </div>
        </form>
    </div>
    <div class="row row-cols-1 row-cols-md-3 mt-3">
        @foreach($users as $item)
            <div class="col mb-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <p>{{ $item["position_name"] }} <b>№{{ $item["user_id"] }}</b></p>
                    </div>
                    @authenticated
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ $item["fio"] }}</li>
                        <li class="list-group-item">{{ $item["phone"] }}</li>
                        <li class="list-group-item">{{ $item["email"] }}</li>
                    </ul>
                    @endauthenticated
                    @if(isset($item["skills"]))
                        <div class="card-body">
                            <p>Навыки</p>
                            <ul class="list-group list-group-flush">
                                @foreach($item["skills"] as $skill)
                                    <li class="list-group-item">{{ $skill["name"] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @admin
                    <div class="card-footer">
                        <a href="{{ route("card_edit", ["id"=>$item["user_id"]]) }}" class="btn btn-success w-100">Редактировать</a>
                    </div>
                    @endadmin
                </div>
            </div>
        @endforeach
    </div>
@endsection
