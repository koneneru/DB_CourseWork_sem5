@extends('layouts.layout')

@section('head')
    <title>Админ панель</title>
@endsection

@section('content')
    <div class="content">
        <div id="ordersAll" class="head" style="margin-bottom: 10px">Заказы</div>
        <p style="margin-bottom: 20px">
            <a href="{{ route('admin') }}">{!! !request('status') ? "<b>Все</b>" : "Все" !!}</a> |
            @foreach($statuses as $status)
                <a href="{{ route('admin', ['status' => $status->id]) }}">{!! request('status') == $status->id ? "<b>$status->name</b>" : $status->name !!}</a> {{ !$loop->last ? '|' : '' }}
            @endforeach
        </p>

        @if(count($orders) > 0)
            @foreach($orders as $idOrder => $order)
                @php($totalCount = 0)
                @foreach($order as $product)
                    @php($totalCount += $product->count)
                @endforeach
                <div class="wrap">
                    <div class="row">
                        <h2>Заказ {{ $order[0]->id }}</h2>
                    </div>
                    <div class="row">
                        <p>Заказчик: <b>{{ "{$order[0]->user}" }}</b></p>
                        <p>Статус: <b>{{ $order[0]->name_status }}</b></p>
                        <p>Количество товаров: <b>
                                {{ $totalCount }}
                            </b></p>
                        <p>Общая стоимость: <b>
                                {{ $order[0]->sum_order }}
                                руб.</b></p>
                    </div>
                    @if($order[0]->reason_order)
                        <div class="row">
                            <p>Причина отмены:</p>
                            <p><b>{{ $order[0]->reason_order }}</b></p>
                        </div>
                    @endif
                    <hr>
                    <div class="row">
                        @foreach($order as $product)
                            <div class="col">
                                <div class="row">
                                    <h3><a target="_blank" href="{{ route('product', ['id' => $product->id_product]) }}">{{ $product->name_product }}</a></h3>
                                    <p>{{ $product->price_product }} руб.</p>
                                </div>
                                <div class="row">
                                    <p>Количество:</p>
                                    <b>{{ $product->count_order }}</b>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr>

                    @if($order[0]->status == 1)
                        <form action="{{ route('changeStatusOrder') }}" class="w100" method="post">
                            @csrf
                            @method("PATCH")
                            <input type="hidden" name="id_order" value="{{ $idOrder }}">
                            <input type="hidden" name="id_status" value="2">
                            <button type="submit">Подтвердить заказ</button>
                        </form>
                        <br>
                    @endif

                    @if($order[0]->status == 1 || $order[0]->status == 2)
                        <h3 class="text-center">Отменить заказ</h3>
                        <form action="{{ route('changeStatusOrder') }}" class="w100" method="post">
                            @csrf
                            @method("PATCH")
                            <textarea name="reason_order" placeholder="Причина отмены" required></textarea>
                            <input type="hidden" name="id_order" value="{{ $idOrder }}">
                            <input type="hidden" name="id_status" value="3">
                            <button type="submit" style="margin:0">Отменить заказ</button>
                        </form>
                    @endif

                    @if($order[0]->status == 3)
                        <h3 class="text-center">Причина отмены:</h3>
                        <p class="reason">{{ $order[0]->reason_order }}</p>
                    @endif

                    <p class="text-small text-right">Отправили {{ date('d.m.Y в H:i:s', strtotime($order[0]->created_at)) }}</p>
                </div><br>
            @endforeach
        @else
            <div>Заказы не найдены</div>
        @endif

        <div class="head" id="categories">Категории</div>
        <form action="{{ route('addCategory') }}" method="post">
            @csrf
            <div class="part">
                <input type="text" placeholder="Название категории" name="name_category" required>
                <button>Добавить</button>
            </div>
        </form>
        <form action="{{ route('deleteCategory') }}" method="post">
            @csrf
            {{--        замедьте мы указали метод post в html форме, но на самом деле у нас метод delete для laravel    --}}
            @method('DELETE')
            <div class="part">
                <select name="id_category" required>
                    <option value selected disabled>Категории</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id_category }}">{{ $category->name_category }}</option>
                    @endforeach
                </select>
                <button>Удалить</button>
            </div>
        </form>
        {{ session('msgForCategory') }}

        <div class="head" id="addFormProduct">Добавить товар</div>
        <form action="{{ route('addProduct') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" placeholder="Название" name="name_product" required>
            <input type="number" placeholder="Цена" name="price_product" required>
            <input type="text" placeholder="Страна производитель" name="country_product" required>
            <input type="number" placeholder="Год выпуска" name="year_product" required>
            <input type="text" placeholder="Модель" name="model_product" required>
            <select name="id_category" required>
                <option value selected disabled>Категория</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id_category }}">{{ $category->name_category }}</option>
                @endforeach
            </select>
            <input type="number" placeholder="Количество на складе" name="count_product" required>
            <p class="text-left">Фотография товара</p>
            <input type="file" name="image" required accept=".jpg, .png">
            <button>Добавить</button>
        </form>
        @error('image')
        <div class="error">
            {{ $message }}
        </div>
        @enderror
        @error('msgForImg')
        {{ $message }}
        @enderror
        {{ session('msgForProduct') }}
    </div>
@endsection
