<script>
    @session('success')
        toastr.success('{{$value}}',"Thông báo");
    @endsession
    @session('error')
        toastr.error('{{$value}}',"Báo lỗi");
    @endsession
            
</scrip>