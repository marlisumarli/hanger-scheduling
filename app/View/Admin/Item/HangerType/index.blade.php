@extends('Admin/Layout/main')
@section('content')
    <form action="" method="post">
        <label for="id">Id</label>
        <input type="text" name="id" id="id" title="Huruf kapital" pattern="[A-Z0-9]{1,}" required="required">
        <br>
        <label for="qty">Quantity</label>
        <input type="number" name="qty" id="qty" min="1" required="required">
        <button name="generateQty" type="submit">OK</button>
    </form>
    <ul>
        @foreach($model['allHangerType'] as $key1 => $value)
            <li>
                <a href="/admin/item/{{$value->getId()}}/hanger/update">{{$value->getId()}}</a>

                <table border="1">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Qty</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($model['allHanger'][$key1] as $key2 => $value2)
                        <tr>
                            <th scope="row">{{$value2->getOrderNumber()}}</th>
                            <td>{{$value2->getHangerName()}}</td>
                            <td>{{$value2->getHangerQty()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </li>
        @endforeach
    </ul>
@endsection
