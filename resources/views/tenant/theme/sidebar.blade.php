<tenant-sidebar-component
    url-dashboard="{{ route('tenant.dashboard', ['tenant' => session('tenant')]) }}"
    url-profile="{{ route('tenant.profile', ['tenant' => session('tenant')]) }}">
</tenant-sidebar-component>
