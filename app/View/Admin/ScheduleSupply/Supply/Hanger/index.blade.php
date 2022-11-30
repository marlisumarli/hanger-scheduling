@extends('Admin/Layout/main')
@section('content')

    {{--    <ul>--}}
    {{--        @foreach($model['allSchedule'] as $key => $value)--}}
    {{--            @php--}}
    {{--                $date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));--}}
    {{--            @endphp--}}
    {{--            <li>{{$value->getDate()}}--}}
    {{--                <ul>--}}
    {{--                    @if(strtotime($date->format('Y-m-d')) == strtotime($value->getDate()))--}}
    {{--                        @if((int)$value->getIsImplemented() !== 1)--}}
    {{--                            <li><a href="/admin/supply/{{$model['id']}}/{{$value->getSupplyId()}}/create">buat--}}
    {{--                                    laporan</a></li>--}}
    {{--                        @else--}}
    {{--                            Laporan sudah dibuat--}}
    {{--                        @endif--}}
    {{--                    @elseif(strtotime($date->format('Y-m-d')) > strtotime($value->getDate()))--}}
    {{--                        @if((int)$value->getIsImplemented() !== 1)--}}
    {{--                            belum dibuat--}}
    {{--                        @else--}}
    {{--                            Sudah dibuat--}}
    {{--                        @endif--}}

    {{--                    @endif--}}
    {{--                </ul>--}}
    {{--            </li>--}}
    {{--        @endforeach--}}
    {{--    </ul>--}}

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
@endsection