@extends('Admin/Layout/main')
@section('content')
    @if (isset($model['error']))
        {{$model['error']}}
    @endif
    @if (isset($model['success']))
        <script>
            alert('success');
            document.location.href = '{{$model['success']}}';
        </script>
        {{$model['success']}}
    @endif
    <form method="post">
        <div id="m1">
            M1
            <button id="add-m1" type="button">Tambah</button>
        </div>

        <div id="m2">
            M2
            <button id="add-m2" type="button">Tambah</button>
        </div>

        <div id="m3">
            M3
            <button id="add-m3" type="button">Tambah</button>
        </div>

        <div id="m4">
            M4
            <button id="add-m4" type="button">Tambah</button>
        </div>

        <div id="m5">
            M5
            <button id="add-m5" type="button">Tambah</button>
        </div>

        <div id="submit">
            <button type="submit" disabled>submit</button>
        </div>
    </form>
    <hr>

    @foreach($model['allMonth'] as $key1 => $value1)
        @php
            $date = new DateTime($value1->getCreatedAt(), new DateTimeZone('Asia/Jakarta'));
        @endphp
        <span>{{$date->format('F')}}</span>
        <a href="/admin/schedule/{{$value1->getId()}}/delete" onclick="return confirm('Ingin menghapusnya?')">delete</a>
        <br>
        <table>
            @foreach($model['allDate'][$key1] as $key2 => $value2)
                <tr>
                    <td>{{$value2->getMid()}}</td>
                    <td>{{$value2->getDate()}}</td>
                    <td>{{$value2->getIsImplemented() == null ? 'belum' : 'sudah'}}</td>
                    <td>@if($value2->getIsImplemented() != null)
                            <a href="{{$value2->getSupplyId()}}">Lihat</a></td>
                    @endif
                </tr>
            @endforeach
        </table>
    @endforeach

    <script type="text/javascript">
        const addM1 = document.getElementById('add-m1');
        addM1.addEventListener('click', addMoreFields1);
        addM1.addEventListener('click', countFieldDate);


        function addMoreFields1() {
            const m1 = document.getElementById('m1');
            const input = document.createElement('input');
            input.setAttribute('type', 'date');
            input.setAttribute('name', 'date-m1[]');
            m1.appendChild(input);
            const buttonRemove = document.createElement('button');
            buttonRemove.innerHTML = 'Hapus';
            buttonRemove.addEventListener('click', function () {
                m1.removeChild(input);
                m1.removeChild(buttonRemove);
                countFieldDate();
            });
            m1.appendChild(input);
            m1.appendChild(buttonRemove);
        }

        const addM2 = document.getElementById('add-m2');
        addM2.addEventListener('click', addMoreFields2);
        addM2.addEventListener('click', countFieldDate);

        function addMoreFields2() {
            const m2 = document.getElementById('m2');
            const input = document.createElement('input');
            input.setAttribute('type', 'date');
            input.setAttribute('name', 'date-m2[]');
            m2.appendChild(input);
            const buttonRemove = document.createElement('button');
            buttonRemove.innerHTML = 'Hapus';
            buttonRemove.addEventListener('click', function () {
                m2.removeChild(input);
                m2.removeChild(buttonRemove);
                countFieldDate();
            });
            m2.appendChild(input);
            m2.appendChild(buttonRemove);
        }

        const addM3 = document.getElementById('add-m3');
        addM3.addEventListener('click', addMoreFields3);
        addM3.addEventListener('click', countFieldDate);

        function addMoreFields3() {
            const m3 = document.getElementById('m3');
            const input = document.createElement('input');
            input.setAttribute('type', 'date');
            input.setAttribute('name', 'date-m3[]');
            m3.appendChild(input);
            const buttonRemove = document.createElement('button');
            buttonRemove.innerHTML = 'Hapus';
            buttonRemove.addEventListener('click', function () {
                m3.removeChild(input);
                m3.removeChild(buttonRemove);
                countFieldDate();
            });
            m3.appendChild(input);
            m3.appendChild(buttonRemove);
        }


        const addM4 = document.getElementById('add-m4');
        addM4.addEventListener('click', addMoreFields4);
        addM4.addEventListener('click', countFieldDate);

        function addMoreFields4() {
            const m4 = document.getElementById('m4');
            const input = document.createElement('input');
            input.setAttribute('type', 'date');
            input.setAttribute('name', 'date-m4[]');
            m4.appendChild(input);
            const buttonRemove = document.createElement('button');
            buttonRemove.innerHTML = 'Hapus';
            buttonRemove.addEventListener('click', function () {
                m4.removeChild(input);
                m4.removeChild(buttonRemove);
                countFieldDate();
            });
            m4.appendChild(input);
            m4.appendChild(buttonRemove);
        }

        const addM5 = document.getElementById('add-m5');
        addM5.addEventListener('click', addMoreFields5);

        function addMoreFields5() {
            const m5 = document.getElementById('m5');
            const input = document.createElement('input');
            input.setAttribute('type', 'date');
            input.setAttribute('name', 'date-m5[]');
            m5.appendChild(input);
            const buttonRemove = document.createElement('button');
            buttonRemove.innerHTML = 'Hapus';
            buttonRemove.addEventListener('click', function () {
                m5.removeChild(input);
                m5.removeChild(buttonRemove);
            });
            m5.appendChild(input);
            m5.appendChild(buttonRemove);
        }

        // enable submit button if field date more than 4

        function countFieldDate() {
            const submit = document.getElementById('submit');
            const buttonSubmit = submit.querySelector('button');
            const m1 = document.getElementById('m1');
            const m2 = document.getElementById('m2');
            const m3 = document.getElementById('m3');
            const m4 = document.getElementById('m4');
            const countM1 = m1.querySelectorAll('input').length;
            const countM2 = m2.querySelectorAll('input').length;
            const countM3 = m3.querySelectorAll('input').length;
            const countM4 = m4.querySelectorAll('input').length;
            if ((countM1 >= 1) && (countM2 >= 1) && (countM3 >= 1) && (countM4 >= 1)) {
                buttonSubmit.removeAttribute('disabled');
            } else {
                buttonSubmit.setAttribute('disabled', 'disabled');
            }
        }
    </script>

@endsection
