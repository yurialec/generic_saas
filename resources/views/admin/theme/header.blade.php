<header-component
    url-profile="{{ route('profile.view') }}"
    url-sair="{{ route('logout') }}" logo="{{ App\Models\Site\SiteLogo::first()->image ?? '' }}"
    url-home="{{ route('home') }}">
</header-component>
