@extends('Admin/Layout/main')
@section('content')
    <form action="" method="post">
        <label for="id">Id</label>
        <input type="text" name="id" id="id" required="required">
        <br>
        <label for="qty">Quantity</label>
        <input type="number" name="qty" id="qty" min="1" required="required">
        <button name="generateQty" type="submit">OK</button>
    </form>
    <ul>
        @foreach($model['hanger_types'] as $hangerType)
            <li>
                <a href="/admin/item/{{$hangerType->getId()}}/hanger/update">{{strtoupper($hangerType->getId())}}</a>

                <table border="1">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Qty</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($model['hangers']->findHangerTypeId($hangerType->getId()) as $hanger)
                        <tr>
                            @if($hanger->getHangerTypeId() == $hangerType->getId())

                                <th scope="row">{{$hanger->getOrderNumber()}}</th>
                                <td>{{$hanger->getName()}}</td>
                                <td>{{$hanger->getQty()}}</td>

                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </li>
        @endforeach
    </ul>
@endsection
