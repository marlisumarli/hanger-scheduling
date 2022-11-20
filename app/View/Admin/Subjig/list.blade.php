@extends('Admin/Layout/main')
@section('content')
    @if (isset($model['error']))
        {{$model['error']}}
    @endif
    @if (isset($model['success']))
        <script>
            alert('success');
            document.location.href = '{{$model["success"]}} ';
        </script>
    @endif
    <form action="" method="post">
        <button type="button" id="generate">Generate</button>
        @for($i = 0; $i < $model['typeQty']; $i++)
            <div>
                <input type="number" class="order"
                       name="{{$i >= count($model['allSubjig']) ? 'orderNumber[]' : 'updateOrderNumber[]'}}"
                       id="" placeholder="Nomor Urut" required title="Angka"
                       value="{{$i < count($model['allSubjig']) ? $model['allSubjig'][$i]->getOrderNumber() : ''}}">
                <input type="text"
                       name="{{$i >= count($model['allSubjig']) ? 'subjigName[]' : 'updateSubjigName[]'}}"
                       id="" placeholder="Nama Subjig" required title="Valid Nama"
                       pattern="[A-Za-z ]{3,}"
                       value="{{$i < count($model['allSubjig']) ? $model['allSubjig'][$i]->getSubjigName() : ''}}">
                <input type="number"
                       name="{{$i >= count($model['allSubjig']) ? 'qty[]' : 'updateQty[]'}}"
                       id="" placeholder="Quantity" required title="Angka" min="1"
                       value="{{$i < count($model['allSubjig']) ? $model['allSubjig'][$i]->getSubjigQty() : ''}}">
            </div>
            @if($i < count($model['allSubjig']))
                <a href="/admin/subjig/{{$model['allSubjig'][$i]->getTypeId()}}/{{$model['allSubjig'][$i]->getSubjigId()}}-delete">Hapus</a>
            @endif
        @endfor
        <br>
        @if(count($model['allSubjig']) < $model['typeQty'])
            <button name="create" type="submit">Buat</button>
        @endif
        @if(count($model['allSubjig']) == $model['typeQty'])
            <button name="update" type="submit">Update</button>
        @endif
    </form>

@endsection