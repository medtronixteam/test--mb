<div>
      @push('scripts')
        <!-- JS Libraies -->
        <script src="{{ url('assets/modules/datatables/datatables.min.js') }}"></script>
        <script src="{{ url('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ url('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
        <script>
            if ($('.datatable').length) {
                $(".datatable").dataTable();
            }
            function deleteFromTable(id){

                    swal({
                    title: 'Are you sure?',
                    text: 'Once deleted, you will not be able to recover this file!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        @this.deleteRow(id);
                    }
                    });
            }
        </script>
    @endpush
</div>