@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
<div class="content__inner">
    <h2 class="form__heading">{{ $name }}さんお疲れ様です！</h2>
    <div class="attendance-system">
        <form action="/store" id="attendanceForm" method="post">
            @csrf
            <div class="work__group">
                @if(!$work_start_defined && !$work_end_defined)
                <button type="submit" name="action" value="work_start" >勤務開始</button>
                <button type="submit" name="action" value="work_end" disabled>勤務終了</button>
                @elseif($work_start_defined && !$work_end_defined)
                <button type="submit" name="action" value="work_start" disabled>勤務開始</button>
                <button type="submit" name="action" value="work_end" >勤務終了</button>
                @elseif($work_start_defined && $work_end_defined)
                <button type="submit" name="action" value="work_start" disabled>勤務開始</button>
                <button type="submit" name="action" value="work_end">勤務終了</button>
                @endif
            </div>
            <div class="break__group">
                <!-- 打刻前　-->
                @if(!$work_start_defined && !$rest_start_defined && !$rest_end_defined && !$work_end_defined)
                <button type="submit" name="action" value="rest_start" disabled>休憩開始</button>
                <button type="submit" name="action" value="rest_end" disabled>休憩終了</button>
                <!-- 出勤中　就業中 いつでも休憩取れる -->
                @elseif ($work_start_defined && !$rest_start_defined && !$rest_end_defined && !$work_end_defined)
                <button type="submit" name="action" value="rest_start" >休憩開始</button>
                <button type="submit" name="action" value="rest_end" disabled>休憩終了</button>
                <!-- 出勤中　休憩中 休憩終了出来る-->
                @elseif ($work_start_defined && $rest_start_defined && !$rest_end_defined && !$work_end_defined)
                <button type="submit" name="action" value="rest_start" disabled>休憩開始</button>
                <button type="submit" name="action" value="rest_end" >休憩終了</button>
                <!-- 出勤中　休憩終了　2回目の休憩取れる -->
                @elseif ($work_start_defined && $rest_start_defined && $rest_end_defined && !$work_end_defined )
                <button type="submit" name="action" value="rest_start" >休憩開始</button>
                <button type="submit" name="action" value="rest_end" disabled>休憩終了</button>
                <!-- 退勤処理 休憩開始・休憩終了処理不可になる -->
                @elseif ($work_start_defined && $work_end_defined)
                <button type="submit" name="action" value="rest_start" disabled>休憩開始</button>
                <button type="submit" name="action" value="rest_end" disabled>休憩終了</button>
                @endif
            </div>
        </form>
    </div>
</div>

@endsection