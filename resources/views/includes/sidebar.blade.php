{{-- Sidebar --}}
<div class="sidebar" data-active-color="blue" data-background-color="red"
     style="background-color: lightblue">
    <!--
    Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
    Tip 2: you can also add an image using data-image tag
     3: you can change the color of the sidebar with data-background-color="white | black"
    -->
    <div class="logo text-center">
        <a href="{{route('home')}}" class="simple-text">
            TANKER
        </a>
    </div>
{{--    <div class="logo logo-mini">--}}
{{--        <a href="http://www.creative-tim.com" class="simple-text">--}}
{{--            CT--}}
{{--        </a>--}}
{{--    </div>--}}
    <div class="sidebar-wrapper">
{{--        <div class="user">--}}
            <br>
            <div class="photo mt-2" style="background-color: transparent">
                <img src="{{ url('assets/img/logo_tankers.png') }}" style="display: block;margin-left: auto; margin-right: auto; width: 50%"
                     width="120" height="120" id="logo_tanker"/>
            </div>
{{--            <div class="info">--}}
{{--                <a data-toggle="collapse" href="#collapseExample" class="collapsed">--}}
{{--                    {{Auth::user()->username}}--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
        <ul class="nav">
            <li class="{{ Request::is('anggota*') ? 'active' : '' }}">
                <a href="{{url('anggota')}}" class="" aria-expanded="true">
                    <i class="material-icons">people</i>
                    <p>Anggota
                    </p>
                </a>
            </li>
            <li class="{{Request::is('pinjaman*') ? 'active' : '' }}">
                <a href="{{url('pinjaman')}}" class="" aria-expanded="true">
                    <i class="material-icons">money</i>
                    <p>Pinjaman
                    </p>
                </a>
            </li>
            <li class="{{Request::is('penyertaan*') ? 'active' : ''}}">
                <a href="{{url('penyertaan')}}" class="" aria-expanded="true">
                    <i class="material-icons">monetization_on</i>
                    <p>Penyertaan Modal
                    </p>
                </a>
            </li>
            <li class="{{Request::is('simpanan_shu*') ? 'active' : ''}}">
                <a href="{{url('simpanan_shu')}}" class="" aria-expanded="true">
                    <i class="material-icons">account_balance</i>
                    <p>Simpanan & SHU
                    </p>
                </a>
            </li>
        </ul>
    </div>
</div>

<script type="text/javascript">
    function decrease() {
        let navbar = document.getElementById('logo_tanker');
        navbar.style.width = '50px';
        navbar.style.height = '50px';
    }

    function increase() {
        let navbar = document.getElementById('logo_tanker');
        navbar.style.width = '120px';
        navbar.style.height = '120px';
    }
</script>
