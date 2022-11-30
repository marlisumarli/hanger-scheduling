@extends('Admin/Layout/main')
@section('content')

    @if (isset($model['error']))
        <script>
            alert({{$model['error']}});
        </script>
    @endif

    @if($model['findType'] != null)

        <form action="/admin/item/{{$model['findType']->getId()}}/update" method="post">
            <label for="id">Id</label>
            <input type="text" name="newId" id="id" title="Huruf kapital"
                   pattern="[A-Z0-9]{1,}" required="required" value="{{$model['findType']->getId()}}">
            <button name="updateId" type="submit">change</button>
        </form>
        <form action="/admin/item/{{$model['findType']->getId()}}/update" method="post">
            <label for="qty">Quantity</label>
            <input type="number" name="qty" id="qty" min="1" required="required"
                   value="{{$model['findType']->getQty()}}">
            <button name="updateQty" type="submit">change</button>
        </form>
        <form action="/admin/item/{{$model['findType']->getId()}}/hanger/hanger/update" method="post">
            <button type="button" id="generate">Generate</button>
            @for($i = 0; $i < $model['findType']->getQty(); $i++)
                <div>
                    <input type="number" class="order"
                           name="{{$i >= count($model['allHanger']) ? 'orderNumber[]' : 'updateOrderNumber[]'}}"
                           id="" placeholder="Nomor Urut" required title="Angka"
                           value="{{$i < count($model['allHanger']) ? $model['allHanger'][$i]->getOrderNumber() : ''}}">
                    <input type="text"
                           name="{{$i >= count($model['allHanger']) ? 'hangerName[]' : 'updateName[]'}}"
                           id="" placeholder="Nama Subjig" required title="Valid Nama"
                           pattern="[A-Za-z ]{3,}"
                           value="{{$i < count($model['allHanger']) ? $model['allHanger'][$i]->getHangerName() : ''}}">
                    <input type="number"
                           name="{{$i >= count($model['allHanger']) ? 'qty[]' : 'updateQty[]'}}"
                           id="" placeholder="Quantity" required title="Angka" min="1"
                           value="{{$i < count($model['allHanger']) ? $model['allHanger'][$i]->getHangerQty() : ''}}">
                </div>
                @if($i < count($model['allHanger']))
                    <a href="/admin/item/{{$model['allHanger'][$i]->getHangerTypeId()}}/hanger/{{$model['allHanger'][$i]->getHangerId()}}/delete"
                       onclick="return confirm('are you sure want to be delete?')">Hapus</a>
                @endif
            @endfor
            @if(count($model['allHanger']) < $model['findType']->getQty())
                <button name="register" type="submit">registrasi</button>
            @endif
            @if(count($model['allHanger']) >= $model['findType']->getQty())
                <button name="update" type="submit">update</button>
            @endif
        </form>

        <script>
            //    Generate sequence number
            const generate = document.getElementById('generate');
            const id = document.querySelectorAll('.order');
            const makeArray = (count, content) => {
                const result = [];
                if (typeof content === "function") {
                    for (let i = 0; i < count; i++) {
                        result.push(content(i));
                    }
                }
                return result;
            }
            generate.addEventListener('click', () => {
                makeArray(id.length, (i) => {
                    return id[i].value = i + 1;
                });
            });
        </script>
    @else
        notfound
    @endif
@endsection