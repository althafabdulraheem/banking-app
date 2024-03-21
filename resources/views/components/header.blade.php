<div class="header-wrapper">
    <div class="header-title">
        
            <h1 class="text-center">Bank</h1>
    </div>
    <div class="header-menus">
        <ul>
        
        <li class="{{request()->segments()[0] == 'home' ? 'nav-active' :''}}"><a href="{{url('/home')}}">Home</a></li>
        <li class="{{request()->segments()[0] == 'deposit' ? 'nav-active' :''}}"><a href="{{url('/deposit')}}">Deposit</a></li>
        <li class="{{request()->segments()[0] == 'withdraw' ? 'nav-active' :''}}"><a href="{{url('/withdraw')}}">Withdraw</a></li>
        <li class="{{request()->segments()[0] == 'transfer'? 'nav-active': ''}}"><a href="{{url('/transfer')}}">Transfer</a></li>
        <li class="{{request()->segments()[0] == 'statement'? 'nav-active': ''}}"><a href="{{url('/statement')}}">Statement</a></li>
        <li><a href="{{url('/logout')}}">Logout</a></li></ul>
    </div>
</div>