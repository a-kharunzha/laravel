@extends('layouts.app')

@section('content')
	<script src="{{ asset('js/socket.js') }}" defer></script>
    <button class="js-add-count">Плюсадын</button>
	<div class="js-counter">{{$counter}}</div>
@stop