@extends('layouts.master')
@section('styles')
<style>
    .home-container{
        background: #a1a1a117;
    height: 100vh;
    width: auto;

    }
    .home-wrapper{
        display: flex;
    justify-content: center;
    align-items: center;
    height:80vh;
    }

    .home-wrapper ul{
        list-style: none;
    padding: 50px;
    box-shadow: 1px 0px 20px #d1c7c7;
    padding: 0;
    height: 218px;
    width: 500px;
    }

    .home-wrapper ul li{
        padding: 23px;
    border-bottom: 1px solid #ddd6d6;
    display:flex;
    justify-content:space-between;
    }

    li:last-child
    {
        border-bottom: 0px solid #fff !important;
    }

    li p{
        padding:0;
        margin:0;
    }
    
</style>
@endsection
@section('content')

    <div class="home-container">
            <div class="home-wrapper">
                <ul>
                    <li><p class="text-muted fw-bold">Welcome @auth {{auth()->user()->name}}</p> @endauth</li>
                    <li><p class="text-muted">Your Id</p> @auth <p>{{auth()->user()->email}}</p> @endauth</li>
                    <li><p class="text-muted">Balance</p> @isset($balance)<p>{{number_format($balance,2)}} INR</p>@endisset</li>
                </ul>
            </div>
    </div>
@endsection