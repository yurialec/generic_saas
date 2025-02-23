<tenant-sidebar-component
    :user="{{ json_encode(session('user')) }}"
    url-dashboard="{{ route('tenant.dashboard', ['tenant' => session('tenant')]) }}">
</tenant-sidebar-component>
