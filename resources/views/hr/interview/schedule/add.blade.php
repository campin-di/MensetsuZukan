@extends('layouts.hr.common')
@section('content')
<div class="container">
  <h1>面接可能日程を追加する。</h1>
  <form method="post" action="{{ route('hr.interview.schedule.post') }}">
    @csrf

    <div>
      <label>日付</label>
      <input type="date" name="date" class="form-control">
    </div>
    <div>
      <input type="checkbox" name="time[]" value="nine" > 9:00 - 10:00
      <input type="checkbox" name="time[]" value="ten"> 10:00 - 11:00
      <input type="checkbox" name="time[]" value="eleven"> 11:00 - 12:00<br>
      <input type="checkbox" name="time[]" value="twenty"> 12:00 - 13:00
      <input type="checkbox" name="time[]" value="thirteen"> 13:00 - 14:00
      <input type="checkbox" name="time[]" value="fourteen"> 14:00 - 15:00
      <input type="checkbox" name="time[]" value="fifteen"> 15:00 - 16:00<br>
      <input type="checkbox" name="time[]" value="sixteen"> 16:00 - 17:00
      <input type="checkbox" name="time[]" value="seventeen"> 17:00 - 18:00
      <input type="checkbox" name="time[]" value="eighteen"> 18:00 - 19:00
      <input type="checkbox" name="time[]" value="nineteen"> 19:00 - 20:00<br>
      <input type="checkbox" name="time[]" value="twenty"> 20:00 - 21:00
      <input type="checkbox" name="time[]" value="twentyone"> 21:00 - 22:00
    </div>

    </table>
    <div class="next-button">
      <input class="btn btn-primary" type="submit" value="送信" />
    </div>
  </form>
</div>
@endsection
